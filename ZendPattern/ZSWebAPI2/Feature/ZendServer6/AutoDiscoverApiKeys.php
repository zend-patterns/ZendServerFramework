<?php
namespace ZendPattern\ZSWebAPI2\Feature\ZendServer6;

use ZendPattern\ZSWebAPI2\Feature\FeatureAbstract;
use ZendPattern\ZSWebAPI2\Api\Key\KeyManager;
use ZendPattern\ZSWebAPI2\Api\Key\Key;

class AutoDiscoverApiKeys extends FeatureAbstract
{
	/**
	 *  Constructor
	 */
	public function __construct()
	{
		$this->setDependencies(array(
			'ZendPattern\ZSWebAPI2\Api\Service\ZendServer\ApiKeysGetList'
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$keyManager = new KeyManager();
		$apiKeyList = $this->server->apiKeysGetList()->getXmlContent();
		foreach ($apiKeyList->responseData->apiKeys->apiKey as $apiKey){
			$id = (string) $apiKey->id;
			$name = (string) $apiKey->name;
			$hash = (string) $apiKey->hash;
			$username = (string) $apiKey->username;
			$creationTime = (string) $apiKey->creationtime;
			$key = new Key($name, $hash,$username,$id,$creationTime);
			$keyManager->addApiKey($key,($name == 'admin'));
		}
		$this->server->setKeyManager($keyManager);
	}
}