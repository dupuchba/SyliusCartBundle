<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CartBundle\Tests\DependencyInjection;

use Sylius\Bundle\CartBundle\DependencyInjection\SyliusCartExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * DIC extension test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusCartExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessDriverSet()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['driver']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLoadThrowsExceptionUnlessDriverIsValid()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        $config['driver'] = 'foo';
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLoadThrowsExceptionUnlessEngineIsValid()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        $config['engine'] = 'foo';
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessOperatorSet()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['operator']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessResolverSet()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['resolver']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessCartModelClassSet()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['classes']['model']['cart']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessItemModelClassSet()
    {
        $loader = new SyliusCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['classes']['model']['item']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * Get testing config.
     *
     * @return array
     */
    protected function getEmptyConfig()
    {
        $yaml =
<<<EOF
driver: doctrine/orm
operator: test_cart.operator
resolver: test_cart.resolver
classes:
    model:
        cart: Acme\\Bundle\\CartBundle\\Entity\\Cart
        item: Acme\\Bundle\\CartBundle\\Entity\\Item
EOF;

        $parser = new Parser();

        return $parser->parse($yaml);
    }
}
