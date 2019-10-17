<?php


namespace Tactics\ApiEndpointBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class ApiEndpointPass implements CompilerPassInterface
{

  /**
   * You can modify the container here before it is dumped to PHP code.
   */
  public function process(ContainerBuilder $container)
  {
    // TODO: Implement process() method.
    $taggedServices = $container->findTaggedServiceIds('tactics_api_endpoint');

    $factoryDefinition = $container->getDefinition('tactics_api_endpoint.factory');

    $endpoints = [];
    foreach ($taggedServices as $id => $service) {
      $endpointDefinition = $container->getDefinition($id);

      if (!$endpointDefinition->isPublic()) {
        throw new InvalidArgumentException(sprintf('The endpoint "%s" must be public as it can be lazy-loaded.', $id));
      }

      if ($endpointDefinition->isAbstract()) {
        throw new InvalidArgumentException(sprintf('The endpoint "%s" must not be abstract as it can be lazy-loaded.', $id));
      }

      $endpoints[$id] = $endpointDefinition->getClass();
    }

    $factoryDefinition->replaceArgument(1, $endpoints);
  }
}