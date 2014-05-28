<?php
namespace ZendPattern\Zsf\Api\Response;

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
		if ($this->xml !== null) return $this->xml;
		$this->xml = simplexml_load_string($this->getBody());
		return $this->xml;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorCode()
	 */
	public function getApiErrorCode()
	{
		return (string)$this->getXmlContent()->errorData->errorCode;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorMessage()
	 */
	public function getApiErrorMessage()
	{
		return (string)$this->getXmlContent()->errorData->errorMessage;
	}
}