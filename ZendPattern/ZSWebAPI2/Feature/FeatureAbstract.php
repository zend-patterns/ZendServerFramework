<?php
namespace ZendPattern\ZSWebAPI2\Feature;

use ZendPattern\ZSWebAPI2\Server\ServerInterface;

abstract class FeatureAbstract implements FeatureInterface
{
	/**
	 * Zend Server
	 * 
	 * @var ServerInterface
	 */
	protected $server;
	
	/**
	 * Feature name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * @return the $server
	 */
	public function getServer() {
		return $this->server;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Feature\ServerInterface $server
	 */
	public function setServer(ServerInterface $server) {
		$this->server = $server;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureInterface::getName()
	 */
	public function getName()
	{
		return $this->name;
	}
}