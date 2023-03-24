<?php
/**
 * Doctrine Db Loader
 *
 * Uses doctrine to grab translations from the DB that are compatible with ZF2 I18n
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   LaminasI18nDoctrineLoader
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace CostTranslation\RemoteLoader;

use Doctrine\ORM\EntityManager;
use Laminas\I18n\Translator\Loader\RemoteLoaderInterface;
use Laminas\I18n\Translator\TextDomain;


/**
 * DoctrineDbLoader
 *
 * Uses doctrine to grab translations from the DB that are compatible with ZF2 I18n
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   LaminasI18nDoctrineLoader
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class DoctrineDbLoader implements RemoteLoaderInterface
{

    protected $entityMgr;
    protected $entity;

    function __construct(EntityManager $entityMgr, $Entity = null)
    {
        $this->entityMgr = $entityMgr;
        $this->entity = $Entity;
    }

    /**
     * Load translations from the DB
     *
     * @param  string $locale example: en_US
     * @param  string $UnusedTextDomain not used
     *
     * @return \Laminas\I18n\Translator\TextDomain
     */
    public function load($locale, $UnusedTextDomain = null)
    {
        $entity = "CostTranslation\Entity\Message";
        $locale = ucfirst(explode("_", $locale)[0]);
        $strEnityField = "text$locale";
        $messages = $this->entityMgr->createQuery(
            "SELECT m FROM $entity m"
        )->getArrayResult();

        $textDomain = new TextDomain();

        foreach ($messages as $message) {
            $textDomain[$message['key']] = $message[$strEnityField];
        }

        return $textDomain;
    }
} 