<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Configuration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ConfigurationValidateDirectives extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'configurationValidateDirectives';
		$this->addParameter(new ApiParameter('directive', ApiParameter::TYPE_ARRAY,true));
	}
}