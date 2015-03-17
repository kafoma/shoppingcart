<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 26/01/15
 * Time: 19:20
 */

namespace malotor\shoppingcart\Domain;


interface CartLineInterface {
  public function setItem($item);
  public function getItem();
  public function setQuantity($quantity);
  public function getQuantity();
  public function increaseQuantity($amount);
  public function getAmount();
}