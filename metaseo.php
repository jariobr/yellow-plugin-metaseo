<?php
// This file may be used and distributed under the terms of the public license.

/*
Write in config.ini file these lines. The value void not appear in template.

Metamsn: bing webmaster verify
Metagoogle: google webmaster verify
Metayandex: yandex webmaster verify
Facebook: joe 
facebookId: 222222222222 <-- facebook app code
Googleplus: 111111111111 <-- google plus number 

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
			$msnId = $this->yellow->config->get("metaMsn");
			if (!empty($msnId)) $output .= "<meta name=\"msvalidate.01\" content=\"".strencode($msnId)."\" />\n";
			$googId = $this->yellow->config->get("metaGoogle");
			if (!empty($googId))$output .= "<meta name=\"google-site-verification\" content=\"".strencode($googId)."\" />\n";
			$yanId = $this->yellow->config->get("metaYandex");
			if (!empty($yanId))$output .= "<meta name=\"yandex-verification\" content=\"".strencode($yanId)."\" />\n";
			$fbId = $this->yellow->config->get("facebookId");
			if (!empty($fbId))$output .= "<meta property=\"fb:app_id\" content=\"".strencode($fbId)."\" />\n";
			$fbadminId = $this->yellow->config->get("facebook");
			if (!empty($fbadminId)) $output .= "<meta property=\"fb:admins\" content=\"".strencode($fbadminId)."\" />\n";			
			$gplusId = $this->yellow->config->get("googlePlus");
			if (!empty($gplusId))$output .= "<link rel=\"publisher\" href=\"https://plus.google.com/".strencode($gplusId)."\" />\n";

			$output .= "\n\r<!-- ogp card -->\n<meta name=\"twitter:card\" content=\"summary\" />\r\n";
			$ttId = $this->yellow->config->get("twitter");
			if (!empty($ttId))$output .= "<meta name=\"twitter:creator\" content=\"@".strencode($ttId)."\" />\r\n";
			$output .= "<meta property=\"og:site_name\" content=\"".$this->yellow->page->getHtml("sitename")."\" />\r\n";
			$output .= "<meta property=\"article:tag\" content=\"".$this->yellow->page->get("tag")."\" />\r\n";			
			$output .= "<meta property=\"og:url\" content=\"".$this->yellow->page->getUrl()."\"/>\r\n";
			$output .= "<meta property=\"og:title\" content=\"".$this->yellow->page->getHtml("title")."\"/>\r\n";
			$output .= "<meta property=\"og:description\" content=\"".$this->yellow->page->getHtml("description")."\" />\r\n";
			if (!empty("image")) $output .= "<meta property=\"og:image\" content=\"".$this->yellow->page->getHtml("image")."\" />\r\n";		

		}
		return $output;		
	}
}
$yellow->plugins->register("metaseo", "YellowMetaSeo", YellowMetaSeo::VERSION);
?>