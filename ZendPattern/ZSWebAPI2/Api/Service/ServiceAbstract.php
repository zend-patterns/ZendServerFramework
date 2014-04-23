<?php
namespace ZendPattern\ZSWebAPI2\Api\Service;

use ZendPattern\ZSWebAPI2\Feature\FeatureAbstract;
use ZendPattern\ZSWebAPI2\Api\ApiRequest;
use ZendPattern\ZSWebAPI2\Api\Client\ApiClientInterface;
use ZendPattern\ZSWebAPI2\Api\Client\ApiClient;
use ZendPattern\ZSWebAPI2\Api\Key\Key;
use Zend\Http\Response;
use ZendPattern\ZSWebAPI2\Exception\Exception;
use ZendPattern\ZSWebAPI2\Api\Response\ResponseXml;
use ZendPattern\ZSWebAPI2\Api\ApiParameter;
use Zend\Stdlib\Parameters;

abstract class ServiceAbstract extends FeatureAbstract
{
	const HTTP_METHOD_GET = 'GET';
	const HTTP_METHOD_POST = 'POST';
	
	const OUTPUT_TYPE_XML = 'xml';
	
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
	 * Output type
	 * 
	 * @var string
	 */
	protected $outputType = self::OUTPUT_TYPE_XML;

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
		$request->setOutputType($this->outputType);
		$apiUri = $this->server->getWebInterface()->getApiUri();
		$request->setUri($apiUri);
		$path = $request->getUri()->getPath();
		$path .= '/' . trim($this->uriPath,'/');
		$request->getUri()->setPath($path);
		$this->setGetParameters($request);
		$this->setPostParameters($request);
		if ($this->outputType == self::OUTPUT_TYPE_XML){
			$response = new ResponseXml();
		}
		$client = $this->getHttpClient();
		$client->setResponse($response);
		$client->setRequest($request);
		$response = $client->send();
		if ( ! $response->isSuccess()){
			$message  = 'URI: ' . $request->getUri()->toString();
			$message .= ' - Error: ' . $response->getErrorCode();
			$message .= ' - Reason: ' . $response->getErrorMessage();
			$message .= ' - ' . $response->getBody();
			throw new Exception($message);
		}
		return $response;
	}
	
	/**
	 * Set GET query parameters
	 * 
	 * @param ApiRequest
	 */
	protected function setGetParameters(ApiRequest $request)
	{
		if ( ! $request->isGet() ||count($this->parameters) == 0) return;
		$query = new Parameters();
		foreach ($this->parameters as $name => $param){
			if ($param->isScalar()){
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
		foreach ($this->parameters as $name => $param)
		{
			if ( ! array_key_exists($name,$this->parameters)) throw new Exception($name . ' is not allowed');
			if ($param->isRequired() &&  ! isset($args[$name])) throw new Exception($name . ' is required');
			$this->parameters[$name]->setValue($args[$name]);
		}
	}
}