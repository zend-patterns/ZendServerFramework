<?php
namespace ZendPattern\ZSWebAPI2\Target;

use ZendPattern\ZSWebAPI2\Server\ServerInterface;
use ZendPattern\ZSWebAPI2\ApiKey\ApiKey;
use ZendPattern\ZSWebAPI2\ApiKey\ApiKeyManager;

class Target extends TargetAbstract
{
	/**
	 * Constructor
	 * 
	 * @param ServerInterface $server
	 * @param ApiKey $apiKey
	 */
	public function __construct(ServerInterface $server, ApiKey $apiKey = null)
	{
		$this->setServer($server);
		$this->setApiKeyManager(new ApiKeyManager());
		if ($apiKey) $this->getApiKeyManager()->addApiKey($apiKey);
	}
}