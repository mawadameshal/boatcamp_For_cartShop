<?php 

/**
 * Abstract class for product and implement Product_Interface, but don't have to extend this class
 * tha class contain from variables and methods that decribe the product
 
 **/

include_once 'include/product/Product_Interface.php';

abstract class Product_Abstract implements Product_Interface
{
	
	/** String variable for product description **/
	protected $_description = NULL;
	
	/** Float variable for product cost **/
	protected $_cost = NULL;
	
	/** array to describe the attributes of product **/
	protected $_attributes = array();
	
	
	
	 /* Set cost*/
	public function setCost($cost = NULL)
	{
		if (NULL === $cost OR !is_numeric($cost)) {
			throw new Exception('Cost cannot be null');
		}
		
		$this->_cost = (float) $cost;
		
		return $this;
	}
	
	/* Set product description */
	public function setDescription($description = NULL)
	{
		if (NULL === $description) {
			throw new Exception('Description cannot be null');
		}
		
		$this->_description = $description;
		
		return $this;
	}
	
	/* Get product cost */
	public function getCost()
	{
		return number_format($this->_cost, 2);
	}
	
	/* Get product description */
	public function getDescription()
	{
		return $this->_description;
	}
	
	/* Get product attribute and return its attributes */
	public function __get($key)
	{
		if (isset($this->_attributes[$key])) {
			return $this->_attributes[$key];
		} else {
			return NULL;
		}
	}
	
	/* set product attribute and set its attributes */
	public function __set($key = NULL, $value = NULL)
	{
		if (NULL === $key OR NULL === $value) {
			throw new Exception('Key and value for setting an atribute must be set');
		}
		
		$this->_attributes[$key] = $value;
	}
	
	/* check that all product attribute set in the array*/
	public function __isset($key)
	{
		switch($key) {
			case 'cost':
				return isset($this->_cost);
				break;
				
			case 'description':
				return isset($this->_description);
				break;
				
			default:
				return isset($this->_attributes[$key]);
				break;
		}
	}
	
}