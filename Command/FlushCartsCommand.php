<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CartBundle\Command;

use Sylius\Bundle\CartBundle\EventDispatcher\SyliusCartEvents;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for console that deletes expired carts.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FlushCartsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sylius:cart:flush')
            ->setDescription('Deletes expired carts.')
            ->setHelp(
<<<EOT
The <info>sylius:cart:flush</info> command deletes expired carts:

  <info>php sylius/console sylius:cart:flush</info>
EOT
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('event_dispatcher')->dispatch(SyliusCartEvents::CART_FLUSH);
        $this->getContainer()->get('sylius_cart.manager.cart')->flushCarts();

        $output->writeln('<info>[Sylius:Cart]</info> Deleted expired carts.');
    }
}
