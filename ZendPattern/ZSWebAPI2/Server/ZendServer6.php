<?php
namespace ZendPattern\ZSWebAPI2\Server;

use ZendPattern\ZSWebAPI2\ApiService\Basic\GetSytemInfo;

class ZendServer6 extends Server
{
	protected function init()
	{
		$this->addFeature(new GetSytemInfo());
	}
}