<?php

namespace malotor\shoppingcart\Application;

use malotor\shoppingcart\Domain\Item;

class ItemFactory {

  public static function create($itemName,$itemRef,$itemDescription,$itemPrice) {
    $item = new Item();

    $item->setId($itemId)
      ->setName($itemName)
      ->setReference($itemRef)
      ->setDescription($itemDescription)
      ->setPrice($itemPrice);

    return $item;
  }

}