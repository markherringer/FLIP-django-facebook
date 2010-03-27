<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
  }

  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
  }
}
