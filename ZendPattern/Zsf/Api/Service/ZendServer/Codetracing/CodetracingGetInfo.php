<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Codetracing;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class CodetracingGetInfo extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'codetracingGetInfo';
		$this->addParameter(new ApiParameter('id', ApiParameter::TYPE_STRING,true));
	}
}