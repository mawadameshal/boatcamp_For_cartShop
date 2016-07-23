<?php 

// Shopping cart class implemented as Singleton

 
class Cart 
{
	/* Singleton instance */
	protected static $_instance = NULL;
	

	protected $_id = NULL;
	
	/* Array of cart items */
	protected $_items = array();
	
	
	/* cart instance object */
	protected $_function= null;
	
	/* Private constructor */
	private function __construct() {}
	
	/* get cart instance */
    public static function getInstance()
    {
        if (NULL === self::$_instance) {
            self::$_instance = new self;
        }
        
        return self::$_instance;
    }
	
	
	/*  Add Product item to Cart */
	public function add(Product_Interface $product)
	{
		if (isset($this->_items[$product->id])) {
			$this->_items[$product->id]['amount']++;
		} else {
			$this->_items[$product->id]['item'] = $product;
			$this->_items[$product->id]['amount'] = 1;
		}
		
		return $this->_save();
	}
	
	/* Remove Product from cart */
	public function remove($productId = NULL)
	{
		if (NULL === $productId) {
			return FALSE;
		}

		if (isset($this->_items[$productId])) {
			// if amount of products is 1, remove product, otherwise decrease amount
			if (1 == $this->_items[$productId]['amount']) {
				unset($this->_items[$productId]);
			} else {
				$this->_items[$productId]['amount']--;
			}
		}
		
		return $this->_save();
	}
	
	
	/* get all Cart items */
	public function getAll()
	{
		return $this->_items;
	}
	
	/* Calculate total of all items */
	protected function _getTotal()
	{
		$total = 0;
		
		foreach ($this->_items as $item) {
            $total += $item['item']->getCost() * $item['amount'];	
		}
		
		return $total;
	}
	
	
	/* Save the contents of cart */
	protected function _save()
	{
		$contents['items'] = $this->_items;
		
		$this->_function->setContents($contents);
		$this->_function->save();
		
		return $this;
	}

	/* load contents of cart from interface */
	protected function _load()
	{
		$contents = $this->_function->load()->getContents();
		
		$this->_items = $content['items'];
		
		return $this;
	}

	/* Set Function interface object */
	public function setFunction(function_Interface $funtion)
	{
		$this->_persistance = $function;
		
		// set Cart id in Function Interface
		if (NULL !== $this->_id) {
			$this->_persistance->setId($this->id);
		}
		
		// load from function interface
		$contents = $this->_persistance->load()->getContents();
		
		$this->_items = $contents['items'];
		
		return $this; 
	}
	
	
	 //Set Cart id
	public function setId($id = NULL) 
	{
		if (NULL === $id) {
			throw new Exception('Cannot set NULL id');
		}
		
		$this->_id = $id;
		
		// set the same id to function_Interface
		$this->_function->setId($this->_id);
		
		return $this;
	}
	
	/* get id */
	public function getId()
	{
		return $this->_id;
	}
}

