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

    $this->productRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Ports\ProductRepositoryInterface')
      ->getMock();
    $this->productRepositoryMockup->method('get')
      ->willReturn($item);

    $this->cartMockup = $this->getMock('malotor\shoppingcart\Domain\Cart');

    $this->cartRepositoryMockup = $this->getMockBuilder('malotor\shoppingcart\Ports\CartRepositoryInterface')
      ->getMock();
    $this->cartRepositoryMockup->method('get')
      ->willReturn($this->cartMockup);
    $this->cartRepositoryMockup->method('save')
      ->willReturn(true);
    $this->ecommerceManager = new Ecommerce($this->productRepositoryMockup, $this->cartRepositoryMockup);
  }

  public function testAddProductToCart() {

    $productID = 1;

    $this->productRepositoryMockup->expects($this->once())
      ->method('get')
      ->with($this->equalTo($productID));

    $this->cartMockup->expects($this->once())
      ->method('addItem');

    $this->cartRepositoryMockup->expects($this->once())
      ->method('save')
      ->with($this->equalTo($this->cartMockup));

    $this->ecommerceManager->addProductToCart($productID);

  }



}