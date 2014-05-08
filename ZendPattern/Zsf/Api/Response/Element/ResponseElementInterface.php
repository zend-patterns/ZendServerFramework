<?php
namespace ZendPattern\Zsf\Api\Response\Element;

interface ResponseElementInterface
{
	/**
	 * Init from XML 
	 * 
	 * @param simpleXMLElement $xml
	 */
	public function fromXml($xml);
}