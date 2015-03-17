<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 17/03/15
 * Time: 10:30
 */

namespace malotor\shoppingcart\Domain;


class Collection {
  /**
   * @var array
   */
  private $items;

  /**
   * Create a new Collection
   *
   * @param array $items
   * @return void
   */
  public function __construct(array $items = [])
  {
    $this->items = $items;
  }



}