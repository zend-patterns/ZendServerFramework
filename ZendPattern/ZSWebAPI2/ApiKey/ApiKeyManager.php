<?php
namespace ZendPattern\ZSWebAPI2\ApiKey;

use ZendPattern\ZSWebAPI2\Exception\Exception;

class ApiKeyManager
{
	/**
	 * Api keys
	 * 
	 * @var array
	 */
	protected $apiKeys = array();
	
	/**
	 * Name of an admin Api Key
	 * 
	 * @var string
	 */
	protected $adminApiKeyName = 'admin';
	
	/**
	 * Add an Api ey
	 * 
	 * @param ApiKey $apikey
	 * @param boolean $isAdmin
	 */
	public function addApiKey(ApiKey $apikey,$isAdmin = false)
	{
		$keyName = $apikey->getName();
		$this->apiKeys[$keyName] = $apikey;
		if ($isAdmin || count($this->apiKeys) == 1) $this->adminApiKeyName = $keyName;
	}
	
	/**
	 * Remove an Api key
	 * 
	 * @param unknown $keyName
	 */
	public function removeApiKey($keyName)
	{
		unset($this->apiKeys[$keyName]);
	}
	
	/**
	 * Get Api key
	 * 
	 * @param string $keyName
	 * @throws Exception
	 * @return multitype:
	 */
	public function getApiKey($keyName)
	{
		if ( ! isset($this->apiKeys[$keyName])) throw new Exception('Requested api does\'nt exixsts : ' . $keyName);
		return $this->apiKeys[$keyName];
	}
	
	/**
	 * Get admin api key
	 * 
	 * @return ApiKey
	 */
	public function getAdminApiKey()
	{
		return $this->getApiKey($this->adminApiKeyName);
	}
	
	/**
	 * Configure Api Manager
	 * 
	 * @param array $config
	 * @throws Exception
	 */
	public function setConfig($config)
	{
		foreach ($config as $keyName => $keyConfig){
			$username = (isset($keyConfig['username']))?$keyConfig['username']:null;
			$id = (isset($keyConfig['id']))?$keyConfig['id']:null;
			$creationTime = (isset($keyConfig['creation-time']))?$keyConfig['creation-time']:null;
			$apiKey = new ApiKey($keyName,$keyConfig['hash'],$username,$id,$creationTime);
			if ( ! $apiKey) throw new Exception('Can\'t genrate api key ' . $keyName);
			$this->addApiKey($apikey);
		}
	}
}