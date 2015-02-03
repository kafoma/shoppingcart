<?php

use malotor\shoppingcart\Application\Ecommerce;


class EcommerceTest extends PHPUnit_Framework_TestCase {

  protected $ecommerceManager;
  protected $productRepositoryMockup;
  protected $cartRepositoryMockup;
  protected $cartMockup;

  public function setUp() {

    $item = $this->getMockBuilder('malotor\shoppingcart\Domain\Item')
      ->getMock();
    $item->method('getId')
      ->willReturn(1);
    $item->method('getPrice')
      ->willReturn(10);

    $other_item = $this->getMockBuilder('malotor\shoppingcart\Domain\Item')
      ->getMock();
    $item->method('getId')
      ->willReturn(2);
    $item->method('getPrice')
      ->willReturn(120);


    $this->productRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\ItemRepositoryInterface')
      ->getMock();
    $this->productRepositoryMockup->method('get')
      ->willReturn($item);

    $this->cartMockup = $this->getMock('malotor\shoppingcart\Domain\Cart');

    $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($item,2);
    $carLines[] = \malotor\shoppingcart\Application\CartLineFactory::create($other_item,1);

    $this->cartLineRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Application\CartLineRepositoryInterface')
      ->getMock();
    $this->cartLineRepositoryMockup->method('getAll')
      ->willReturn($carLines);

    $this->ecommerceManager = new Ecommerce($this->productRepositoryMockup, $this->cartLineRepositoryMockup);
  }

  public function testAddProductToCart() {

    $productID = 1;

    $this->productRepositoryMockup->expects($this->once())
      ->method('get')
      ->with($this->equalTo($productID));

    $this->cartLineRepositoryMockup->expects($this->once())
      ->method('getAll');

    $this->cartLineRepositoryMockup->expects($this->any())
      ->method('save');
      //->with($this->equalTo($this->cartMockup));

    $this->ecommerceManager->addProductToCart($productID);
  }

}