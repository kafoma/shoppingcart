<?php

namespace malotor\shoppingcart\Application;

use malotor\shoppingcart\Domain\Cart;

class Ecommerce {
  private $itemRepository;
  private $cartRepository;

  public function __construct(ItemRepositoryInterface $itemRepository, CartLineRepositoryInterface $cartLineRepository) {
    $this->itemRepository = $itemRepository;
    $this->cartLineRepository = $cartLineRepository;
  }

  public function addProductToCart($productId,$quantity=1) {
    $product = $this->itemRepository->get($productId);
    $shoppingCart = $this->getCart();
    $lineCart = CartLineFactory::create($product,$quantity);
    $shoppingCart->addItem($lineCart);
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
      $cart->addItem($carLine);
    }
    return $cart;
  }

  protected function saveCart($cart) {
    $this->cartLineRepository->removeAll();
    foreach($cart->getIterator() as $cartLine) {
      $this->cartLineRepository->save($cartLine);
    }
  }
}