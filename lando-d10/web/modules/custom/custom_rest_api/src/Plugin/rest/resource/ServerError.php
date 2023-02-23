<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Provides a resource to show 500 server error message.
 * @RestResource(
 *   id = "500 server error",
 *   label = @Translation("500 server error"),
 *   uri_paths = {
 *     "canonical" = "/server-error"
 *   }
 * )
 */
class ServerError extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Return 500 server error with message.
   */
  public function get() {

    $errors = [
       'error' => [
          'message' => 'Website encountered an unexpected error',
          'code' => '500'
        ]
      ];
     return new JsonResponse($errors, 500);
    // throw new HttpException(500, 'Internal Server Error', $e);

  }

}
