<?php
/**
 * Extends the existing {@link DatetimeField} with a 
 * with the option to restrict available timezones.
 */
class TZDateTimeField extends DatetimeField {

	/**
	 * @var array See {@link getTimezones()}
	 */
	protected $timezones = null;

	/**
	 * @var array See {@link getTimezones()}
	 */
	static $default_timezones = array(
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
	
	function __construct($name, $title = null, $value = "") {
		parent::__construct($name, $title, $value);
		
		$this->timezoneField = new DropdownField($this->Name() . '[timezone]', false, $this->getTimezones());
		$this->timezoneField->setEmptyString(_t('TzDatetimeField.EMPTYSTRING', 'Please select a timezone'));
		
		// Default to system timezone, which might be overwritten later
		$this->setConfig('usertimezone', date_default_timezone_get());
		
		// TODO Remove hardcoded date format assumptions.
		// For now, we override field, system or user defaults for anything other than en_NZ
		// and its date/time formats
		$this->dateField->setConfig('dateformat', 'dd/MM/YYYY');
		$this->dateField->setConfig('timeformat', 'HH:mm');
	}
	
	function Type() {
		return parent::Type() . ' datetime';
	}
	
	/**
	 * Map of PHP timezone identifiers to their labels.
	 * Defaults to {@link $default_timezones} if none are set for the instance.
	 * 
	 * @return array 
	 * @see http://php.net/manual/en/timezones.php
	 */
	function getTimezones() {
		return ($this->timezones) ? $this->timezones : self::$default_timezones;
	}
	
	/**
	 * @var array See {@link getTimezones()}
	 */
	function setTimezones($zones) {
		$this->timezones = $zones;
		$this->timezoneField->setSource($zones);
	}
	
	function FieldHolder() {
		// TODO HTML5 data attributes would be better, but hard to add in the current framework
		$this->addExtraClass(Convert::raw2att(Convert::raw2json(array(
			// 'convertURL' => $this->Link('doConvert')
			'convertURL' => 'TZDateTimeField_Controller/convert'
		))));
		
		return parent::FieldHolder();
	}
	
	function Field() {
		$html = parent::Field();
		
		Requirements::javascript(THIRDPARTY_DIR . '/prototype/prototype.js');
		Requirements::javascript(THIRDPARTY_DIR . '/behaviour/behaviour.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-metadata/jquery.metadata.js');
		Requirements::javascript('timezoneawareness/javascript/TZDateTimeField.js');
		
		return $html;
	}
	
 	static function convert($fromTz, $toTz, $datetime, $format = 'r') {
		$oldTz = date_default_timezone_get();
		
		date_default_timezone_set($fromTz);
		$time = strtotime($datetime);
		date_default_timezone_set($toTz);
		$return = date($format, $time);
		
		date_default_timezone_set($oldTz);
		
		return $return;
	}
}

class TZDateTimeField_Controller extends Controller {
	function convert() {
		$fromTz = urldecode($_REQUEST['fromTz']);
		$toTz = urldecode($_REQUEST['toTz']);
		$datetime = $_GET['datetime'];
		
		$return = array(
			'rfc' => TZDateTimeField::convert($fromTz, $toTz, $datetime, 'r'),
			'ymd12hr' => TZDateTimeField::convert($fromTz, $toTz, $datetime, 'Y-m-d h:i:s a'),
			'ymd24hr' => TZDateTimeField::convert($fromTz, $toTz, $datetime, 'Y-m-d H:i:s'),
			'popupdatetime' => TZDateTimeField::convert($fromTz, $toTz, $datetime, 'd/m/Y H:i'),
		);
		
		echo Convert::raw2json($return);
	}
}