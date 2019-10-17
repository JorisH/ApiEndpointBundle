<?php

namespace Tactics\ApiEndpointBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tactics\ApiEndpointBundle\DependencyInjection\Compiler\ApiEndpointPass;

/**
 * Description of TacticsApiEndpointBundle
 *
 * @author Joris Hontelé <joris.hontele@tactics.be>
 */
class TacticsApiEndpointBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ApiEndpointPass());
    }
}


