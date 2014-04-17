<?php
namespace ZendPattern\ZSWebAPI2\Server;

use ZendPattern\ZSWebAPI2\Api\Service\ZendServer\GetSystemInfo;

class ZendServer6 extends ZendServer
{
	const EDITION_FREE = 'free';
	const EDITION_SMB = 'smb';
	const EDITION_PRO = 'pro';
	const EDITION_ENTERPRISE = 'enterprise';
	
	/**
	 * Init server
	 */
	protected function init()
	{
		$this->addFeature(new GetSystemInfo());
	}
	

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerAbstract::checkEditionValidity()
	 */
	protected function checkEditionValidity()
	{
		$available_editions = array(self::EDITION_FREE, self::EDITION_ENTERPRISE, self::EDITION_PRO, self::EDITION_SMB);
		return in_array($this->edition, $available_editions);
	}
}