<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a resource to show 404 not found message.
 * @RestResource(
 *   id = "404_not_found",
 *   label = @Translation("404 Not found"),
 *   uri_paths = {
 *     "canonical" = "/not-found"
 *   }
 * )
 */
class NotFound extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Return 404 not found with message.
   */
  public function get() {

    $message = "The requested page could not be found.";
    throw new NotFoundHttpException($message);
  }

}
