# Timezone-Theme
Theme designed for the custom module Timezone

CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * Maintainers

INTRODUCTION
------------

The module which displays the current time based on the timezone configured in the site and rendered using the custom theme timezone_theme

REQUIREMENTS
------------

Need to install the theme  timezone_theme before installing the module

INSTALLATION
------------

 *  Download and install the custom theme(timezone_theme) by - git clone https://github.com/Chaithumini/timezone_theme.git and place under ../themes/custom/
 *  Go to Admin > Structure >  Appearence > Install Timezone Theme and set as default theme.
 *  Download the module custom_timezone:  git clone https://github.com/Chaithumini/custom_timezone.git place ihe module within ../modules/custom/
 *  Go to Admin > Structure > Extend > Timezone install
 *  Clear all caches
 
CONFIGURATION
-------------
To configure the Timezone Settings

  *  Go to Admin > Timezone settings (Placed in the Admin toolbar).
  *  Enter the Country, City and Select the Timezone from the given list.
  *  Save the changes.
  *  Site Administrator can have the permission to set the Timezone.
  
PATH
----
Path to the Timezone settings configuration : /admin/config/custom_timezone/timezone_settings
