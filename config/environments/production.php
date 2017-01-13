<?php

Config::write('Yaml.cache', true);

Config::write('Api.ignoreAuth', true);
Config::write('Preview.url', 'http://placeholder.meumobi.com');
Config::write('Sites.domain', 'meumobi.com');

Config::write('Themes.url', 'http://meu-template-repository.meumobi.com/config/themes.json');

Config::write('PushWoosh.debug', false);

Config::write('Status.sites', [
	'180back.meumobi.com',
	'infobox.meumobi.com',
	'dnadigital.meumobi.com',
]);
