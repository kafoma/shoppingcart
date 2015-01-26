<?php

namespace malotor\shoppingcart\Application;

use malotor\shoppingcart\Ports\CartLineRepositoryInterface;
use malotor\shoppingcart\Ports\ProductRepositoryInterface;
use malotor\shoppingcart\Domain\Cart;

class Ecommerce {
  protected $productRepository;
  protected $cartRepository;

  public function __construct(ProductRepositoryInterface $productRepository, CartLineRepositoryInterface $cartLineRepository) {
    $this->productRepository = $productRepository;
    $this->cartLineRepository = $cartLineRepository;
  }

  public function addProductToCart($productId) {

    $product = $this->productRepository->get($productId);

    $shoppingCart = $this->getCart();
    $shoppingCart->addItem($product);

    $this->saveCart($shoppingCart);
  }

  public function removeProductFromCart($productId) {
    $shoppingCart = $this->getCart();
    $shoppingCart->removeItem($productId);
    $this->saveCart($shoppingCart);
  }


  public function getCartItems() {
    $cart = $this->getCart();
    return $cart->getIterator();
  }

  public function getCartTotalAmunt() {
    $cart = $this->getCart();
    return $cart->getTotalAmount();
  }

  protected function getCart() {
    $carLines = $this->cartLineRepository->getAll();

    $cart = new Cart();

    foreach ($carLines as $carLine) {
      $cart->addItem($carLine->getItem(),$carLine->getQuantity());
    }

    return $cart;
  }

  protected function saveCart($cart) {

    foreach($cart->getIterator as $cartLine) {
      $this->cartLineRepository->save($cartLine);
    }

  }
}