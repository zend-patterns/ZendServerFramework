<?php
namespace ZendPattern\ZSWebAPI2\Target;

use ZendPattern\ZSWebAPI2\Server\Server;
use ZendPattern\ZSWebAPI2\ApiKey\ApiKey;

interface TargetInterface
{
	/**
	 * Get internal Zend Server
	 * 
	 * @return ServerInterface
	 */
	public function getServer();
	
	/**
	 * Get internal Api Key
	 * 
	 * @return ApiKey
	 */
	public function getApiKey($key);
}