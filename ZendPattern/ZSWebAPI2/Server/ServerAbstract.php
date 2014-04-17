<?php
namespace ZendPattern\ZSWebAPI2\Server;

use ZendPattern\ZSWebAPI2\Feature\FeatureSet;
use ZendPattern\ZSWebAPI2\Feature\FeatureInterface;
use ZendPattern\ZSWebAPI2\Core\Version;
use ZendPattern\ZSWebAPI2\Api\Key\KeyManager;

abstract class ServerAbstract implements ServerInterface
{
	/**
	 * Web interface
	 * 
	 * @var WebInterface
	 */
	protected $webInterface;
	
	/**
	 * Zend Server version
	 * 
	 * @var Version
	 */
	protected $version;
	
	/**
	 * Api version supported by server
	 * 
	 * @var string
	 */
	protected $apiVersion;
	
	/**
	 * Zend Server edition
	 * 
	 * @var string
	 */
	protected $edition;
	
	/**
	 * Zend Server Feature Set
	 * 
	 * @var FeatureSet
	 */
	protected $featureSet;
	
	/**
	 * Api Keys manager
	 * 
	 * @var KeyManager
	 */
	protected $keyManager;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getVersion()
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getApiVersion()
	 */
	public function getApiVersion()
	{
		if ($this->apiVersion) return $this->apiVersion;
		$config = include __DIR__ . '/../Config/api.versions.config.php';
		if ( ! isset($config[$this->version])) throw new Exception('no API define for Zend Server ' . $this->version);
		$this->apiVersion = $config[$this->version];
		return $this->apiVersion;
	}
	
	/**
	 * @return the $edition
	 */
	public function getEdition() {
		return $this->edition;
	}
	
	/**
	 * @return the $featureSet
	 */
	public function getFeatureSet() {
		return $this->featureSet;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Feature\FeatureSet $featureSet
	 */
	public function setFeatureSet($featureSet) {
		$this->featureSet = $featureSet;
	}
	
	/**
	 * Adding feature
	 * 
	 * @param FeatureInterface $feature
	 */
	public function addFeature(FeatureInterface $feature)
	{
		$feature->setServer($this);
		$this->getFeatureSet()->addFeature($feature);
	}
	
	/**
	 * @return the $webInterface
	 */
	public function getWebInterface() {
		return $this->webInterface;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Server\WebInterface $webInterface
	 */
	public function setWebInterface($webInterface) {
		$this->webInterface = $webInterface;
	}
	
	/**
	 * @param string $edition
	 */
	public function setEdition($edition) {
		$this->edition = $edition;
	}
	
	/**
	 * Calling features
	 * 
	 * @param string $method
	 * @param unknown $args
	 */
	public function __call($method,$args)
	{
		if ($this->featureSet->hasFeature($method)) {
			$feature = $this->featureSet->get($method);
			return $feature($args);
		}
	}
	
	/**
	 * Check if edition is compatible with version
	 */
	abstract protected function checkEditionValidity();
	
	/**
	 * Get Key manager
	 * 
	 * @return KeyManager
	 */
	public function getKeyManager() {
		return $this->keyManager;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Api\Key\KeyManager $keyManager
	 */
	public function setKeyManager($keyManager) {
		$this->keyManager = $keyManager;
	}

}