<?php
namespace CostTranslation\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class LanguageMenu extends AbstractHelper
{

    protected $language = [];
    
    
    public function __construct($_language = []){
        $this->language = $_language;
    }
    
    /**
     * @return the $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param multitype: $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function __invoke()
    {
        return $this;
    }

    public function render()
    {
        $strLanguages = '';
        foreach ($this->language  as $key => $language){
            $strLanguages.= sprintf( "<li><a href=\"/switch-language/%s\">%s</a></li>",$key,$language);
        }
        
        $menu = <<<EOF
 <div class="navbar-text">
       <ul class="nav navbar-nav">
          $strLanguages
       </ul>
 </div>
EOF;
        return $menu;
    }
}

