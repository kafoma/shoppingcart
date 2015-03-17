<?php

namespace malotor\shoppingcart\Domain;

interface ItemInterface {
  public function getId();
  public function getPrice();
}