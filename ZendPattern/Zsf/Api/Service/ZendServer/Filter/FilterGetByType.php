<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Filter;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class FilterGetByType extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'filterGetByType';
		$this->addParameter(new ApiParameter('type', ApiParameter::TYPE_STRING,true));
	}
}