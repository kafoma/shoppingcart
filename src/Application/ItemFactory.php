<?php

namespace malotor\shoppingcart\Application;

class ItemFactory {

  public static function createProduct($itemName,$itemRef,$itemDescription,$itemPrice) {
    $item = new Item();

    $item->setName($itemName)
      ->setReference($itemRef)
      ->setDescription($itemDescription)
      ->setPrice($itemPrice);

    return $item;
  }

}