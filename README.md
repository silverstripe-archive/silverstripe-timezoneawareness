# Timezone Awareness Module #

## Overview ##

The module extends the built-in `DatetimeField` form field with `TZDateTimeField`,
which allows selection of date and time, with a timezone dropdown.
This enables an automatic conversion between a user selected
timezone and the server timezone when saving the field,
but it also allows converting the date on the fly by
changing to a different timezone. 
Internally, the date and time are always saved 
in the server timezone, so this is a purely presentational setting.

The module also extends `SiteConfig` to enable default user timezones,
which then get picked up by `TZDateTimeField`. This is particularly
handy when using the "[subsites](silverstripe.org/subsites-module)" module
where each subsite has its own `SiteConfig` record. If each subsite
stands for a geographic region with authors located all over the world,
these authors can have individual user timezones set.

The `TZDateTimeField` is automatically picked up by the
"[cmsworkflow](http://www.silverstripe.org/cms-workflow-module/)" module
because it uses `Object::create('DatetimeField')` instead of `new DatetimeField()`.
In other modules and custom code, you'll have to use the field directly,
or replace any existing fields manually via `FieldSet->replaceField()`.

*Note: Currently just works with NZ date format (`d/m/Y`).*

## Requirements ##

 * SilverStripe 2.5

## Maintainers ##

 * Tom Rix (@rixth)
 * Ingo Schommer (@chillu)