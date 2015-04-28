<?php
class myI18NFilter extends sfFilter
{
    public function execute ($filterChain)
    {
        // Get and cache translations
        $rows = Doctrine_Query::create()
            ->from('I18NItem i')
            ->leftJoin('i.Translation t')
            ->execute()
        ;

        $i18n = [];
        foreach ($rows as $row) {
            $i18n[$row->slug] = [
                'ru' => $row->Translation['ru']->name,
                'en' => $row->Translation['en']->name,
            ];
        }

        sfConfig::set('i18n', $i18n);

        $filterChain->execute();
    }
}
