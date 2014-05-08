<?php
namespace ZendPattern\Zsf\Api\Response;

use ZendPattern\Zsf\Api\Response\Element\RequestData;
use ZendPattern\Zsf\Api\Response\Element\ErrorData;

class ResponseApi extends ResponseXml
{
	/**
	 * Request Data
	 * 
	 * @var RequestData
	 */
	protected $requestData;
	
	/**
	 * Error data
	 * 
	 * @var ErrorData
	 */
	protected $errorData;
	
	/**
	 * @return the $requestData
	 */
	public function getRequestData() {
		return $this->requestData;
	}
	

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorCode()
	 */
	public function getErrorCode()
	{
		return $this->errorData->errorCode;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Api\Response\ResponseAbstract::getErrorMessage()
	 */
	public function getErrorMessage()
	{
		return $this->errorData->errorMessage;
	}

}