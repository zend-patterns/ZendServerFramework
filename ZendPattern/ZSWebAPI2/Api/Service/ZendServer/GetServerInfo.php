<?php

namespace ZendPattern\ZSWebAPI2\Api\Service\ZendServer;

use ZendPattern\ZSWebAPI2\Api\Service\ServiceAbstract;
use ZendPattern\ZSWebAPI2\Api\ApiParameter;

class GetServerInfo extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->name = 'getServerInfo';
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = $this->name;
		$this->addParameter(new ApiParameter('serverId', ApiParameter::TYPE_INTEGER));
	}
}