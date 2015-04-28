<?php
function i18n ($slug, $text = 'Lorem ipsum dolor sit amet', $culture = 'ru') {
   return myI18N::get($slug, $text, $culture);
}