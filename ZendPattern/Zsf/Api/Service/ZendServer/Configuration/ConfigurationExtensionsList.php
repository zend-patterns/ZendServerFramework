<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Configuration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ConfigurationExtensionsList extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'configurationExtensionsList';
		$this->addParameter(new ApiParameter('type', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('order', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_STRING));
	}
}