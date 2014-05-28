<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Server\WebInterface;

interface ServerInterface
{
	/**
	 * Return Zend Server version
	 * 
	 * @return string
	 */
	public function getVersion();
	
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
	
	/**
	 * Return the web interface
	 * 
	 * Web interface are URI informations
	 * @return WebInterface
	 */
	public function getWebInterface();
}