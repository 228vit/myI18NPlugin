<?php

/**
 * myI18NPlugin configuration.
 * 
 * @package     myI18NPlugin
 * @subpackage  config
 * @author      228vit
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class myI18NPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (in_array('myI18NAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('myI18NRouting', 'addRouteForAdminConfig'));
    }
  }
}
