<?php
namespace ZendPattern\Zsf\Api\Response;

use Zend\Http\Response;

abstract class ResponseAbstract extends Response
{
	const TYPE_XML = 'xml';
	const TYPE_FILE = 'file';
	
	protected $type;
}