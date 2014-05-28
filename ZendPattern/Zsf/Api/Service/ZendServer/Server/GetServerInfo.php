<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Server;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class GetServerInfo extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'getServerInfo';
		$this->addParameter(new ApiParameter('serverId', ApiParameter::TYPE_INTEGER));
	}
}