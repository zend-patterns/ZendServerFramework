<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Codetracing;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class CodetracingList extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'codetracingList';
		$this->addParameter(new ApiParameter('application', ApiParameter::TYPE_ARRAY));
		$this->addParameter(new ApiParameter('freetext', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('type', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('limit', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('offset', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('orderBy', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
	}
}