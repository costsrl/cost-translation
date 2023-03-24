<?php
/**
 * Created by PhpStorm.
 * User: renato
 * Date: 02/10/18
 * Time: 18.28
 */

namespace Controller\Factory;

use CostAuthentication\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;


class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translator = $container->get('MvcTranslator');
        $indexController = new \CostTranslation\Controller\IndexController();
        $indexController->setServiceLocator($container);
        $indexController->setMvcTranslator($translator);
        return $indexController;
    }
}