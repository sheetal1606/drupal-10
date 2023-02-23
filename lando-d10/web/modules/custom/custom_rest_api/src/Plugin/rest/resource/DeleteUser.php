<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * Provides a resource to delete user.
 * @RestResource(
 *   id = "delete_user",
 *   label = @Translation("Delete User"),
 *   uri_paths = {
 *     "canonical" = "/delete-user",
 *     "create" = "/delete-user"
 *   }
 * )
 */
class DeleteUser extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Returns error code with message.
   */
  public function get() {
    $errors = [
       'error' => [
          'message' => 'request headers are incorrect.',
          'code' => '500'
        ]
      ];
    return new ModifiedResourceResponse($errors, 400);
     
  }

  /**
   * Responds to DELETE request.
   * Delete user 
   */
  public function delete() {
    $uid = \Drupal::request()->query->get('uid');
    if ($uid) {
    	$account = User::load($uid);
    	if ($account) {
  			$account->delete();
  			return new ModifiedResourceResponse(NULL, 204);
  		} else {
  			throw new BadRequestHttpException('Please provide a valid uid.');
  		}
    } else { 
	    throw new BadRequestHttpException('Please provide a valid uid.');
	  }
  }

  /**
   * Responds to POST request.
   * Returns error code with message.
   */
  public function post() {
    $errors = [
       'error' => [
          'message' => 'request headers are incorrect.',
          'code' => '500'
        ]
      ];
    return new ModifiedResourceResponse($errors, 400);
     
  }

}