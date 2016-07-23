<?php 

/**

 * Interface that any type of product can implementing it, and it handel by class cart
 *The cart behave to any type of product by their interface that implementing
 
 **/
interface Product_Interface
{
	public function getCost();
	
	public function setCost($cost = NULL);
	
	public function getDescription();
	
	public function setDescription($description = NULL);
}
