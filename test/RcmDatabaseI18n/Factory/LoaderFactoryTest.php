<?php

namespace CostTranslationTest\RemoteLoader;

use Laminas\I18n\Translator\LoaderPluginManager;
use Laminas\ServiceManager\ServiceManager;
use LaminasI18nDoctrineLoader\Factory\LoaderFactory;

require __DIR__ . '/../../autoload.php';

class LoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers LaminasI18nDoctrineLoader\Factory\LoaderFactory
     */
    function testCreateService()
    {
        $sm = new ServiceManager();
        $sm->setService(
            'Doctrine\ORM\EntityManager',
            $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock()
        );
        $loadPluginMgr = new LoaderPluginManager();
        $loadPluginMgr->setServiceLocator($sm);
        $unit = new LoaderFactory();
        $this->assertInstanceOf(
            'LaminasI18nDoctrineLoader\RemoteLoader\DoctrineDbLoader',
            $unit->createService($loadPluginMgr)
        );
    }
}