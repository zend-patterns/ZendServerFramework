<?php
namespace ZendPattern\Zsf\Feature\Common;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\Db\Adapter\Adapter;

class Database extends FeatureAbstract
{
	/**
	 * Db Adapter
	 * 
	 * @var Adapter
	 */
	protected $dbAdapter;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		return $this;
	}
	
	/**
	 * @return the $dbAdapter
	 */
	public function getDbAdapter() {
		return $this->dbAdapter;
	}

	/**
	 * @param \Zend\Db\Adapter\Adapter $dbAdapter
	 */
	public function setDbAdapter(Adapter $dbAdapter) {
		$this->dbAdapter = $dbAdapter;
	}

	
}