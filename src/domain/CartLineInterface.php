<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 26/01/15
 * Time: 19:20
 */

namespace malotor\shoppingcart\Domain;


interface CartLineInteface {

  public function setItem($item);
  /**
   * @return malotor\shoppingcart\Item
   */
  public function getItem();
  /**
   * @param integer
   */
  public function setQuantity($quantity);
  /**
   * @return integer
   */
  public function getQuantity();
  static public function create($item,$quantity = 1);
  /**
   * @return double
   */
  public function getAmount();

}