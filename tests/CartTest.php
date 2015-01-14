<?php

use malotor\shoppingcart\domain\Cart;
use malotor\shoppingcart\domain\Item;

class CartTest extends PHPUnit_Framework_TestCase {

  public function testNewCartMusBeEmpty() {

    $cart = new Cart();

    $this->assertEquals(0,$cart->countItem());
  }


  public function testWhenAddItemToCartNumberOfItemInCartMustIncrease() {
    $item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $cart = new Cart();
    $cart->addItem($item);


    $this->assertEquals(1,$cart->countItem());

  }

  public function testWhenRemoveItemFromCartNumberOfItemInCartMustDecreease() {

    $item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();

    $itemId = 1;

    $cart = new Cart();
    $cart->addItem($item);
    $cart->removeItem($itemId);

    $this->assertEquals(0,$cart->countItem());
  }


  public function testMustRetriveAProductFromACart() {

    $item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
     $item ->method('getId')
      ->willReturn(1);

    $other_item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $other_item ->method('getId')
      ->willReturn(2);

    $cart = new Cart();
    $cart->addItem($item);
    $cart->addItem($other_item);
    $newItem = $cart->getItem(1);
    $this->assertSame($item,$newItem);

    $newItem = $cart->getItem(2);
    $this->assertNotSame($item,$newItem);
  }

}