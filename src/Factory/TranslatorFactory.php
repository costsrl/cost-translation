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

use CostTranslation\RemoteLoader\Database;
use Interop\Container\ContainerInterface;
use Laminas\I18n\Translator\LoaderPluginManager;
use Laminas\I18n\Translator\Translator;
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
class TranslatorFactory implements FactoryInterface
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
        $translator = Translator::factory($config['translator']);
        /**
         * Work-around for the translator loader plugin manager not having a config
         * key that it looks for.
         */
        foreach ($config['translator_loaders']['factories'] as $name => $factory) {
            // passo il container che è gia valorizzato con il servizio
            $translator->setPluginManager(new LoaderPluginManager($container));
            $pluginManager = $translator->getPluginManager();
            $pluginManager->setFactory(
                $name, $factory
            );
        }

        //var_dump($translator);die();
        return $translator;
    }
}