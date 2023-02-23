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
 *   id = "update_username",
 *   label = @Translation("Update Usernames"),
 *   uri_paths = {
 *     "canonical" = "/update-username",
 *     "https://www.drupal.org/link-relations/create" = "/update-username"
 *   }
 * )
 */
class UpdatUserName extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Return users object.
   */
  public function post(Request $request) {
    //$uid = \Drupal::request()->query->get('uid');
    //$name = \Drupal::request()->query->get('name');
    $output = $request->getContent();
    /*if ($uid) {
      $user = User::load($uid);
      $user->setUsername($name);
      $user->save();
    }*/
    //$output['message'] = 'success'; 
    $response = new ResourceResponse($output);
    $response->addCacheableDependency($output);
    return $response;

  }

}
