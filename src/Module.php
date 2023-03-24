<?php

/**
 * Module Config For ZF2
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */

namespace CostTranslation;

use Laminas\Console\Request as ConsoleRequest;
use Laminas\I18n\Translator\Resources;
use Laminas\I18n\Translator\Translator as Translator;
use Laminas\Mvc\ModuleRouteListener;
use Laminas\Mvc\MvcEvent;
use Laminas\Validator\AbstractValidator;

/**
 * ZF2 Module Config.  Required by ZF2
 *
 * ZF2 requires a Module.php file to load up all the Module Dependencies.  This
 * file has been included as part of the ZF2 standards.
 *
 * @category  Reliv
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 */
class Module
{
    /**
     * getAutoloaderConfig() is a requirement for all Modules in ZF2.  This
     * function is included as part of that standard.  See Docs on ZF2 for more
     * information.
     *
     * @return array Returns array to be used by the ZF2 Module Manager
     */
    /**
     * getConfig() is a requirement for all Modules in ZF2.  This
     * function is included as part of that standard.  See Docs on ZF2 for more
     * information.
     *
     * @return array Returns array to be used by the ZF2 Module Manager
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        //$this->initErrorHandler($e);
        $sharedManager = $e->getApplication()->getEventManager()->getSharedManager();
        $sharedManager->attach('*', MvcEvent::EVENT_DISPATCH, [$this, 'initCurrentLocale'], 10);
        //$this->injectLocaleValidator($e);
    }


    /**
     * @param MvcEvent $e
     */
    public function initCurrentLocale(MvcEvent $e)
    {
        $request = $e->getRequest();
        $sessionManager = $e->getApplication()->getServiceManager()->get('session_admin_manager');
        if ($request instanceof ConsoleRequest) {
            return true;
        }

        $routematch = $e->getRouteMatch();
        $lang = ($routematch->getParam("language")) ?: null;
        $redirect = ($routematch->getParam("redirect")) ?: null;

        if (isset($lang)) {
            $sessionManager->lang = $lang;
        } else {
            $lang = $sessionManager->lang;
        }


        /** @var Translator $translator */
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator->setLocale($lang);


        $langpath = (explode("_", $lang)[0]) ? (explode("_", $lang)[0]) : 'en';
        $translator->addTranslationFile('phpArray', Resources::getBasePath() . $langpath . DIRECTORY_SEPARATOR . 'Laminas_Validate.php');
        $translator->addTranslationFile('phpArray', Resources::getBasePath() . $langpath . DIRECTORY_SEPARATOR . 'Laminas_Captcha.php');
        AbstractValidator::setDefaultTranslator($translator);

        // Inject current language in view model
        $e->getViewModel()->setVariable('lang', $lang);
        $e->getViewModel()->setVariable('langModule', true);
    }

}