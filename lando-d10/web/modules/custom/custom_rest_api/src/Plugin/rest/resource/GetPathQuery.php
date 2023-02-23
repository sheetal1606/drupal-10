<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
/**
 * Provides a resource to get query string.
 * @RestResource(
 *   id = "get_path_query",
 *   label = @Translation("Path Query"),
 *   uri_paths = {
 *     "canonical" = "/get-path-query"
 *   }
 * )
 */
class GetPathQuery extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Returns query string value from url.
   */
  public function get() {
    
    $output['param'] = \Drupal::request()->query->all();

    $response = new ResourceResponse($output);
    $response->addCacheableDependency($output);
    return $response;
  }

}
