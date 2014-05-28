<?php
namespace ZendPattern\Zsf\Feature;

use ZendPattern\Zsf\Server\ServerInterface;
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
	 * List of dependent feature
	 * 
	 * @var array
	 */
	protected $dependencies = array();
	
	/**
	 * Feature name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Empty constrcutor by default
	 */
	public function __construct()
	{
		
	}
	
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
		if ($this->name) return $this->name;
		if ( ! preg_match('@\\\\@',get_class($this))) {
			$this->name = strtolower(get_class($this));
			return $this->name;
		}
		$tmp = array_reverse(preg_split('@\\\\@', get_class($this)));
		$this->name = strtolower($tmp[0]);
		return $this->name;
	}

	/**
	 * @return the $dependecies
	 */
	public function getDependencies() {
		return $this->dependencies;
	}
	
	/**
	 * @param multitype: $dependecies
	 */
	public function setDependencies($dependencies) {
		$this->dependencies = $dependencies;
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
	public function getResourceId()
	{
		return $this->getName();
	}

}