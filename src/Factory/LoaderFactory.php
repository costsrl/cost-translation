<?php
/**
 * MvcTranslatorFactory.php
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   src\LaminasI18nDoctrineLoader
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace CostTranslation\Factory;

use CostTranslation\RemoteLoader\DoctrineDbLoader;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;


/**
 * MvcTranslatorFactory
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   src\LaminasI18nDoctrineLoader
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class LoaderFactory implements FactoryInterface
{

    /*
    * @param ContainerInterface $container
    * @param string $requestedName
    * @param null|array $options
    * @return Translator
    */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        return new DoctrineDbLoader($container->get('Doctrine\ORM\EntityManager'), $config["translator"]["remote_translation"][0]["entity"]);
    }
}