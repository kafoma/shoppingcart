<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 14/01/15
 * Time: 13:01
 */

namespace malotor\shoppingcart\domain;


interface Item {
  public function getId();
  public function getPrice();
}