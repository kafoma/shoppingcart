<?php

use malotor\shoppingcart\Application\Ecommerce;


class EcommerceTest extends PHPUnit_Framework_TestCase {

  protected $ecommerceManager;
  protected $productRepositoryMockup;
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


    $this->productRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\ItemRepositoryInterface')
      ->getMock();
    $this->productRepositoryMockup->method('get')
      ->willReturn($this->item);

    $this->cartMockup = $this->getMock('malotor\shoppingcart\Domain\Cart');


       $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($item,2);
       $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($other_item,1);


       $this->cartLineRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\CartLineRepositoryInterface')
         ->getMock();
       $this->cartLineRepositoryMockup->method('get')
         ->willReturn($carLines);


    $this->cartRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\CartRepository')
      ->disableOriginalConstructor()
      ->getMock();
    $this->cartRepositoryMockup->method('get')
      ->willReturn($this->cartMockup);
    $this->ecommerceManager = new Ecommerce($this->productRepositoryMockup, $this->cartRepositoryMockup);
  }

  public function testAddProductToCart() {

    $productID = 1;

    /*
    $this->productRepositoryMockup->expects($this->once())
      ->method('get')
      ->with($this->equalTo($productID));
    */

    $this->cartMockup->expects($this->once())
      ->method('addItem')
      ->with($this->equalTo($this->item));
    /*
    $this->cartLineRepositoryMockup->expects($this->once())
      ->method('get');

    $this->cartLineRepositoryMockup->expects($this->any())
      ->method('save');
      //->with($this->equalTo($this->cartMockup));
    */

    $this->ecommerceManager->addProductToCart($productID);
  }

}