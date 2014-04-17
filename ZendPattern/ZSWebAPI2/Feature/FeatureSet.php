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
	
	/**
	 * Check either set has a feature or not
	 * 
	 * @param string $name
	 */
	public function hasFeature($name)
	{
		return array_key_exists($name, $this->features);
	}
	
	/**
	 * Get fetaure
	 * 
	 * @param string $name
	 */
	public function get($name)
	{
		if ( ! $this->hasFeature($name)) return;
		return $this->features[$name];
	}
}