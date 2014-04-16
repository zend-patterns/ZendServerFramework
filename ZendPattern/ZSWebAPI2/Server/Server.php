<?php
namespace ZendPattern\ZSWebAPI2\Server;

use Zend\Feed\Uri;
use ZendPattern\ZSWebAPI2\Feature\FeatureSet;

class Server extends ServerAbstract
{
	/**
	 * Zend Server Factory
	 * 
	 * @param string $version
	 * @param string $rootUri
	 * @param string $apiPath
	 * @param string $class : Server class
	 */
	public static function factory($version,$rootUri = 'http://localhost:10081',$apiPath = 'ZendServer/Api', $class = null)
	{
		if ( ! $class) $server = new self($version, $rootUri,$apiPath);
		else $server = new $class($version, $rootUri,$apiPath);
		return $server;
	}
	
	/**
	 * Constructor
	 * @param unknown $version
	 * @param string $rootUri
	 * @param string $apiPath
	 */
	public function __construct($version,$rootUri = 'http://localhost:10081',$apiPath = 'ZendServer/Api')
	{
		$this->setVersion($version);
		$rootUri = new Uri($rootUri);
		$this->setRootUri($rootUri);
		$this->setApiPath($apiPath);
		$this->setFeatureSet(new FeatureSet());
		if (method_exists($this, 'init')) $this->init();
	}
}