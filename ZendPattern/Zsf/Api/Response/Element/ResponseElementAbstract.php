<?php
namespace ZendPattern\Zsf\Api\Response\Element;

abstract class ResponseElementAbstract implements ResponseElementInterface
{
	/**
	 * 
	 * @param unknown $xml
	 */
	abstract public function fromXml($xml);
	
	/**
	 * Read only access to element properties
	 * 
	 * @param string $key
	 */
	public function __get($key)
	{
		if (property_exists($this, $key)) return $this->key;
	}
	
	/**
	 * Create response element form xml
	 *
	 * @param SimpleXMLElement $xml
	 */
	public static function fromXmlElement($xml)
	{
		$element = new self();
		$element->fromXml($xml);
		return $element;
	}
}