<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\user\Entity\User;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Provides a resource to update username.
 * @RestResource(
 *   id = "update_user_name",
 *   label = @Translation("Update Username"),
 *   uri_paths = {
 *     "canonical" = "/update-user-name",
 *     "create" = "/update-user-name"
 *   }
 * )
 */
class UpdateUserName extends ResourceBase {
  
  /**
   * Responds to POST request.
   * Update username.
   */
  public function post($data) {
    $uid = \Drupal::request()->query->get('uid');
    if ($uid) {
      if (!empty($data) && isset($data['name']) && $data['name'] != '') {
        $user = User::load($uid);
        if ($user) {
          $user->setUsername($data['name']);
          $user->save();
          return new ModifiedResourceResponse('Username successfully updated', 200);
        } else {
          throw new BadRequestHttpException('Please provide a valid uid');
        }
        
      } else { 
        throw new BadRequestHttpException('Username can not be null');
      }
    } else {
      throw new BadRequestHttpException('uid can not be null');
    }
    

  }

}
