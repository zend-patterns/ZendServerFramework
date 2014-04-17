<?php

namespace ZendPattern\ZSWebAPI2\Api\Service\ZendServer;

use ZendPattern\ZSWebAPI2\Api\Service\ServiceAbstract;

class GetSystemInfo extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->name = 'getSystemInfo';
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = $this->name;
		$this->parameters = array();
	}
}