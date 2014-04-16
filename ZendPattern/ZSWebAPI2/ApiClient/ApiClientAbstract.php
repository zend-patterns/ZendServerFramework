<?php
namespace ZendPattern\ZSWebAPI2\ApiClient;

use Zend\Http\Client;

abstract class ApiClientAbstract
{
	/**
	 * 
	 * @var Zend\
	 */
	protected $httpClient;
	
	/**
	 * @return the $httpClient
	 */
	public function getHttpClient() {
		return $this->httpClient;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\ApiClient\Zend\ $httpClient
	 */
	public function setHttpClient($httpClient) {
		$this->httpClient = $httpClient;
	}

	
}