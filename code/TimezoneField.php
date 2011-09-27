<?php

/**
 * Class populated with a list of timezones. We are using the
 * list that is similar to that of Windows, so it should over
 * all our bases.
 *
 * @package default
 * @author Tom Rix
 */
class TimezoneField extends DropdownField {
	static $timezone_list = array(
	  'GMT+1200' => 'Dateline - International Date Line West',
	  'Pacific/Apia' => 'Samoa - Midway Island, Samoa',
	  'Pacific/Honolulu' => 'Hawaiian - Hawaii',
	  'America/Anchorage' => 'Alaskan - Alaska',
	  'America/Los_Angeles' => 'Pacific - Pacific Time (US & Canada); Tijuana',
	  'America/Phoenix' => 'US Mountain - Arizona',
	  'America/Denver' => 'Mountain - Mountain Time (US & Canada)',
	  'America/Chihuahua' => 'Mexico Standard Time 2 - Chihuahua, La Paz, Mazatlan',
	  'America/Managua' => 'Central America - Central America',
	  'America/Regina' => 'Canada Central - Saskatchewan',
	  'America/Mexico_City' => 'Mexico - Guadalajara, Mexico City, Monterrey',
	  'America/Chicago' => 'Central - Central Time (US & Canada)',
	  'America/Indianapolis' => 'US Eastern - Indiana (East)',
	  'America/Bogota' => 'SA Pacific - Bogota, Lima, Quito',
	  'America/New_York' => 'Eastern - Eastern Time (US & Canada)',
	  'America/Caracas' => 'SA Western - Caracas, La Paz',
	  'America/Santiago' => 'Pacific SA - Santiago',
	  'America/Halifax' => 'Atlantic - Atlantic Time (Canada)',
	  'America/St_Johns' => 'Newfoundland - Newfoundland',
	  'America/Buenos_Aires' => 'SA Eastern - Buenos Aires, Georgetown',
	  'America/Godthab' => 'Greenland - Greenland',
	  'America/Sao_Paulo' => 'E. South America - Brasilia',
	  'America/Noronha' => 'Mid-Atlantic - Mid-Atlantic',
	  'Atlantic/Cape_Verde' => 'Cape Verde - Cape Verde Is.',
	  'Atlantic/Azores' => 'Azores - Azores',
	  'Africa/Casablanca' => 'Greenwich - Casablanca, Monrovia',
	  'Europe/London' => 'GMT - Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London',
	  'Africa/Lagos' => 'W. Central Africa - West Central Africa',
	  'Europe/Berlin' => 'W. Europe - Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
	  'Europe/Paris' => 'Romance - Brussels, Copenhagen, Madrid, Paris',
	  'Europe/Sarajevo' => 'Central European - Sarajevo, Skopje, Warsaw, Zagreb',
	  'Europe/Belgrade' => 'Central Europe - Belgrade, Bratislava, Budapest, Ljubljana, Prague',
	  'Africa/Johannesburg' => 'South Africa - Harare, Pretoria',
	  'Asia/Jerusalem' => 'Israel - Jerusalem',
	  'Europe/Istanbul' => 'GTB - Athens, Istanbul, Minsk',
	  'Europe/Helsinki' => 'FLE - Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius',
	  'Africa/Cairo' => 'Egypt - Cairo',
	  'Europe/Bucharest' => 'E. Europe - Bucharest',
	  'Africa/Nairobi' => 'E. Africa - Nairobi',
	  'Asia/Riyadh' => 'Arab - Kuwait, Riyadh',
	  'Europe/Moscow' => 'Russian - Moscow, St. Petersburg, Volgograd',
	  'Asia/Baghdad' => 'Arabic - Baghdad',
	  'Asia/Tehran' => 'Iran - Tehran',
	  'Asia/Muscat' => 'Arabian - Abu Dhabi, Muscat',
	  'Asia/Tbilisi' => 'Caucasus - Baku, Tbilisi, Yerevan',
	  'Asia/Kabul' => 'Afghanistan - Kabul',
	  'Asia/Karachi' => 'West Asia - Islamabad, Karachi, Tashkent',
	  'Asia/Yekaterinburg' => 'Ekaterinburg - Ekaterinburg',
	  'Asia/Calcutta' => 'India - Chennai, Kolkata, Mumbai, New Delhi',
	  'Asia/Katmandu' => 'Nepal - Kathmandu',
	  'Asia/Colombo' => 'Sri Lanka - Sri Jayawardenepura',
	  'Asia/Dhaka' => 'Central Asia - Astana, Dhaka',
	  'Asia/Novosibirsk' => 'N. Central Asia - Almaty, Novosibirsk',
	  'Asia/Rangoon' => 'Myanmar - Rangoon',
	  'Asia/Bangkok' => 'SE Asia - Bangkok, Hanoi, Jakarta',
	  'Asia/Krasnoyarsk' => 'North Asia - Krasnoyarsk',
	  'Australia/Perth' => 'W. Australia - Perth',
	  'Asia/Taipei' => 'Taipei - Taipei',
	  'Asia/Singapore' => 'Singapore - Kuala Lumpur, Singapore',
	  'Asia/Hong_Kong' => 'China - Beijing, Chongqing, Hong Kong, Urumqi',
	  'Asia/Irkutsk' => 'North Asia East - Irkutsk, Ulaan Bataar',
	  'Asia/Tokyo' => 'Tokyo - Osaka, Sapporo, Tokyo',
	  'Asia/Seoul' => 'Korea - Seoul',
	  'Asia/Yakutsk' => 'Yakutsk - Yakutsk',
	  'Australia/Darwin' => 'AUS Central - Darwin',
	  'Australia/Adelaide' => 'Cen. Australia - Adelaide',
	  'Pacific/Guam' => 'West Pacific - Guam, Port Moresby',
	  'Australia/Brisbane' => 'E. Australia - Brisbane',
	  'Asia/Vladivostok' => 'Vladivostok - Vladivostok',
	  'Australia/Hobart' => 'Tasmania - Hobart',
	  'Australia/Sydney' => 'AUS Eastern - Canberra, Melbourne, Sydney',
	  'Asia/Magadan' => 'Central Pacific - Magadan, Solomon Is., New Caledonia',
	  'Pacific/Fiji' => 'Fiji - Fiji, Kamchatka, Marshall Is.',
	  'Pacific/Auckland' => 'New Zealand - Auckland, Wellington',
	  'Pacific/Tongatapu' => 'Tonga - Nuku\'alofa',
	);
	
	function __construct($name, $title = null, $value = "", $form = null) {
		parent::__construct($name, $title, self::$timezone_list, $value, $form, _t(__CLASS__.'.EMPTYSTRING', 'Please select a timezone'));
	}
}