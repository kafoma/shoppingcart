<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 17/03/15
 * Time: 10:30
 */

namespace malotor\shoppingcart\Domain;


class Collection implements \IteratorAggregate
{
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

  public function count() {
    return count($this->items);
  }

  public function add($key, $item) {
    $this->items[$key] = $item;
  }

  public function get($key) {
    return $this->items[$key];
  }

  public function all() {
    return $this->items;
  }

  public function contains($key)
  {
    return isset($this->items[$key]);
  }

  public function remove($key) {
    unset($this->items[$key]);
  }
  /**
   * Get an iterator for the items
   *
   * @return ArrayIterator
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->items);
  }
}