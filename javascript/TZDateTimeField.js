TZDateTimeField = {
	data: null,
	
	initialise : function () {
		this.timezoneSelector = jQuery(this).find(':input[name$="\[timezone\]"]')[0];
		this.dateInput = jQuery(this).find(':input[name$="\[date\]"]')[0];
		this.timeInput = jQuery(this).find(':input[name$="\[time\]"]')[0];
		this.pastValue = this.timezoneSelector.options[this.timezoneSelector.selectedIndex].value;
		this.timezoneSelector.onchange = this.convert.bind(this);
	},
		
	convert: function() {
		if (!this.dateInput.value) return false;
		
		var self = this;
		
		// TODO Support more than NZ date formats
		var dateUser = this.dateInput.value.split('/');
		var dateISO = dateUser[2]+'-'+dateUser[1]+'-'+dateUser[0];
		
		var metadata = jQuery(this).metadata({type: 'class'});
		var url = metadata.convertURL;
		url += '?' + jQuery.param({
			fromTz: this.pastValue, 
			toTz: jQuery(this.timezoneSelector).val(), 
			datetime: dateISO + ' ' + this.timeInput.value
		});
		
		jQuery(this.timezoneSelector).attr('disabled', 'disabled');
		jQuery(this.timeInput).attr('disabled', 'disabled');
		jQuery(this.dateInput).attr('disabled', 'disabled');
		jQuery.ajax({
			url: url, 
			dataType: 'json',
			success: function(data) {
				// TODO Fixed date format assumptions
				jQuery(self.dateInput).val(data.popupdatetime.split(' ')[0]);
				jQuery(self.timeInput).val(data.popupdatetime.split(' ')[1]);
			},
			complete: function() {
				jQuery(self.timezoneSelector).removeAttr('disabled');
				jQuery(self.timeInput).removeAttr('disabled');
				jQuery(self.dateInput).removeAttr('disabled');
			}
		});

		this.pastValue = jQuery(this.timezoneSelector).val();
		
		return false;
	}
};

Behaviour.register({
	'div.tzdatetime' : TZDateTimeField
});