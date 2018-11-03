<?php
// MetaSeo plugin, https://github.com/datenstrom/yellow-plugins/tree/master/metaseo
// Copyright (c) 2013-2017 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.

/*
ToDo
Add to text.ini file (/system/config/text.ini) this, change the value:

## /system/config/text.ini

authorDescription: text about you
name: your name surname 	
jobTitle: 
nameOrganization:  
organizationDescription: text about your organization/localbusiness
url: your url 
photo: your photo http://avatar.url.png
streetAddress: 
postOfficeBoxNumber: 
addressLocality: 
addressRegion: 
postalCode: 
addressCountry: 
geoRegion: US-NY for example
email: 
telephone: 
birthDate: 2000-00-00
latitude: -15.802807 
longitude: -47.880025

googlePlus: 112393291638185546781
Facebook: joejonh
FacebookId: 999999999999
Youtube: joejonh
Linkedin: joejonh
Github: joejonh
Instagram: joejonh
Twitter: joejonh

clickyID: 0000000

metaGoogle: see google webmaster tool
metaMsn:  see bing webmaster tool
metaYandex:  see yandex webmaster tool
*/

class YellowMetaSeo
{
	const VERSION = "0.7.4";
	var $yellow;			//access to API	
	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;		
		$this->yellow->config->setDefault("metaMsn", "");
		$this->yellow->config->setDefault("metaGoogle", "");
		$this->yellow->config->setDefault("metaYandex", "");
		$this->yellow->config->setDefault("facebookId", "");	
		$this->yellow->config->setDefault("facebook", "");
		$this->yellow->config->setDefault("googlePlus", "");			
	}	
	// Handle page extra HTML data
	function onExtra($name)
	{
		$output = NULL;
		if($name=="header")
		{			
			$msnId = $this->yellow->text->get("metaMsn");
			if (!empty($msnId)) $output .= "<meta name=\"msvalidate.01\" content=\"".strencode($msnId)."\" />\n";
			$googId = $this->yellow->text->get("metaGoogle");
			if (!empty($googId))$output .= "<meta name=\"google-site-verification\" content=\"".strencode($googId)."\" />\n";
			$yanId = $this->yellow->text->get("metaYandex");
			if (!empty($yanId))$output .= "<meta name=\"yandex-verification\" content=\"".strencode($yanId)."\" />\n";
			$fbId = $this->yellow->text->get("facebookId");
			if (!empty($fbId))$output .= "<meta property=\"fb:app_id\" content=\"".strencode($fbId)."\" />\n";
			$fbadminId = $this->yellow->text->get("facebook");
			if (!empty($fbadminId)) $output .= "<meta property=\"fb:admins\" content=\"".strencode($fbadminId)."\" />\n";			
			$gplusId = $this->yellow->text->get("googlePlus");
			if (!empty($gplusId))$output .= "<link rel=\"publisher\" href=\"https://plus.google.com/".strencode($gplusId)."\" />\n";

			$output .="\n<!-- JSON D SNIPET for Google -->\n\r";
			$output .= "<script type=\"application/ld+json\">\r\n";
			$output .= "{\r\n";
			$output .= "  \"@context\": \"http://schema.org/\",\r\n";
			$output .= "  \"@type\": \"WebSite\",\r\n";
			$output .= "  \"name\": \"".$this->yellow->page->getHtml("sitename")."\",\r\n";
			$output .= "  \"alternateName\": \"".$this->yellow->page->getHtml("titleHeader")."\",\r\n";
			$output .= "  \"url\": \"".$this->yellow->page->scheme."://".$this->yellow->page->address.$this->yellow->page->base."/"."\",\r\n";
			$output .= "  \"potentialAction\": {\r\n";
			$output .= "    \"@type\": \"SearchAction\",\r\n";
			$output .= "    \"target\": \"search/query:{search_term_string}\",\r\n";
			$output .= "    \"query-input\": \"required name=search_term_string\"\r\n";
			$output .= "  }\r\n";
			$output .= "}\r\n";
			$output .= "</script>\r\n";			
			
			$output .= "\n\r<!-- og card -->\n<meta name=\"twitter:card\" content=\"summary\" />\r\n";
			$ttId = $this->yellow->text->get("twitter");
			if (!empty($ttId))$output .= "<meta name=\"twitter:creator\" content=\"@".strencode($ttId)."\" />\r\n";
			$output .= "<meta property=\"og:locale\" content=\"".$this->yellow->page->getHtml("language")."\" />\r\n";
			$output .= "<meta property=\"og:site_name\" content=\"".$this->yellow->page->getHtml("sitename")."\" />\r\n";
			$output .= "<meta property=\"article:tag\" content=\"".$this->yellow->page->get("tag")."\" />\r\n";			
			$output .= "<meta property=\"og:url\" content=\"".$this->yellow->page->getUrl()."\"/>\r\n";
			$output .= "<meta property=\"article:published_time\" content=\"".$this->yellow->page->getDateFormattedHtml("published", DATE_ATOM)."\" />\r\n";
			$output .= "<meta property=\"og:title\" content=\"".$this->yellow->page->getHtml("title")."\"/>\r\n";
			$output .= "<meta property=\"og:description\" content=\"".$this->yellow->page->getHtml("description")."\" />\r\n";
			if ($this->yellow->page->getHtml("image"))  { $output .= "<meta property=\"og:image\" content=\"".$this->yellow->page->getHtml("image")."\" />\r\n";} else { $output .= "<meta property=\"og:image\" content=\"".$this->yellow->page->scheme."://".$this->yellow->page->address.$this->yellow->page->base."/"."media/images/logo.png\" />\r\n";}	

			$output .="\n<!-- Geo Localization / Dublin Core -->\n\r";			
			$output .= "<meta name=\"DC.title\" content=\"".$this->yellow->page->getHtml("titleHeader")."\" />\r\n";
			$addresslocaty = $this->yellow->text->get("addressLocality");
			if (!empty($addresslocaty))$output .= "<meta name=\"geo.placename\" content=\"".$this->yellow->text->getHtml("addressLocality").",".$this->yellow->text->getHtml("addressRegion").",".$this->yellow->text->getHtml("addressCountry")."\" />\r\n";
			$georegion = $this->yellow->text->get("geoRegion");
			if (!empty($georegion))$output .= "<meta name=\"geo.region\" content=\"".$this->yellow->text->getHtml("geoRegion")."\" />\r\n";
			$longitude = $this->yellow->text->get("longitude");
			if (!empty($longitude))$output .= "<meta name=\"geo.position\" content=\"".$this->yellow->text->getHtml("latitude").";".$this->yellow->text->getHtml("longitude")."\" />\r\n";
			$latitude = $this->yellow->text->get("latitude");
			if (!empty($latitude))$output .= "<meta name=\"ICBM\" content=\"".$this->yellow->text->getHtml("latitude").",".$this->yellow->text->getHtml("longitude")."\" />\r\n";	

		}
		return $output;		
	}
}
$yellow->plugins->register("metaseo", "YellowMetaSeo", YellowMetaSeo::VERSION);
?>