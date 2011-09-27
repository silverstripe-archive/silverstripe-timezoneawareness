<?php

class TimezoneAwareSiteConfig extends DataObjectDecorator {
	public function extraStatics() {
		return array(
			'db' => array(
				"Timezone" =>"Varchar(60)",
			),
			'defaults' => array(
				"Timezone" => "Pacific/Auckland",
			)
		);
	}
	
	function updateCMSFields(&$fields) {
		$fields->addFieldsToTab("Root.Main", array(
			$timezoneField = new TimezoneField("Timezone", _t('SiteConfig.TIMEZONE', "Timezone"))
		));
	
		if (!Permission::check('EDIT_SITECONFIG')) {
			$fields->makeFieldReadonly($timezoneField);
		}
	}
	
}
