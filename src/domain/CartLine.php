<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 14/01/15
 * Time: 14:52
 */

namespace malotor\shoppingcart\domain;


class CartLine {
  private $item;
  private $quantity;
  public function __construct($item,$quantity = 1) {
    $this->item = $item;
    $this->quantity = $quantity;
  }
  /**
   * @param mixed $item
   */
  public function setItem($item)
  {
    $this->item = $item;
  }

  /**
   * @return mixed
   */
  public function getItem()
  {
    return $this->item;
  }

  /**
   * @param mixed $quantity
   */
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }

  /**
   * @return mixed
   */
  public function getQuantity()
  {
    return $this->quantity;
  }

  public function increaseQuantity($amount) {
    $this->quantity += $amount;
  }


  static public function create($item,$quantity = 1) {
    return new static($item,$quantity);
  }
} 