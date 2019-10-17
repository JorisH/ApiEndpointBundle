<?php

namespace Tactics\ApiEndpointBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Tactics\ApiEndpointBundle\Endpoint\Endpoint;

class ApiEndpointFactory
{
  protected $container;
  protected $endpoints;

  /**
   * @param ContainerInterface $container  The service container
   * @param array              $endpoints An array of validators
   */
  public function __construct(ContainerInterface $container, array $endpoints = array())
  {
    $this->container = $container;
    $this->endpoints = $endpoints;
  }

  /**
   * Returns the validator for the supplied constraint.
   *
   * @return ConstraintValidatorInterface A validator for the supplied constraint
   *
   * @throws ValidatorException      When the validator class does not exist
   * @throws UnexpectedTypeException When the validator is not an instance of ConstraintValidatorInterface
   */
  public function getInstance($id)
  {
    $name = 'tactics_api_endpoint.'.$id;
    if (!isset($this->endpoints[$name])) {
      throw new ValidatorException(sprintf('Service "%s" does not exist or it is not enabled.', $name));
    } elseif (\is_string($this->endpoints[$name])) {
      $this->endpoints[$name] = $this->container->get($name);
    }

    if (!$this->endpoints[$name] instanceof Endpoint) {
      throw new UnexpectedTypeException($this->endpoints[$name], 'Tactics\ApiEndpointBundle\Endpoint\Endpoint');
    }

    return $this->endpoints[$name];
  }
}