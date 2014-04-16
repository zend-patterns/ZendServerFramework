<?php

namespace ZendPattern\ZSWebAPI2\ApiService\Basic;

use ZendPattern\ZSWebAPI2\ApiService\ServiceAbstract;

class GetSytemInfo extends ServiceAbstract
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
		$this->uriPath = 'getSytemInfo';
		$this->parameters = array();
	}
}