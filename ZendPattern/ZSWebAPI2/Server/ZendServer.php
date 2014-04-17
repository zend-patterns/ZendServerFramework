<?php
namespace ZendPattern\ZSWebAPI2\Server;

use ZendPattern\ZSWebAPI2\Feature\FeatureSet;
use ZendPattern\ZSWebAPI2\Exception\Exception;
use ZendPattern\ZSWebAPI2\Api\Key\KeyManager;

class ZendServer extends ServerAbstract
{
	/**
	 * Constructor
	 * @param unknown $version
	 * @param string $rootUri
	 * @param string $apiPath
	 */
	public function __construct($version,$edition,$rootUri = 'http://localhost:10081',$apiPath = 'ZendServer/Api')
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
		return true;
	}
}