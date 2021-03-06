<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CartBundle\Model;

/**
 * Model for cart items.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
abstract class Item implements ItemInterface
{
    /**
     * Id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Cart.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * Quantity.
     *
     * @var integer
     */
    protected $quantity;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->quantity = 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart = null)
    {
        $this->cart = $cart;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        if (1 > $quantity) {
            throw new \OutOfRangeException('Quantity value must be bigger than zero.');
        }

        $this->quantity = $quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementQuantity($amount = 1)
    {
        $this->quantity += $amount;

        // Quantity must be bigger than zero
        if (1 > $this->quantity) {
            $this->quantity = 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function equals(ItemInterface $item)
    {
        if ($item->getId() !== $this->getId()) {
            return false;
        }

        return true;
    }
}
