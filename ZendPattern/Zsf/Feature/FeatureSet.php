<?php
namespace ZendPattern\Zsf\Feature;

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
		if ($this->hasFeature($feature->getName())) return;
		foreach ($feature->getDependencies() as $depName){
			$dependency = new $depName();
			$this->addFeature($dependency);
		}
		$this->features[$feature->getName()] = $feature;
	}
	
	/**
	 * Remove feature from set
	 * 
	 * @param string $name
	 */
	public function removeFeature($name)
	{
		$name = strtolower($name);
		unset($this->features[$name]);
	}
	
	/**
	 * Check either set has a feature or not
	 * 
	 * @param string $name
	 */
	public function hasFeature($name)
	{
		$name = strtolower($name);
		if (array_key_exists($name, $this->features)) return  true;
	}
	
	/**
	 * Get fetaure
	 * 
	 * @param string $name
	 */
	public function get($name)
	{
		$name = strtolower($name);
		if ( ! $this->hasFeature($name)) return;
		return $this->features[$name];
	}
}