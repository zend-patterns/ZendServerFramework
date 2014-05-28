<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Configuration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Response\ResponseFile;

class ConfigurationExport extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'configurationExport';
		$this->addParameter(new ApiParameter('directivesBlacklist', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('snapshotName', ApiParameter::TYPE_STRING));
		$this->setResponsePrototype(new ResponseFile());
	}
}