<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Provides a resource to Redirect user to home.
 * @RestResource(
 *   id = "redirect_to_home",
 *   label = @Translation("Redirect to Home"),
 *   uri_paths = {
 *     "canonical" = "/redirect-to-homepage"
 *   }
 * )
 */
class RedirectToHome extends ResourceBase {
  
  /**
   * Responds to GET request.
   * Redirect user to home page.
   */
  public function get() {

    $url = Url::fromRoute('<front>', []);
    $redirect = new RedirectResponse($url->toString());
    $redirect->send();
  }

}
