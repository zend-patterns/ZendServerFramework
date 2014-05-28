<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Deployment;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ApplicationgetDetails extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'applicationgetDetails';
		$this->addParameter(new ApiParameter('application', ApiParameter::TYPE_INTEGER,true));
	}
}