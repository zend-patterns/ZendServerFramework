<?php
namespace ZendPattern\Zsf\Core;

class Version
{
	/**
	 * Full version number
	 * 
	 * @var string
	 */
	protected $fullVersion;
	
	/**
	 * Constructor
	 * 
	 * @param unknown $fullVersion
	 */
	public function __construct($fullVersion)
	{
		$this->fullVersion = $fullVersion;
	}
	
	/**
	 * Get full version
	 * 
	 * @return string
	 */
	public function getFullVersion()
	{
		return $this->fullVersion;
	}
	
	/**
	 * Get major version : 6
	 * 
	 * @return number
	 */
	public function getMajorVersion()
	{
		return $this->fullVersion + 0;
	}
	
	/**
	 * get minor version : 6.2
	 * 
	 * @return string
	 */
	public function getMinorVersion()
	{
		$tmp = preg_split('@\.@', $this->fullVersion);
		if (count($tmp) < 2) $minor = 0;
		else $minor = trim($tmp[1]);
		return trim($tmp[0]) . '.' . $minor;
	}
	
	/**
	 * Static version comparator
	 * 
	 * @param Version $v1
	 * @param Version $v2
	 */
	static public function equals(Version $v1, Version $v2)
	{
		return ($v1->getMinorVersion() === $v2->getMinorVersion());
	}
	
}