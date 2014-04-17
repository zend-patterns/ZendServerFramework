<?php
namespace ZendPattern\ZSWebAPI2\Api\Response;

class ResponseXml extends ResponseAbstract
{
	/**
	 * Xml content
	 * 
	 * @var \SimpleXMLElement
	 */
	protected $xml;
	
	/**
	 * Return XML content
	 * 
	 * @return \SimpleXMLElement
	 */
	public function getXmlContent()
	{
		if ($this->xml) return $this->xml;
		$this->xml = simplexml_load_string($this->getBody());
		return $this->xml;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorCode()
	 */
	public function getErrorCode()
	{
		if ($this->statusCode < 400) return null;
		$errorCode = (string) $this->xml->errorData->errorCode;
		return $errorCode;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorMessage()
	 */
	public function getErrorMessage()
	{
		if ($this->statusCode < 400) return null;
		$errorMessage = (string) $this->xml->errorData->errorMessage;
		return $errorMessage;
	}
}