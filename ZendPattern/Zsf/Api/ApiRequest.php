<?php
namespace ZendPattern\Zsf\Api;

use Zend\Http\Request;
use ZendPattern\ZSWebAPI2\Api\Key\Key;

class ApiRequest extends Request
{
	/**
	 * Zend Server
	 * 
	 * @var ServerInterferface
	 */
	protected $server;
	
	/**
	 * Api key 
	 * 
	 * @var Key
	 */
	protected $apiKeyName;
	
	
	/**
	 * Output type
	 * 
	 * @var string
	 */
	protected $outputType;
	
	/**
	 * Retunr api key
	 * 
	 * @return Key
	 */
	public function getApiKey()
	{
		return $this->server->getKeyManager()->getApiKey($this->apiKeyName);
	}
	
	/**
	 * @return the $server
	 */
	public function getServer() {
		return $this->server;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Api\ServerInterferface $server
	 */
	public function setServer($server) {
		$this->server = $server;
	}
	
	/**
	 * @return the $apiKeyName
	 */
	public function getApiKeyName() {
		return $this->apiKeyName;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Api\Key $apiKeyName
	 */
	public function setApiKeyName($apiKeyName) {
		$this->apiKeyName = $apiKeyName;
	}
	
	/**
	 * @return the $outputType
	 */
	public function getOutputType() {
		return $this->outputType;
	}

	/**
	 * @param string $outputType
	 */
	public function setOutputType($outputType) {
		$this->outputType = $outputType;
	}

}