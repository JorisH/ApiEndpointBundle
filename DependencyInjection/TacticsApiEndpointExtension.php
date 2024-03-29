<?php


namespace Tactics\ApiEndpointBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class TacticsApiEndpointExtension extends Extension
{

  /**
   * Loads a specific configuration.
   *
   * @param array $configs
   * @param ContainerBuilder $container
   * @throws \Exception
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $loader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
    $loader->load('services.xml');
  }
}