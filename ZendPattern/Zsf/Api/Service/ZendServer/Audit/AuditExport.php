<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Audit;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Response\ResponseFile;

class AuditExport extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'auditExport';
		$this->addParameter(new ApiParameter('filters', ApiParameter::TYPE_ARRAY));
		$this->setResponsePrototype(new ResponseFile());
	}
}