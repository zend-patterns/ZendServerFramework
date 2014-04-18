<?php
namespace ZendPattern\ZSWebAPI2\Server;

use ZendPattern\ZSWebAPI2\Feature\FeatureSet;
use ZendPattern\ZSWebAPI2\Exception\Exception;
use ZendPattern\ZSWebAPI2\Api\Key\KeyManager;
use ZendPattern\ZSWebAPI2\Api\Key\Key;
use ZendPattern\ZSWebAPI2\Api\Service\ZendServer\GetSystemInfo;
use ZendPattern\ZSWebAPI2\Api\Service\ZendServer\ApiKeysGetList;

class ZendServer6 extends ServerAbstract
{
	const EDITION_FREE = 'free';
	const EDITION_SMB = 'smb';
	const EDITION_PRO = 'pro';
	const EDITION_ENTERPRISE = 'ZendServerCluster';
	
	/**
	 * Constructor
	 * 
	 * @param string $version
	 * @param string $rootUri
	 * @param string $apiPath
	 */
	public function __construct($version,$edition,$rootUri = WebInterface::DEFAULT_HOST,$apiPath = WebInterface::DEFAULT_API_PATH)
	{
		$this->setVersion($version);
		$this->setEdition($edition);
		if ( ! $this->checkEditionValidity()) 
			throw new Exception ($edition . ' is not available for Zend Server ' . $version);
		$this->setKeyManager(new KeyManager());
		$this->setWebInterface(new WebInterface($rootUri,$apiPath));
		$this->setFeatureSet(new FeatureSet());
		if (method_exists($this, 'init')) $this->init();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerAbstract::checkEditionValidity()
	 */
	protected function checkEditionValidity()
	{
		$available_editions = array(self::EDITION_FREE, self::EDITION_ENTERPRISE, self::EDITION_PRO, self::EDITION_SMB);
		return in_array($this->edition, $available_editions);
	}
	
	/**
	 * Initiate Zedn Server minimal features
	 */
	protected function init()
	{
		$this->addFeature(new ApiKeysGetList());
		$this->addFeature(new GetSystemInfo());
	}
	
	/**
	 * Discover Api Keys
	 */
	public function discoverApiKeys()
	{
		$keyManager = new KeyManager();
		$apiKeyList = $this->apiKeysGetList()->getXmlContent();
		foreach ($apiKeyList->responseData->apiKeys->apiKey as $apiKey){
			$id = (string) $apiKey->id;
			$name = (string) $apiKey->name;
			$hash = (string) $apiKey->hash;
			$username = (string) $apiKey->username;
			$creationTime = (string) $apiKey->creationtime;
			$key = new Key($name, $hash,$username,$id,$creationTime);
			$keyManager->addApiKey($key,($name == 'admin'));
		}
		$this->setKeyManager($keyManager);
	}
	
	/**
	 * Generate Zend Server by autodiscovering
	 * 
	 * @param string $adminHash : hash of the admin key.
	 * @return \ZendPattern\ZSWebAPI2\Server\ZendServer
	 */
	static public function autoDiscover($adminHash,$rootUri = WebInterface::DEFAULT_HOST,$apiPath = WebInterface::DEFAULT_API_PATH)
	{
		$server = new self('6.0',self::EDITION_SMB,$rootUri,$apiPath);
		$adminKey = new Key('admin', $adminHash);
		$server->getKeyManager()->addApiKey($adminKey);
		$info = $server->getSystemInfo();
		$systemInfo = $info->getXmlContent()->responseData->systemInfo;
		$edition = (string) $systemInfo->edition;
		$version = (string) $systemInfo->ZendServerVersion;
		$server->setVersion($version);
		$server->setEdition($edition);
		$server->discoverApiKeys();
		return $server;
	}
}