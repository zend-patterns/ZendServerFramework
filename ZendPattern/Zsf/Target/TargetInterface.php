<?php
namespace ZendPattern\Zsf\Target;

use ZendPattern\Zsf\Server\Server;
use ZendPattern\Zsf\ApiKey\ApiKey;

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