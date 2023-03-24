CostAuthorization
=======

**What is CostTranslation**

CostAuthorization is a Module for CostAuthorization based on Laminas Framework  2 / 3

**What exactly does CostTranslation?**

Installation
============

Installation via composer is supported, just make sure you've set ```"minimum-stability": "dev"```
in your ```composer.json```file and after that run ```php composer.phar require cost/Cost-navigation:zf3`

Go to your application configuration in ```./config/application.config.php```and add 'CostNavigation'.
copy costlanguage.global.php.dist to ./config/autoload
An example application configuration could look like the following:


render menu in layout.phtml

<?php echo  $this->menulanguage()->render();?>


composer.json

"repositories": [
        {
            "type": "vcs",
            "url": "https://gitlab.cost.it/cost/cost-translation.git"
        }
    ]

"

require-dev" : {
		"cost/cost-translation" : "dev-ZF3"
	}
	

for  autoload open main composer.json and add under autoload key
"autoload" : {
    "psr-4" : {
      "CostTranslation" : "vendor/cost/cost-translation/src",
    }
```	

module requirements
```
'modules' => array(
    'Application',
    'CostBase',
    'CostAuthentication',
    'CostAuthorization'
)
```

CostAuthorization configuration
=============

example usage
<h1 class="display-4"><?php echo $this->translate('welcome','db');?> to<br>Laminas MVC Skeleton Application</h1>
Pay Attention to context 'db'
```