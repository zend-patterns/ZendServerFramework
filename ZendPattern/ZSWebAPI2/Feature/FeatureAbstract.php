<?php
namespace ZendPattern\ZSWebAPI2\Feature;

use ZendPattern\ZSWebAPI2\Server\ServerInterface;
use Zend\Permissions\Acl\Resource\ResourceInterface;

abstract class FeatureAbstract implements FeatureInterface, ResourceInterface
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
		return strtolower($this->name);
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = strtolower($name);
	}
	
	/**
	 * Magical invoke
	 * 
	 * @param array $args
	 */
	abstract public function __invoke($args);
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Permissions\Acl\Resource\ResourceInterface::getResourceId()
	 */
	abstract public function getResourceId();

}