<?php

use malotor\shoppingcart\domain\Cart;
use malotor\shoppingcart\domain\Item;

class CartTest extends PHPUnit_Framework_TestCase {
  public function setUp() {
    $this->item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $this->item->method('getId')
      ->willReturn(1);

    $this->other_item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $this->other_item->method('getId')
      ->willReturn(2);
  }

  public function testNewCartMusBeEmpty() {
    $cart = new Cart();
    $this->assertEquals(0,$cart->countItem());
  }


  public function testWhenAddItemToCartNumberOfItemInCartMustIncrease() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $this->assertEquals(1,$cart->countItem());
  }

  public function testWhenRemoveItemFromCartNumberOfItemInCartMustDecreease() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $cart->removeItem(1);
    $this->assertEquals(0,$cart->countItem());
  }


  public function testMustRetriveAProductFromACart() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $cart->addItem($this->other_item);
    $newItem = $cart->getItem(1);
    $this->assertSame($this->item,$newItem);
    $newItem = $cart->getItem(2);
    $this->assertNotSame($this->item,$newItem);
  }

 

}