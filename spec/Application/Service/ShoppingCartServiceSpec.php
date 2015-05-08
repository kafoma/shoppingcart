<?php

namespace spec\malotor\shoppingcart\Application\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use malotor\shoppingcart\Application\Repository\ItemRepositoryInterface;
use malotor\shoppingcart\Application\Repository\CartLineRepositoryInterface;


class ShoppingCartServiceSpec extends ObjectBehavior
{
    function let(ItemRepositoryInterface $itemRepository, CartLineRepositoryInterface $lineCartRepository) {
        $this->beConstructedWith($itemRepository, $lineCartRepository); 
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('malotor\shoppingcart\Application\Service\ShoppingCartService');
    }

    function it_should_add_product_to_cart(temRepositoryInterface $itemRepository, CartLineRepositoryInterface $lineCartRepository)) {
        $this->beConstructedWith($itemRepository, $lineCartRepository);       
    }
}
