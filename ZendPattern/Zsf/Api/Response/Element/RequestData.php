<?php
namespace ZendPattern\Zsf\Api\Response\Element;

class RequestData extends ResponseElementAbstract
{
	/**
	 * Api key name
	 * 
	 * @var String
	 */
	protected $apiKeyName;
	
	/**
	 * Api method
	 * 
	 * @var string
	 */
	protected $method;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\Response\Element\ResponseElementInterface::fromXml()
	 */
	public function fromXml($xml)
	{
		$this->apiKeyName = (string)$xml->apiKeyName;
		$this->method = (string)$xml->method;
	}
}
