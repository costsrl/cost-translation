<?php
/**
 * Created by PhpStorm.
 * User: renato
 * Date: 15/10/18
 * Time: 21.27
 */

namespace CostTranslation\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CostAuthentication\ContainerAwareInterface;
use CostAuthentication\ContainerAwareTrait;


class TranslationFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $aTranslationFixture = $this->container->get('translation-fixture');
    }

    public function getOrder()
    {
        return 5;
    }
}