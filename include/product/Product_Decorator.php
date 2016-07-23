<?php 

/**
 * Choose Decorator pattern  use for "favor composition over inheritance" principle 
  
 **/

include_once 'include/product/Product_Abstract.php';

abstract class Product_Decorator extends Product_Abstract 
{

	/* Product_Abstract instance */
    protected $_product = null;
    
    /* Constructor for product */
    public function __construct(Product_Interface $product)
    {
        $this->_product = $product;
    }
    
    /* get Description*/
    public function getDescription()
    {
    	return $this->_product->getDescription();
    }
    
    /* get product attribute */
    public function __get($key)
    {
        return $this->_product->__get($key);
    }
    
    /* Set product interface */
    public function __set($key = NULL, $value = NULL)
    {
        return $this->_product->__set($key, $value);
    }
    
    /* Check  product attribute is set in the array */
    public function __isset($key)
    {
        return $this->_product->__isset($key);
    }
	
}
