<?php
namespace ZendPattern\ZSWebAPI2\Feature;

class FeatureSet
{
	/**
	 * Features
	 * 
	 * @var array
	 */
	protected $features = array();
	
	/**
	 * Adding feature
	 * 
	 * @param FeatureInterface $feature
	 */
	public function addFeature(FeatureInterface $feature)
	{
		$this->features[$feature->getName()] = $feature;
	}
	
	/**
	 * Remove feature from set
	 * 
	 * @param string $name
	 */
	public function removeFeature($name)
	{
		unset($this->features[$name]);
	}
}