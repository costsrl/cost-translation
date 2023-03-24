<?php
namespace CostTranslation\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use CostTranslation\View\Helper\LanguageMenu;

class LanguageMenuFactory implements FactoryInterface  
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO Auto-generated method stub
        $aConfig = $container->get("Config");
        $aLanguage = $aConfig["languageEnabled"];
        $LanguageMenu = new LanguageMenu($aLanguage);
        return $LanguageMenu;
        
    }

    
}


