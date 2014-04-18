<?php
namespace ZendPattern\ZSWebAPI2\Api\Client;

use Zend\Http\Client;
use ZendPattern\ZSWebAPI2\Api\ApiRequest;
use Zend\Http\Headers;

abstract class ApiClientAbstract extends Client
{
	const USER_AGENT = 'Zend\Http\Client';
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Http\Client::send()
	 */
	public function send(ApiRequest $request = null)
	{
		if ($request !== null) {
			$this->setRequest($request);
		}
		$this->prepareRequest();
		return parent::send($request);
	}
	
	/**
	 * Prepare the request before it been send to Zend Server
	 */
	public function prepareRequest()
	{
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$webApiUri = $this->request->getUri()->getPath();
		$signatureData  = $this->request->getUri()->getHost() . ':';
		$signatureData .= $this->request->getUri()->getPort() . ':';
		$signatureData .= $webApiUri . ':';
		$signatureData .= self::USER_AGENT . ':';
		$signatureData .= $date;
		$apiKey = $this->request->getApiKey();
		$signature = hash_hmac('sha256', $signatureData, $apiKey->getHash());
		$headers = new Headers();
		$headers->addHeaderLine('Host', $this->request->getUri()->getHost() . ':' . $this->request->getUri()->getPort());
		$headers->addHeaderLine('Date', $date);
		$headers->addHeaderLine('Accept', 'application/vnd.zend.serverapi+'.$this->request->getOutputType().';version=' . $this->request->getServer()->getApiVersion());
		$headers->addHeaderLine('X-Zend-Signature', $apiKey->getName() . '; ' . $signature);
		if ($this->request->isPost()) {
			$contentLength = 0;
			if(count($this->request->getFiles())) {
				$headers->addHeaderLine('Content-Type', 'multipart/form-data');
			} else {
				$headers->addHeaderLine('Content-Type', 'application/x-www-form-urlencoded');
			}
			$contentLength += strlen($this->getContent());
			$headers->addHeaderLine('Content-Length',$contentLength);
		}
		$this->request->setHeaders($headers);
	}

}