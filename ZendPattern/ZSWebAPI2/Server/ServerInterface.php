<?php
namespace ZendPattern\ZSWebAPI2\Server;

use Zend\Uri\Uri;

interface ServerInterface
{
	/**
	 * Return Zend Server version
	 * 
	 * @return string
	 */
	public function getVersion();
	
	/**
	 * Get Zend Server root URI
	 * 
	 * @example : based on http;//localhost:10081
	 * @return Uri
	 */
	public function getRootUri();
	
	/**
	 * Get Zend Server root API path
	 * 
	 * @example : /ZendServer/Api
	 * @return string
	 */
	public function getApiUri();
	
	/**
	 * Retunr API Version
	 * 
	 * @return string
	 */
	public function getApiVersion();
	
	/**
	 * Return Zend Server Edition
	 * 
	 * @return string
	 */
	public function getEdition();
}