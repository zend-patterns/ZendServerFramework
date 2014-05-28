<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Deployment;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ApplicationGetStatus extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'applicationGetStatus';
		$this->addParameter(new ApiParameter('applications', ApiParameter::TYPE_ARRAY));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
	}
}