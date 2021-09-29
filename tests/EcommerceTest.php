<?php

use malotor\shoppingcart\Application\Ecommerce;
use malotor\shoppingcart\Domain\Collection;
use PHPUnit\Framework\TestCase;

class EcommerceTest extends TestCase {

  protected $ecommerceManager;
  protected $itemRepositoryMockup;
  protected $cartRepositoryMockup;
  protected $cartMockup;
  protected $cartLineRepositoryMockup;

  public function setUp() {

    $this->item = $this->getMockBuilder('malotor\shoppingcart\Domain\Item')
      ->getMock();
    $this->item->method('getId')
      ->willReturn(1);
    $this->item->method('getPrice')
      ->willReturn(10);

    $this->other_item = $this->getMockBuilder('malotor\shoppingcart\Domain\Item')
      ->getMock();
    $this->other_item->method('getId')
      ->willReturn(2);
    $this->other_item->method('getPrice')
      ->willReturn(120);


    $this->itemRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\ItemRepositoryInterface')
      ->getMock();
    $this->itemRepositoryMockup->method('get')
      ->willReturn($this->item);

    $this->cartMockup = $this->createMock('malotor\shoppingcart\Domain\Cart', array(), array(new Collection()));

       $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($this->item,2);
       $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($this->other_item,1);


       $this->cartLineRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\CartLineRepositoryInterface')
         ->getMock();
       $this->cartLineRepositoryMockup->method('getAll')
         ->willReturn($carLines);

    $this->cartRepositoryMockup = $this->createMock('malotor\shoppingcart\Application\CartRepository', array(), array($this->cartLineRepositoryMockup));
    /*$this->cartRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\CartRepository')
      ->disableOriginalConstructor()
      ->getMock();*/
    $this->cartRepositoryMockup->method('get')
      ->willReturn($this->cartMockup);
    $this->ecommerceManager = new Ecommerce($this->itemRepositoryMockup, $this->cartLineRepositoryMockup);
  }

  public function testAddProductToCart() {

    $productID = 1;
    //$this->ecommerceManager->addProductToCart($productID);
    $this->assertEquals(2 ,$this->ecommerceManager->getCartItems()->count());
  }
}