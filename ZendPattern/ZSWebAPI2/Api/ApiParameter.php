<?php
namespace ZendPattern\ZSWebAPI2\Api;

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
	 * Parameter name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Either parameter is required or not
	 * 
	 * @var boolean
	 */
	protected $isRequired = false;
	
	/**
	 * Constructor 
	 * 
	 * @param unknown $value
	 * @param unknown $type
	 */
	public function __construct($name,$type,$isRequired = false,$value = null)
	{
		$this->type= $type;
		$this->value = $value;
		$this->name = $name;
		$this->isRequired = (boolean)$isRequired;
	}
	
	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\ApiService\mixed $value
	 */
	public function setValue($value) {
		//@todo : you should check parameter value !!!
		$this->value = $value;
	}
	
	/**
	 * Check if parameter is required or not
	 * 
	 * @return boolean
	 */
	public function isRequired()
	{
		return $this->isRequired;
	}
	
	/**
	 * Check if parameter is scalar or not
	 * 
	 * @return boolean
	 */
	public function isScalar()
	{
		if ($this->type == self::TYPE_INTEGER) return true;
		if ($this->type == self::TYPE_STRING) return true;
		return false;
	}
	
	/**
	 * Check if parameter is array or not
	 * 
	 * @return boolean
	 */
	public function isArray()
	{
		if ($this->type == self::TYPE_ARRAY) return true;
		return false;
	}
}