<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\JobQueue;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class JobqueueRuleInfo extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'jobqueueRuleInfo';
		$this->addParameter(new ApiParameter('id', ApiParameter::TYPE_INTEGER,true));
	}
}