# geoblock
This is a WordPress plugin for creating blocks of content that display or not based on the user's country. After install the plugin you use it like this:

## System Requirements

You need to install and configure mod_geoip or the nginx equivalent so that the environment variable GEOIP_COUNTRY_CODE is set properly.

## Blacklisting

[geoblock type='blacklist' countries='xx,yy,zz']
my beautiful content
[/geoblock]

Countries are 2 letter ISO country codes. If you want to show a message to blocked users add the message argument:

[geoblock type='blacklist' countries='xx,yy,zz' message='Sorry but this content is not available in your area']
This content will show up in all countries other than xx,yy,zz
[/geoblock]

## Whitelisting

See blacklisting above. Just replace type='blacklist' with type='whitelist' to show content to visitors from specific countries only while blocking everyone else.

