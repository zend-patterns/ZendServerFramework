<?php
namespace ZendPattern\ZSWebAPI2\Feature\ZendServer6;

use ZendPattern\ZSWebAPI2\Feature\FeatureAbstract;
use ZendPattern\ZSWebAPI2\Api\Key\Key;

class AutoDiscover extends FeatureAbstract
{
	/**
	 *  Constructor
	 */
	public function __construct()
	{
		$this->setDependencies(array(
				'ZendPattern\ZSWebAPI2\Feature\ZendServer6\AutoDiscoverApiKeys'
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$adminHash = $args[0];
		$adminKey = new Key('admin', $adminHash);
		$this->server->getKeyManager()->addApiKey($adminKey);
		$info = $this->server->getSystemInfo();
		$systemInfo = $info->getXmlContent()->responseData->systemInfo;
		$edition = (string) $systemInfo->edition;
		$version = (string) $systemInfo->zendServerVersion;
		$this->server->setVersion($version);
		$this->server->setEdition($edition);
		$this->server->autoDiscoverApiKeys();
	}
}
