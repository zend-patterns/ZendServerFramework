<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Audit;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class AuditGetDetails extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'auditGetDetails';
		$this->addParameter(new ApiParameter('auditId', ApiParameter::TYPE_INTEGER,true));
	}
}