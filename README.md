Meta SEO plugin 
===================
Add MetaSeo plugin to Yellow blog. [See demo](https://yellow.jar.io/made-for-people).

## How to install plugin

1. [Download and install Datenstrom Yellow](https://github.com/datenstrom/yellow/).
2. [Download and install blog plugin](https://github.com/datenstrom/yellow-plugins/tree/master/blog).
3. [Download plugin](https://github.com/datenstrom/yellow-plugins/raw/master/zip/metaseo.zip). If you are using Safari, right click and select 'Download file as'.
4. Copy `metaseo.zip` into your `system/plugins` folder.

To uninstall delete the [plugin files](update.ini).

## How to work Meta Seo

The plugin add in theme header the meta tags: 

```
<meta name="msvalidate.01" content="key bing webmaster" />
<meta name="google-site-verification" content="key google webmaster" />
<meta name="yandex-verification" content="key yandex webmaster" />
<meta property="fb:app_id" content="2000000000000000" />
<meta property="fb:admins" content="yourfacebooknickname"/>
```

### How to use Meta Seo 

Add to config.ini file 

	Facebook: yourfacebooknickname
	FacebookId: 2000000000000000
	metaGoogle: nsnsndSSDSDSSdsdsdSDSDSSsss
	metaMsn: DDUDUDU0D0D0D0D0D0D0D0D0D0D0D
	metaYandex: aaaabbbbbbbbddddd
	Googleplus: 112393291638185546781
	Googlepage: 112209419309743840429

To use the plugin open file `system/config/config.ini` and change to your value. 

## Developer

Datenstrom. [Get support](https://developers.datenstrom.se/help/support).
My Github https://github.com/jweblog

