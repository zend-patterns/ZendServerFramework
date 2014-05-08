<?php
namespace ZendPattern\Zsf\Api\Response\Element;

class ErrorData extends ResponseElementAbstract
{
	/**
	 * Api key name
	 * 
	 * @var String
	 */
	protected $errorCode;
	
	/**
	 * Api method
	 * 
	 * @var string
	 */
	protected $errorMessage;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\Response\Element\ResponseElementInterface::fromXml()
	 */
	public function fromXml($xml)
	{
		$this->errorCode = (string)$xml->errorCode;
		$this->errorMessage = (string)$xml->errorMessage;
	}
}
