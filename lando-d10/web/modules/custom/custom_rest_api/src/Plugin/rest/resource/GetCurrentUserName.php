<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
/**
 * Provides a resource to get view modes by entity and bundle.
 * @RestResource(
 *   id = "get_current_user_name",
 *   label = @Translation("current user name"),
 *   uri_paths = {
 *     "canonical" = "/get-current-user-name"
 *   }
 * )
 */
class GetCurrentUserName extends ResourceBase {
  /**
   * A current user instance which is logged in the session.
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $loggedUser;
  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $config
   *   A configuration array which contains the information about the plugin instance.
   * @param string $module_id
   *   The module_id for the plugin instance.
   * @param mixed $module_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A currently logged user instance.
   */
  public function __construct(
    array $config,
    $module_id,
    $module_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user) {
    parent::__construct($config, $module_id, $module_definition, $serializer_formats, $logger);

    $this->loggedUser = $current_user;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $config, $module_id, $module_definition) {
    return new static(
      $config,
      $module_id,
      $module_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('custom_rest_api'),
      $container->get('current_user')
    );
  }
  /**
   * Responds to GET request.
   * Returns name of currently loggedin user.
   */
  public function get() {
    
    // Use currently logged user after passing authentication.
    if (!$this->loggedUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    } 

    // Load user object with current user id
    $account = \Drupal\user\Entity\User::load($this->loggedUser->id());
    $output['username'] = $account->get('name')->value;

    $response = new ResourceResponse($output);
    $response->addCacheableDependency($output);
    return $response;
  }

}
