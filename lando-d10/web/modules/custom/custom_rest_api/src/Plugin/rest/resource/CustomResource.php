<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Component\Serialization\Json;


/**
 * Provides Clearplus Results Resource
 *
 * @RestResource(
 *   id = "custom_resource",
 *   label = @Translation("Custom Resource"),
 *   uri_paths = {
 *     "canonical" = "/custom_rest_api1/custom_resource",
       "create" = "/custom_rest_api1/custom_resource"
 *   }
 * )
 */

class CustomResource extends ResourceBase{
	
	public function post(Request $request) {
	    $query = \Drupal::request()->query;
	    $response = [];
	    $params = Json::decode($request->getContent());
	    extract($params);
	    if($name!='' && $email!=''){
	      $response["ServerMsg"]=[ 
	          "your_name" => $name,
	          "your_email" => $email,
	          "Msg" => "SUCCESS",
	          "DisplayMsg" => "Rest message for post"
	      ];
	    }
	    else{
	      $response["ServerMsg"]=[ 
	          "Msg" => "Failure",
	          "DisplayMsg" => "Rest message for post",
	          "DisplayMsg1" => "Name & Email is required"
	      ];
	    }
	    return new ResourceResponse($response);
	}
}