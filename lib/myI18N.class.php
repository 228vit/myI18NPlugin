<?php

class myI18N extends sfConfig
{

    /**
     * Retrieves a config parameter from array prepared by myI18NFilter,
     * and check if this parameter does not exists in Config table
     *
     * @param string $value A config parameter name
     * @param mixed $default A default config parameter value
     *
     * @return mixed A config parameter value, if the config parameter exists, otherwise null
     */
    public static function get($slug, $default_value = 'lorem ipsum', $default_culture = 'ru')
    {
        $current_culture = sfContext::getInstance()->getUser()->getCulture();
        $other_culture = $current_culture == 'ru' ? 'en' : 'ru';

        $i18n = sfConfig::get('i18n', []);

        // search slug
        if (!isSet($i18n[$slug])) {

            $res = Doctrine_Query::create()
                ->from('I18NItem i')
                ->where('i.slug = ?', $slug)
                ->fetchOne();

            if (!$res) {
                $c = new I18NItem();
                $c->slug = $slug;

                // set both translations the same value
                $c->Translation[$default_culture]->name = $default_value;
                $c->Translation[$other_culture]->name = $default_value;
                $c->save();

                // save default value to sfConfig
                $i18n[$slug] = [
                    'ru' => $c->Translation[$default_culture]->name,
                    'en' => $c->Translation[$other_culture]->name,
                ];

            } else {
                // save default value to sfConfig
                $i18n[$slug] = [
                    'ru' => $res->Translation[$default_culture]->name,
                    'en' => $res->Translation[$other_culture]->name,
                ];
            }

            sfConfig::set('i18n', $i18n);
        }

        return $i18n[$slug][$current_culture];
    }

}

