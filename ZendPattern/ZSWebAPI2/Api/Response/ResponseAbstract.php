<?php
namespace ZendPattern\ZSWebAPI2\Api\Response;

use Zend\Http\Response;

abstract class ResponseAbstract extends Response
{
	/**
	 * Get Api error code
	 *
	 * @return NULL|string
	 */
	abstract public function getErrorCode();
	
	/**
	 * Get Api error message
	 *
	 * @return NULL|string
	 */
	abstract public function getErrorMessage();
}