<?php

require_once  dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
   // $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
   //$this->enablePlugins(array('sfCompat10Plugin', 'sfDoctrineManagerPlugin'));
   $this->enablePlugins(array('sfDoctrinePlugin','sfProtoculousPlugin','sfCompat10Plugin','sfModalBoxPlugin'));


  }
}
