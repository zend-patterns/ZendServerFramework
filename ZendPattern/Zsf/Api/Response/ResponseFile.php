<?php
namespace ZendPattern\Zsf\Api\Response;

class ResponseFile extends ResponseAbstract
{
	/**
	 * Fuile name
	 * 
	 * @var string
	 */
	protected $fileName;
	
	/**
	 * File content
	 * 
	 * @var string
	 */
	protected $fileContent;
	
	/**
	 * Content type
	 * 
	 * @var string
	 */
	protected $contentType;
	
	/**
	 * @return the $fileName
	 */
	public function getFileName() {
		if ($this->fileName) return $this->fileName;
		$contentDisposition = $this->getHeaders()->get('Content-Disposition')->getFieldValue();
		preg_match('@filename="(.*)"@',$contentDisposition,$tmp);
		$this->fileName = $tmp[1];
		return $this->fileName;
	}

	/**
	 * @return the $fileContent
	 */
	public function getFileContent() {
		if ($this->fileContent) return $this->fileContent;
		$this->fileContent = $this->getContent();
		return $this->fileContent;
	}

	/**
	 * @return the $contentType
	 */
	public function getContentType() {
		if ($this->contentType) return $this->contentType;
		$this->contentType = $this->getHeaders()->get('Content-Type')->getFieldValue();
		return $this->contentType;
	}

	/**
	 * @param string $fileName
	 */
	public function setFileName($fileName) {
		$this->fileName = $fileName;
	}

	/**
	 * @param string $fileContent
	 */
	public function setFileContent($fileContent) {
		$this->fileContent = $fileContent;
	}

	/**
	 * @param string $contentType
	 */
	public function setContentType($contentType) {
		$this->contentType = $contentType;
	}

}