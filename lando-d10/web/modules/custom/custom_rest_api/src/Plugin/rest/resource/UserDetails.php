<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a resource to show user details.
 * @RestResource(
 *   id = "user_details",
 *   label = @Translation("User Details"),
 *   uri_paths = {
 *     "canonical" = "/user-details"
 *   }
 * )
 */
class UserDetails extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Return users object.
   */
  public function get() {
    $uid = \Drupal::request()->query->get('uid');
    $date_formatter = \Drupal::service('date.formatter');
    if ($uid) {
      $user = User::load($uid);
      if ($user) {
        
        $date = $date_formatter->format($user->get('created')->value, 'custom', 'd-m-Y');
        $data = [
         'id' => [$uid],
         'username' => [$user->get('name')->value],
         'email' => [$user->get('mail')->value],
         'date' => $date
        ];
      } else {
        throw new NotFoundHttpException("The requested page could not be found.");
      }
      
    } else {
      $users = User::loadMultiple(); // Load all the users
      if ($users){
        foreach ($users as $key => $user) {
         
          $data[] = [
           'id' => [$user->id()],
           'username' => [$user->get('name')->value],
           'email' => [$user->get('mail')->value],
           'date' => $date_formatter->format($user->get('created')->value, 'custom', 'd-m-Y')
          ];
        }
      }
    }
    $response = new ResourceResponse($data);
    $response->addCacheableDependency($data);
    return $response;

  }

}
