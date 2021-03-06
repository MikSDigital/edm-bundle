<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * EDM extension.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\DependencyInjection
 * @final
 */
final class EDMExtension extends Extension {

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container) {

        // Create the file locator.
        $fileLocator = new FileLocator(__DIR__ . "/../Resources/config");

        // Load the services.
        $serviceLoader = new YamlFileLoader($container, $fileLocator);
        $serviceLoader->load("services.yml");
    }

}
