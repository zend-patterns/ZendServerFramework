<?php
namespace ZendPattern\Zsf\Api\Key;

class Key
{
	/**
	 * Key ID
	 * 
	 * @var inte
	 */
	protected $id;
	
	/**
	 * Key name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Key hash
	 * 
	 * @var string
	 */
	protected $hash;
	
	/**
	 * Key user name
	 * 
	 * @var string
	 */
	protected $userName;
	
	/**
	 * Key creation time
	 * 
	 * @var int
	 */
	protected $creationTime;
	
	/**
	 * Constructor
	 * 
	 * @param string $name
	 * @param string $hash
	 * @param string $username
	 * @param int $id
	 * @param int $creationTime
	 */
	public function __construct($name,$hash,$username = null,$id = null,$creationTime = null)
	{
		$this->name = $name;
		$this->hash = $hash;
		if ($username) $this->userName = $username;
		if ($id) $this->id = $id;
		if ($creationTime) $this->creationTime = $creationTime;
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $hash
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * @return the $userName
	 */
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * @return the $creationTime
	 */
	public function getCreationTime() {
		return $this->creationTime;
	}

}