<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Administration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;

class ApiKeysGetList extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'apiKeysGetList';
		$this->parameters = array();
	}
}