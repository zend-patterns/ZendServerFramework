<?php
namespace ZendPattern\Zsf\Target;

use ZendPattern\Zsf\Server\ServerInterface;
use ZendPattern\Zsf\ApiKey\ApiKey;
use ZendPattern\Zsf\ApiKey\ApiKeyManager;

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