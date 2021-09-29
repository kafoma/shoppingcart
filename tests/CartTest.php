<?php

use malotor\shoppingcart\Domain\Cart;
use malotor\shoppingcart\Application\CartLineFactory;
use malotor\shoppingcart\Domain\Collection;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

  protected $item;
  protected $other_item;

  public function setUp() {
    $this->item = $this->getMockBuilder('malotor\shoppingcart\Domain\ItemInterface')
      ->getMock();
    $this->item->method('getId')
      ->willReturn(1);
    $this->item->method('getPrice')
      ->willReturn(10);

    $this->other_item = $this->getMockBuilder('malotor\shoppingcart\Domain\ItemInterface')
      ->getMock();
    $this->other_item->method('getId')
      ->willReturn(2);
    $this->other_item->method('getPrice')
      ->willReturn(21.3);

    $this->lineCart = CartLineFactory::create($this->item, 1);
    $this->otherLineCart = CartLineFactory::create($this->other_item, 1);
  }

  public function testCart_WhenCreated_Have0items() {
    $cart = new Cart(new Collection());
    $this->assertEquals(0,$cart->countItem());
  }


  public function testCart_WhenAddItem_IncreaseNumberItems() {
    $cart = new Cart(new Collection());

    $cart->addItem($this->item);
    $this->assertEquals(1,$cart->countItem());
  }

  public function testCart_WhenRemoveItem_DecreaseNumberItems() {
    $cart = new Cart(new Collection());
    //$cart->addItem($this->lineCart);
    $cart->addItem($this->item);
    $cart->removeItem(1);
    $this->assertEquals(0,$cart->countItem());
  }


  public function testCart_WhenRetrieveItem_ReturnExpected() {
    $cart = new Cart(new Collection());
    //$cart->addItem($this->lineCart);
    $cart->addItem($this->item);
    //$cart->addItem($this->otherLineCart);
    $cart->addItem($this->other_item);
    $newItem = $cart->getItem(1);
    $this->assertSame($this->item,$newItem);
    $newItem = $cart->getItem(2);
    $this->assertNotSame($this->item,$newItem);
  }

  /**
   * @expectedException malotor\shoppingcart\domain\CartException
   */
  public function testCart_WhenRetrieveNoExistentItem_ReturnException() {
    $cart = new Cart(new Collection());
    $newItem = $cart->getItem(1);
  }


  public function testCart_WhenAddExistingItem_QuantityMustBe1() {
    $cart = new Cart(new Collection());
    $cart->addItem($this->item);
    $this->assertEquals(1,$cart->getItemQuantity($this->item->getId()));
  }

  public function testCart_WhenAddExistingItem_IncreaseQuantity() {
    $cart = new Cart(new Collection());
    $cart->addItem($this->item);
    $cart->addItem($this->item);
    $this->assertEquals(2,$cart->getItemQuantity($this->item->getId()));
  }
  public function testCart_TotalAmountOfEmptyCartShouldBeZero() {
    $cart = new Cart(new Collection());

    $this->assertEquals(0,$cart->getTotalAmount());
  }

  public function testCart_TotalAmountIsSumOfTheirItems() {
    $cart = new Cart(new Collection());
    $cart->addItem($this->item);
    $this->assertEquals(10,$cart->getTotalAmount());
    $cart->addItem($this->item);
    $this->assertEquals(20,$cart->getTotalAmount());
    $cart->addItem($this->other_item);
    $this->assertEquals(41.3,$cart->getTotalAmount());
  }

  public function testCart_getIterator() {
    $cart = new Cart(new Collection());
    $cart->addItem($this->item);
    $cart->addItem($this->item);
    $cart->addItem($this->other_item);
    //$cartIterator = $cart->getIterator();

    foreach($cart as $cartLine) {
      $this->assertInstanceOf('malotor\shoppingcart\domain\CartLine', $cartLine);
    }
  }

  public function testCart_WhenAddMoraThan1Item() {
    $cart = new Cart(new Collection());
    $cart->addItem($this->item, 3);
    $this->assertEquals(3, $cart->getItemQuantity($this->item->getId()));
  }

}