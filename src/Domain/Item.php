<?php

namespace malotor\shoppingcart\Domain;

class Item implements ItemInterface {

  protected $id;
  protected $name;
  protected $description;
  protected $reference;
  protected $price;
  protected $image;

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description) {
    $this->description = $description;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param mixed $image
   */
  public function setImage($image) {
    $this->image = $image;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * @param mixed $price
   */
  public function setPrice($price) {
    if (!is_numeric($price))
      throw new ItemException("Price must be numeric");
    $this->price = $price;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $reference
   */
  public function setReference($reference) {
    $this->reference = $reference;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getReference() {
    return $this->reference;
  }

}
