<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Api\Service\ZendServer\GetSystemInfo;
use ZendPattern\Zsf\Feature\ZendServer6\AutoDiscover;

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
	public function __construct($version = '6.0.0' ,$edition = self::EDITION_SMB,$rootUri = WebInterface::DEFAULT_HOST,$apiPath = WebInterface::DEFAULT_API_PATH)
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
		$this->addFeature(new AutoDiscover());
		$this->addFeature(new GetSystemInfo());
	}
}