<?php

namespace malotor\shoppingcart\Application;

class ShoppingCartService {
  private $itemRepository;
  private $cartRepository;

  public function __construct(ItemRepositoryInterface $itemRepository, CartLineRepositoryInterface $cartLineRepository) {
    $this->itemRepository = $itemRepository;
    $this->cartRepository = new CartRepository($cartLineRepository);
  }

  public function addProductToCart($productId,$quantity=1) {
    $product = $this->itemRepository->get($productId);
    $shoppingCart = $this->cartRepository->get();
    $shoppingCart->addItem($product,$quantity);
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

  public function getCartTotalAmunt() {
    $cart = $this->cartRepository->get();
    return $cart->getTotalAmount();
  }


}