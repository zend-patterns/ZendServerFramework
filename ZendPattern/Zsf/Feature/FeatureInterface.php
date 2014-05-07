<?php
namespace ZendPattern\Zsf\Feature;

use ZendPattern\Zsf\Server\ServerInterface;

interface FeatureInterface
{
	/**
	 * No parameter constructor
	 */
	public function __construct();
	
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
	
	/**
	 * Return list of dependent features
	 * 
	 * @return array
	 */
	public function getDependencies();
	
}