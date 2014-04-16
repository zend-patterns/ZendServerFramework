<?php
namespace ZendPattern\ZSWebAPI2\Feature;

use ZendPattern\ZSWebAPI2\Server\ServerInterface;

interface FeatureInterface
{
	/**
	 * Retunr Zend Server
	 * 
	 * @return ServerInterface
	 */
	public function getServer();
	
	/**
	 * Set Zend Server
	 * 
	 * @param ServerInterface $server
	 */
	public function setServer(ServerInterface $server);
	
	/**
	 * Get feature name
	 * 
	 * @return string
	 */
	public function getName();
}