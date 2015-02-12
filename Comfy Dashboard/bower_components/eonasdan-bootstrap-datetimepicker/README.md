# Bootstrap v3 datetimepicker widget ![GitHub version](https://badge.fury.io/gh/Eonasdan%2Fbootstrap-datetimepicker.png)

![DateTimePicker](https://i.imgur.com/nfnvh5g.png)

### [⇢ View the manual and demos](https://eonasdan.github.io/bootstrap-datetimepicker/)

##Where do you use this?
I'd love to know if your public site is using this plugin and list your logo on the documentation site. Please email me `eonasdan at outlook dot com`

## Quick installation using

## [bower](https://bower.io): ![Bower version](https://badge.fury.io/bo/eonasdan-bootstrap-datetimepicker.png)

Run the following command:
```
bower install eonasdan-bootstrap-datetimepicker#latest --save
```
## [Nuget](https://www.nuget.org/packages/Bootstrap.v3.Datetimepicker/): ![NuGet version](https://badge.fury.io/nu/Bootstrap.v3.Datetimepicker.png)
```
PM> Install-Package Bootstrap.v3.Datetimepicker
```

## [Rails](https://rubyonrails.org/) ![Gem Version](https://badge.fury.io/rb/bootstrap3-datetimepicker-rails.png)

Add the following to your `Gemfile`:
```
gem 'momentjs-rails', '~> 2.5.0'
gem 'bootstrap3-datetimepicker-rails', '~> 2.1.20'
```
Read the rest of the install instructions @ 
[TrevorS/bootstrap3-datetimepicker-rails](https://github.com/TrevorS/bootstrap3-datetimepicker-rails)


## See the [Change Log](#change-log) for important changes and updates

Include necessary scripts and styles:
```html
<head>
  <!-- ... -->
  <script type="text/javascript" src="/bower_components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
</head>
```

Done! [Now take a look at the manual](https://eonasdan.github.io/bootstrap-datetimepicker/) for examples and available options.



## Manual installation

### [Moment.js](https://github.com/moment/moment)
Datetimepicker requires moment.js. This allows for better support for various date formats and locales. See [documentation](https://eonasdan.github.io/bootstrap-datetimepicker/) for examples. Check [Momentjs' homepage](https://momentjs.com/) for documentation on date formats. If you can't use moment.js there's still older version of datetimewidget [available here](https://github.com/Eonasdan/bootstrap-datetimepicker/tree/version1). 

```html
<script type="text/javascript" src="/path/to/moment.js"></script>
```

### Bootstrap 3 collapse and transition plugins
Make sure to include *.JS files for plugins [collapse](https://getbootstrap.com/javascript/#collapse) and [transitions](https://getbootstrap.com/javascript/#transitions). They are included with [bootstrap in js/ directory](https://github.com/twbs/bootstrap/tree/master/js)

```html
<script type="text/javascript" src="/path/to/bootstrap/js/transition.js"></script>
<script type="text/javascript" src="/path/to/bootstrap/js/collapse.js"></script>
```

Alternatively you could include the whole bundle of bootstrap plugins from [bootstrap.js](https://github.com/twbs/bootstrap/tree/master/dist/js)

```html
<script type="text/javascript" src="/path/to/bootstrap/dist/bootstrap.min.js"></script>
```


### CSS styles

#### Using LESS
```css
@import "/path/to/bootstrap/less/variables";
@import "/path/to/bootstrap-datetimepicker/src/less/bootstrap-datetimepicker";

// [...] your custom styles and variables
```

#### Using CSS (default color palette)
```html
<link rel="stylesheet" href="/path/to/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
```

### Main JS file

Finally include the main javascript file.
```html
<script type="text/javascript" src="/path/to/bootstrap-datetimepicker.min.js"></script>
```

# Change Log

## 2.1.30
#### Important! `build.less` file name has been been changed to `bootstrap-datetimepicker-build.less` to prevent collisions

* Fix for #135: `setStartDate` and `setEndDate` should now properly set.
* Fix for #133: Typed in date now respects en/disabled dates
* Fix for #132: En/disable picker function works again
* Fix for #117, #119, #128, #121: double event `change` event issues should be fixed
* Fix for #112: `change` function no longer sets the input to a blank value if the passed in date is invalid

* Enhancement for #103: Increated the `z-index` of the widget

## 2.1.20
* Fix for #83: Changes to the picker should fire native `change` event for knockout and the like as well as `change.dp` which contains the old date and the new date
* Fix for #78: Script has been update for breaking changes in Moment 2.4.0
* Fix for #73: IE8 should be working now

* Enhancement for #79: `minuteStepping` option takes a number (default is 1). Changing the minutes in the time picker will step by this number.
* Enhancement for #74 and #65: `useMinutes` and `useSeconds` are now options. Disabling seconds will hide the seconds spinner. Disabling minutes will display `00` and hide the arrows
* Enhancement for #67: Picker will now attempt to convert all `data-OPTION` into its appropriate option

## 2.1.11
* Fix for #51, #60
* Fix for #52: Picker has its own `moment` object since moment 2.4.0 has removed global reference
* Fix for #57: New option for `useStrict`. When validating dates in `update` and `change`, the picker can use a stricter formatting validation
* Fix for #61: Picker should now properly take formatted date. Should also have correct start of the week for locales.
* Fix for #62: Default format will properly validate time picker only.

## 2.1.5
* Custom icons, such as Font Awesome, are now supported. (#49)  See [Example#9](https://eonasdan.github.io/bootstrap-datetimepicker/#example9)
* If more then one `input-group-addon` is present use `datepickerbutton` to identify where the picker should popup from. (#48)
* New Event: `error.dp`. Fires when Moment cannot parse the date or when the timepicker cannot change because of a `disabledDates` setting. Returns a Moment date object. The specific error can be found be using `invalidAt()`. For more information see [Moment's docs](https://momentjs.com/docs/#/parsing/is-valid/)
* Fix for #42, plugin will now check for `A` or `a` in the format string to determine if the AM/PM selector should display.
* Fix for #45, fixed null/empty and invalid dates
* Fix for #46, fixed active date highlighting
* Fix for #47, `change.dp` event to also include the previous date.

####2.0.1
* New event `error.dp` fires when plugin cannot parse date or when increase/descreasing hours/minutes to a disabled date.  See [Example#7](https://eonasdan.github.io/bootstrap-datetimepicker/#example7)
* Minor fixes

####2.0.0
* `disabledDates` is now an option to set the disabled dates. It accepts date objects like `new Date("November 12, 2013 00:00:00")` and `12/25/2013' and `moment` date objects. See [Example#7](https://eonasdan.github.io/bootstrap-datetimepicker/#example7) for usage.
* Events are easier to use; see [Example#8](https://eonasdan.github.io/bootstrap-datetimepicker/#example8)
