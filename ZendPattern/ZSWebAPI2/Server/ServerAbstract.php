<?php
namespace ZendPattern\ZSWebAPI2\Server;

use Zend\Uri\Uri;
use ZendPattern\ZSWebAPI2\Feature\FeatureSet;
use ZendPattern\ZSWebAPI2\Feature\FeatureInterface;
abstract class ServerAbstract implements ServerInterface
{
	/**
	 * Zend Server root Uri
	 * 
	 * @var Uri
	 */
	protected $rootUri;
	
	/**
	 * Zend Server version
	 * 
	 * @var string
	 */
	protected $version;
	
	/**
	 * Web API path
	 * 
	 * @var string
	 */
	protected $apiPath;
	
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
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getVersion()
	 */
	public function getVersion()
	{
		return $this->version;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getApiUri()
	 */
	public function getApiUri()
	{
		$uri = clone $this->rootUri;
		$rootPath = rtrim($this->rootUri->getPath(), '/');
		$uri->setPath($rootPath . '/' . $this->apiPath);
		return $uri;
	}

	/**
	 * @param string $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}
	
	/**
	 * @param string $apiPath
	 */
	public function setApiPath($apiPath) {
		$this->apiPath = trim($apiPath,'/');
	}
	
	/**
	 * @return the $rootUri
	 */
	public function getRootUri() {
		return $this->rootUri;
	}

	/**
	 * @param \Zend\Uri\Uri $rootUri
	 */
	public function setRootUri($rootUri) {
		$this->rootUri = $rootUri;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getApiVersion()
	 */
	public function getApiVersion()
	{
		if ($this->apiVersion) return $this->apiVersion;
		$config = include __DIR__ . '/../config/api.version.config.php';
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
}