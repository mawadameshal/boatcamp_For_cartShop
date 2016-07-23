<?php 
// cart session

include 'include/function_Interface.php';

class function_Session implements function_Interface
{
	// Default namespace
	protected $_namespaceDefault = 'default_function';
	
	// Namespace for $_SESSION  as global array
	protected $_namespaceId = NULL;
	
	// save item of the cart
	protected $_contents = array();
	
	// Constructor
	public function __construct($namespace = NULL)
	{
		session_start();
		
		if (NULL !== $namespace) {
			$this->_namespaceId = $namespace;
		} else {
			$this->_namespaceId = $this->_namespaceDefault;
		}
		
		if ( ! isset($_SESSION[$this->_namespaceId])) {
			$_SESSION[$this->_namespaceId] = array();
		}
	}
	
	//Set id as namespace
	public function setId($id = NULL) 
	{
		if (NULL === $id) {
			throw new Exception('id cannot be NULL');
		}
		
		$this->_namespaceId = $id;
		
		return $this;
	}
	
	// Get namespace id
	
	public function getId()
	{
		return $this->_namespaceId;
	}
	
	// Get contents of the cart using load function

	public function load($id = NULL)
	{
		if ( NULL !== $id) {
			$this->setId($id);
		}
		
		$this->_contents = $_SESSION[$this->_namespaceId];
		
		return $this;
	}
	
	// Save contents of cart
	
	public function save($id = NULL)
	{
		if ( NULL !== $id) {
			$this->setId($id);
		}
		
		$_SESSION[$this->_namespaceId] = $this->_contents;
	}
	
	// Get items  & stored in object
	
	public function getContents()
	{
		return $this->_contents;
	}
	
	// import all content of cart
	public function setContents($contents = NULL)
	{
		$this->_contents = $contents;
		return $this;
	}
	
	
	
}