<?php


namespace Tactics\ApiEndpointBundle\Endpoint;


interface Endpoint
{
  public function getId();

  public function handle();
}