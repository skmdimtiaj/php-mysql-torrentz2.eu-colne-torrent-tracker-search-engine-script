<?php
/*
Developer: Sk Md Imtiaj
Website: https://www.boysofts.com/
Email: info@boysofts.com
*/

/*
  Script version.
*/
$script_version = '1.0';


/* 
   Full url of your site,
   i.e "https://www.example.com/torrents/".
   Including the trailing slash.
   Must not leave blank.
*/
$site_url = "";

 
/* 
   Your (admin) email id. 
   Required to notify you future updates.
   Must not leave blank.
*/
$site_admin_email = '';


/* 
   Site domain name, i.e "TorrentDownloads.Com",
   (optional) to perpend torrent download name.
*/
$site_domain = "mySite.com";


/* 
   Site main color theme. 
   Few sample colors: #fd4045; #3B5998; #25D366; #54A9EB; #BD081C; #E7EAED.
   You can also use random color for testing. 
   See bottom of this file to enable random color. 
*/
$main_theme_color = "#3B5998;";

/*
   Cron frequency: how frequent new torrent will be added.
   Value: in seconds, i.e 3600 seconds is one hour.
*/
$cron_frequency = '2100';

/*
   Default home (index) page title or site name.
*/
$title = "Rocket Torrents";


/*
   Default subtitle append after torrent's name in every pages.
*/
$site_title = "Free Download";


/*
   Default keywords to use in meta keywords tag.
*/
$meta_keywords = 'movies, tv shows, porns, games, software, apps, ebooks, Hd movies';


/*
   Home page meta description tag.
*/
$meta_description = "Download free movies,tv shows, porns, games, software, apps, ebooks, Hd movies torrents."; 


/*
   Contact email to be shown in site footer.
*/
$contact_emails = "info2@boysofts.com";


/*
   Contact address to be shown in site footer.
*/
$contact_address = "New York, United States of America";


/*
   Enable addthis.com social sharing buttons on torrent description pages.
   Replace false to disable social buttons.
   Values: true or false.
*/
$social_buttons = true;
  

/* 
   Site wide ads settings.
   Values: true or false. 
*/
$enable_top_ads =    true;  
$enable_bottom_ads = true;
$enable_left_ads =   false;
$enable_right_ads =  false;



/*Don't touch below this line, if you are not very familiar with php programming*/

//library files
require_once 'lib/functions.php';
//db config
require_once 'db-config.php';


$random_cdn = mt_rand(1, 10); //splitting traffic across 10 cdn.
$base_torrent_download_url = "https://torrentcache$random_cdn.boysofts.com/download/v1/";
$base_api_dump_url = "https://torrentsfeed.boysofts.com/api/v1/dump/";

$year = date("Y");

//$main_theme_color = random_color();
