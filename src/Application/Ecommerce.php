<?php

namespace malotor\shoppingcart\Application;

use malotor\shoppingcart\Ports\ProductRepositoryInterface;
use malotor\shoppingcart\Ports\CartRepositoryInterface;

class Ecommerce {
  protected $productRepository;
  protected $cartRepository;

  public function __construct(ProductRepositoryInterface $productRepository, CartRepositoryInterface $cartRepository) {
    $this->productRepository = $productRepository;
    $this->cartRepository = $cartRepository;
  }

  public function addProductToCart($productId) {
    $product = $this->productRepository->get($productId);
    $shoppingCart = $this->cartRepository->get();
    $shoppingCart->addItem($product);
    $this->cartRepository->save($shoppingCart);
  }

  public function removeProductFromCart($productId) {
    $shoppingCart = $this->cartRepository->get();
    $shoppingCart->removeItem($productId);
    $this->cartRepository->save($shoppingCart);
  }

  public function getCartItems() {
    $cart = $this->cartRepository->get();
    return $cart->getIterator();
  }
}