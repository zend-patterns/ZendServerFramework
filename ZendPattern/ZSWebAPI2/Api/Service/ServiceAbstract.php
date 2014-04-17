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
	 * Required parameters names
	 * 
	 * @var array
	 */
	protected $requiredParams = array();
	
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
	 * Constructor
	 */
	abstract public function __construct();
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 * @return Response;
	 */
	public function __invoke($args)
	{
		//if ( ! $args) return $this;
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
			//$message .= ' - ' . $response->getBody();
			throw new Exception($message);
		}
		return $response;
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
	
	protected function setParameters($args)
	{
	}
	
	protected function setParameter($name, ApiParameter $param)
	{
		$this->parameters[$name] = $param;
	}
}