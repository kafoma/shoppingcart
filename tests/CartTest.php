<?php

use malotor\shoppingcart\domain\Cart;
use malotor\shoppingcart\domain\CartException;

class CartTest extends PHPUnit_Framework_TestCase {
  public function setUp() {
    $this->item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $this->item->method('getId')
      ->willReturn(1);
    $this->item->method('getPrice')
      ->willReturn(10);

    $this->other_item = $this->getMockBuilder('malotor\shoppingcart\domain\Item')
      ->getMock();
    $this->other_item->method('getId')
      ->willReturn(2);
    $this->other_item->method('getPrice')
      ->willReturn(21.3);
  }
  // [UnitOfWork_StateUnderTest_ExpectedBehavior]
  public function testCart_WhenCreated_Have0items() {
    $cart = new Cart();
    $this->assertEquals(0,$cart->countItem());
  }


  public function testCart_WhenAddItem_IncreaseNumberItems() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $this->assertEquals(1,$cart->countItem());
  }

  public function testCart_WhenRemoveItem_DecreaseNumberItems() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $cart->removeItem(1);
    $this->assertEquals(0,$cart->countItem());
  }


  public function testCart_WhenRetrieveItem_ReturnExpected() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $cart->addItem($this->other_item);
    $newItem = $cart->getItem(1);
    $this->assertSame($this->item,$newItem);
    $newItem = $cart->getItem(2);
    $this->assertNotSame($this->item,$newItem);
  }

  /**
   * @expectedException malotor\shoppingcart\domain\CartException
   */
  public function testCart_WhenRetrieveNoExistentItem_ReturnExpected() {
    $cart = new Cart();
    $newItem = $cart->getItem(1);
  }


  public function testCart_WhenAddExistingItem_QuantityMustBe1() {

    $cart = new Cart();
    $cart->addItem($this->item);
    $this->assertEquals(1,$cart->getItemQuantity($this->item->getId()));


  }

  public function testCart_WhenAddExistingItem_IncreaseQuantity() {
    $cart = new Cart();
    $cart->addItem($this->item);
    $cart->addItem($this->item);
    $this->assertEquals(2,$cart->getItemQuantity($this->item->getId()));
  }

  public function testCart_WhenGetTotalAmunt_IncreaseQuantity() {
    $cart = new Cart();
    $cart->addItem($this->item);

    $this->assertEquals(10,$cart->getTotalAmount());


    $cart->addItem($this->item);

    $this->assertEquals(20,$cart->getTotalAmount());
  }
}