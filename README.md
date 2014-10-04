Archaius Theme
==============

What is Archaius
----------------

Archaius is a moodle's theme with several options to customize your Moodle:

 * Upload logo.
 * Upload mobile logo.
 * Footnote.
 * Background color.
 * Header and footer color.
 * Tabs color (to be used with blocks titles).
 * Color for the current block tab (block titles).
 * Color of the current item in custom menu.
 * Activation of the collapsible topics effect.
 * Activation of the hide/show blocks effect.
 * Activation frontpage slideshow.
 * Custom CSS.
 * Custom Javascript in footer.
 * Color of custom menu.
 * Set timeout of the slider.
 * Set height of the front page slider (pixels).

 @copyright  2013 onwards Daniel Munera Sanchez

Getting Starting
----------------

Archaius uses jQuery as a javascript framework and several jQuery plugins as well:

* A modified version of [responsiveslides](https://github.com/dmuneras/ResponsiveSlides.js)
* VelocityJS
* Waypoints
* Modernizr 

I have been using [LESS](http://lesscss.org/) to create CSS stylesheets.


If you want to modify the stylesheets, or jquery plugins, you should use Grunt. I configured a Gruntfile.js, so, you only need to install it and use it. Take a look of this
website if you have any problem installing Grunt => [Getting Starting](http://gruntjs.com/getting-started)

After read the Grunt getting starting, you only have to run the Grunt command in the root
directory of archaius.

```javascript

grunt

```
After this any change you do in jQuery plugins or LESS source will be reflected in your CSS
and Javascript.

If you want to modify the archaius YUI module, yout have to install YUI shifter:

npm install shifter@0.4.6 -g

take a look to this: [YUI shifter docs in Moodle](https://docs.moodle.org/dev/YUI/Shifter)



Improvements history:
---------------------

03.10.2014
----------


* Display block for weekly format when topics effects is not activate.
* Adding solutions for issues to core: calendar colors, grades container overflow

13.09.2014
----------

* Adding Open Sans font from google, it is not loaded using google scripts (personal
decision).

11.08.2014
----------

* Loading jquery plugins only when they are need.
* new option to deactive accordion blocks.
* new option to set up slideshow height using a number (pixels without the 'px')


08.08.2014
----------

* Working on PHP improvements
* new option to change color of custommenu
* page header layout change
* rewriting lib.php

07.08.2014
----------

* Adding clear cache until theme settings update
* Grunt added
* Preview settings page is now working too.
* Upload logo is possible in setting page
* New setting : mobile logo
* Velocity added to custom_blocks effect 

06.07.2014
----------

* Adding options to manipulate Slideshow.

2.06.2014
---------

* Improvements on JS, changing blocks effect.

20.06.2013
----------

* Better shape of block in the main content.
* New option in the setting page to activate and desactivate the hide and show blocks effect.
* Link inside main container are now blue to make them easier to find.

09.09.2013
----------

* New front page with a carousel of information that could be edited by admin users

21.09.2013
-----------

* The creation of tabs for course topics was fixed. Dependencies between tabs and summaries have been erased (reported issue)

14.10.2013
----------

* Better slideshow: possibility to activate or deactivate it, side-center-[pre|post] added.


05.12.2013
----------

* Working on moodle 26 version and general improvements related with javascript.

22.12.2013
----------

* Writing LESS and reviewing CSS and Javascript as well as HTML5 fallback for IE.
Going responsive without Bootstrap.
