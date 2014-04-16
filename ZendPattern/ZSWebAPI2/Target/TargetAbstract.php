<?php
namespace ZendPattern\ZSWebAPI2\Target;

abstract class TargetAbstract implements TargetInterface
{
	/**
	 * Zend Server
	 * 
	 * @var ServerInterface
	 */
	protected $server;
	
	/**
	 * Api key manager
	 * 
	 * @var ApiKeyManager
	 */
	protected $apiKeyManager;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Target\TargetInterface::getServer()
	 */
	public function getServer() {
		return $this->server;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Target\TargetInterface::getApiKey()
	 */
	public function getApiKey($key = null) {
		if ( ! $key) return $this->getApiKeyManager()->getAdminApiKey();
		return $this->getApiKeyManager()->getApiKey($key);
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Target\ServerInterface $server
	 */
	public function setServer($server) {
		$this->server = $server;
	}
	
	/**
	 * @param \ZendPattern\ZSWebAPI2\Target\ApiKeyManager $apiKeyManager
	 */
	public function setApiKeyManager($apiKeyManager) {
		$this->apiKeyManager = $apiKeyManager;
	}
	
	/**
	 * @return the $apiKeyManager
	 */
	public function getApiKeyManager() {
		return $this->apiKeyManager;
	}
}