<?php
namespace ZendPattern\ZSWebAPI2\ApiService;

class ApiParameter
{
	const TYPE_STRING = 'string';
	const TYPE_ARRAY = 'array';
	const TYPE_INTEGER = 'integer';
	
	/**
	 * Parameter tyep
	 * 
	 * @var string
	 */
	protected $type = self::TYPE_STRING;
		
	/**
	 * Parameter value
	 * 
	 * @var mixed
	 */
	protected $value;
	
	/**
	 * Constructor 
	 * 
	 * @param unknown $value
	 * @param unknown $type
	 */
	public function __construct($value,$type = self::TYPE_STRING)
	{
		$this->type= $type;
		$this->value = $value;
	}
	
}