<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Configuration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ConfigurationDirectivesList extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'configurationDirectivesList';
		$this->addParameter(new ApiParameter('extension', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('daemon', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_STRING));
	}
}