<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Response\ResponseFile;

class CodetracingDownloadTraceFile extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'codetracingDownloadTraceFile';
		$this->addParameter(new ApiParameter('traceFile', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('eventsGroupId', ApiParameter::TYPE_INTEGER));
		$this->setResponsePrototype(new ResponseFile());
	}
}