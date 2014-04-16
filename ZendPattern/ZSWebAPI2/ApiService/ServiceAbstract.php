<?php
namespace ZendPattern\ZSWebAPI2\ApiService;

use ZendPattern\ZSWebAPI2\Feature\FeatureAbstract;
use ZendPattern\ZSWebAPI2\ApiClient\ApiRequest;

abstract class ServiceAbstract extends FeatureAbstract
{
	const HTTP_METHOD_GET = 'GET';
	const HTTP_METHOD_POST = 'POST';
	const PERMISSION_READ = 'read';
	
	/**
	 * HTTP method GET | POST
	 * 
	 * @var string
	 */
	protected $httpMethod;
	
	/**
	 * Required parameters names
	 * 
	 * @var array
	 */
	protected $requiredParams = array();
	
	/**
	 * Parameters
	 * 
	 * @var array
	 */
	protected $parameters = array();
	
	/**
	 * Required permission
	 * 
	 * @var string
	 */
	protected $requiredPermission;
	
	/**
	 * Uri path of service
	 * 
	 * @var string
	 */
	protected $uriPath;
	
	/**
	 * Constructor
	 */
	abstract public function __construct();
	
	
	/**
	 * Generate the api request
	 * 
	 * @return \ZendPattern\ZSWebAPI2\ApiClient\ApiRequest
	 */
	protected function getRequest()
	{
		$request = new ApiRequest();
		$request->setMethod($this->httpMethod);
		$path = $this->server->getApiUri()->getPath();
		$path .= '/' . trim($this->uriPath,'/');
		$request->getUri()->setPath($path);
		return $request;
	}
}