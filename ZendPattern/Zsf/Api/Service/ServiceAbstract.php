<?php
namespace ZendPattern\Zsf\Api\Service;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Api\ApiRequest;
use ZendPattern\Zsf\Api\Client\ApiClientInterface;
use ZendPattern\Zsf\Api\Client\ApiClient;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\Response\ResponseApi;
use ZendPattern\Zsf\Api\ApiParameter;
use Zend\Stdlib\Parameters;
use ZendPattern\Zsf\Api\Response\ResponseAbstract;
use ZendPattern\Zsf\Api\Response\ResponseXml;

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
	 * Parameter
	 * 
	 * @var array of ApiParameter
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
	 * Http client
	 * 
	 * @var ApiClientClient
	 */
	protected $httpClient;
	
	/**
	 * Api Key name
	 * 
	 * @var string
	 */
	protected $apiKeyName = 'admin';
	
	/**
	 * Response prototype
	 * 
	 * @var ResponseAbstract
	 */
	protected $responsePrototype;

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::getResourceId()
	 */
	public function getResourceId()
	{
		$resourceId = $this->getName() . '-' . $this->server->getApiVersion();
		return $resourceId;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 * 
	 * @param array   0	: service parameters
	 * @param string  1	: api key name
	 * @param Client  2	: Api client to use
	 * @return Response;
	 */
	public function __invoke($args)
	{
		if (isset($args[1])) $this->setApiKeyName($args[1]);
		if (isset($args[2])) $this->setHttpClient($args[2]);
		if (isset($args[0])) $this->setParameters($args[0]);
		$request = new ApiRequest();
		$request->setServer($this->server);
		$request->setMethod($this->httpMethod);
		$request->setApiKeyName($this->apiKeyName);
		$apiUri = $this->server->getWebInterface()->getApiUri();
		$request->setUri($apiUri);
		$path = $request->getUri()->getPath();
		$path .= '/' . trim($this->uriPath,'/');
		$request->getUri()->setPath($path);
		$this->setGetParameters($request);
		$this->setPostParameters($request);
		$response = $this->getResponsePrototype();
		$client = $this->getHttpClient();
		$client->setResponse($response);
		$client->setRequest($request);
		$response = $client->send();
		$responseStrategies = array('xml','file');
		foreach ($responseStrategies as $prefix){
			$strategie = $prefix . 'ResponseStrategy';
			$result = $this->$strategie($response);
			if ($result) return $result;
		}
		throw new Exception('Cannot manage API response');
	}
	
	/**
	 * Manage Xml api response
	 * 
	 * @param ResponseApi $response
	 * @throws Exception
	 * @return void|unknown
	 */
	protected function xmlResponseStrategy($response)
	{
		$contentType = $response->getHeaders()->get('Content-Type')->getFieldValue();
		if (preg_match('@^application/vnd\.zend\.serverapi\+xml@', $contentType) != 1) return;
		if ( ! $response->isSuccess()){
			$message  = ' - Error: ' . $response->getApiErrorCode();
			$message .= ' - Reason: ' . $response->getApiErrorMessage();
			$message .= ' - ' . $response->getBody();
			throw new Exception($message);
		}
		return $response;
	}
	
	/**
	 * Manage file api response
	 * 
	 * @param reposneApi $response
	 */
	protected function fileResponseStrategy($response)
	{
		$contentType = $response->getHeaders()->get('Content-Type')->getFieldValue();
		if ($contentType == 'application/zip') return $response;
		if ($contentType == 'application/x-amf') return $response;
	}
	
	/**
	 * Set GET query parameters
	 * 
	 * @param ApiRequest
	 */
	protected function setGetParameters(ApiRequest $request)
	{
		if ( ! $request->isGet() || count($this->parameters) == 0) return;
		$query = new Parameters();
		foreach ($this->parameters as $name => $param){
			if ($param->isScalar()){
				if ($param->getValue() === null) continue;
				$query->set($name, $param->getValue());
			}
		}
		$request->setQuery($query);
	}
	
	/**
	 * Set POST parameter
	 * 
	 * @param ApiRequest
	 */
	protected function setPostParameters(ApiRequest $request)
	{
		if ( ! $request->isPost() ||count($this->parameters) == 0) return;
		$post = new Parameters();
		foreach ($this->parameters as $name => $param){
			if ($param->isScalar()){
				$post->set($name, $param->getValue());
			}
		}
		$request->setPost($post);
	} 
	
	/**
	 * Set custom Api Client
	 * 
	 * @param ApiClientInterface $client
	 */
	public function setHttpClient(ApiClientInterface $client)
	{
		$this->client = $client;
	}
	
	/**
	 * Get Http client
	 * 
	 * @return ApiClientInterface
	 */
	protected function getHttpClient()
	{
		if ($this->httpClient) return $this->httpClient;
		$this->httpClient = new ApiClient();
		return $this->httpClient;
	}
	
	/**
	 * Set api key name tu use
	 * 
	 * @param string $keyName
	 */
	public function setApiKeyName($keyName)
	{
		$this->apiKeyName = $keyName;
	}
	
	/**
	 * get Api key
	 * 
	 * @return Key
	 */
	protected function getApiKeyName()
	{
		return $this->apiKeyName;
	}
	
	/**
	 * Add parameter
	 * 
	 * @param ApiParameter $apiParameter
	 */
	public function addParameter(ApiParameter $apiParameter)
	{
		$this->parameters[$apiParameter->getName()] = $apiParameter;
	}
	
	/**
	 * Set parameters
	 * 
	 * @param array $args
	 */
	protected function setParameters($args)
	{
		foreach ($args as $name => $value){
			if ( ! array_key_exists($name,$this->parameters)) throw new Exception($name . ' is not allowed');
		}
		foreach ($this->parameters as $name => $param)
		{
			if ($param->isRequired() &&  ! isset($args[$name])) throw new Exception($name . ' is required');
			if (isset($args[$name])) $this->parameters[$name]->setValue($args[$name]);
		}
	}
	
	/**
	 * @return the $responsePrototype
	 */
	public function getResponsePrototype() {
		if ($this->responsePrototype) return $this->responsePrototype;
		$this->responsePrototype = new ResponseXml();
		return $this->responsePrototype;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Response\ResponseAbstract $responsePrototype
	 */
	public function setResponsePrototype($responsePrototype) {
		$this->responsePrototype = $responsePrototype;
	}

}