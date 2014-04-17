<?php
namespace ZendPattern\ZSWebAPI2\Server;

use Zend\Uri\Http;

class WebInterface
{
	/**
	 * Zend Server root Uri
	 * 
	 * @var Uri
	 */
	protected $rootUri;
	
	/**
	 * Web API path
	 * 
	 * @var string
	 */
	protected $apiPath;
	
	/**
	 * Constructor
	 * 
	 * @param string $rootUri :
	 * @param unknown $apiPath
	 */
	public function __construct($rootUri = 'http://localhost:10081', $apiPath = 'ZendServer/Api')
	{
		$rootUri = new Http($rootUri);
		$this->setRootUri($rootUri);
		$this->setApiPath($apiPath);
	}
	
	/**
	 * @param string $apiPath
	 */
	public function setApiPath($apiPath) {
		$this->apiPath = trim($apiPath,'/');
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
}