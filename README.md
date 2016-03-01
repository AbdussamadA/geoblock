# geoblock
This is a WordPress plugin for creating blocks of content that are shown or hidden based on the visitor's country. 

## System Requirements

You need to install and configure mod_geoip or the nginx equivalent so that the environment variable GEOIP_COUNTRY_CODE is set properly. PHP version 5.3 or greater is required.

## Blacklisting

[geoblock type='blacklist' countries='xx,yy,zz']
my beautiful content
[/geoblock]

The countries argument consists of [2 letter ISO country codes](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) separated by commas. 

## Whitelisting

Just replace type='blacklist' with type='whitelist' to show content to visitors from specific countries only while blocking everyone else.

## Message to blocked users

If you want to show a message to blocked users add the message argument:

[geoblock type='blacklist' countries='xx,yy,zz' message='Sorry but this content is not available in your area']
This content will show up in all countries other than xx,yy,zz
[/geoblock]

This works for both whitelists and blacklists. The message argument can only contain plain text messages. For more complex messages create 
both a blacklist and a whitelist block.

