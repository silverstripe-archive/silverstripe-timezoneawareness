<?php

Director::addRules(10, array(
	'TZDateTimeField/convert' => 'TZDateTimeField_Controller'
));

Object::add_extension('SiteConfig', 'TimezoneAwareSiteConfig');
Object::useCustomClass('DatetimeField', 'TZDateTimeField');