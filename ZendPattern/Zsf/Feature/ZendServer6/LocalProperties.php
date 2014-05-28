<?php
namespace ZendPattern\Zsf\Feature\ZendServer6;

use ZendPattern\Zsf\Feature\FeatureAbstract;

class LocalProperties extends FeatureAbstract
{

	/**
	 * Zend server local directory
	 *
	 * @var string
	 */
	protected $zendDirectory = '/usr/local/zend/';
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		return $this;
	}
	
	
	/**
	 * Get Database credentials
	 */
	public function getDbCredentials()
	{
		$DbCredentials = array();
		$data = file_get_contents($this->zendDirectory . 'etc/zend_database.ini');
		preg_match_all('@^(.*)=(.*)$@',$data,$tmp);
	}
	
}
