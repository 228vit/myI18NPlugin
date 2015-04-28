<?php

/**
 * PluginI18NItem form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginI18NItemForm extends BaseI18NItemForm
{
    public function setup()
    {
        parent::setup();

        $this->embedI18n(['ru', 'en']);
    }
}
