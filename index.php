<?php
/*
Developer: Sk Md Imtiaj
Website: https://www.boysofts.com/
Email: info@boysofts.com
*/

//$_SERVER['HTTP_USER_AGENT'] = "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)"; //for test

/*set all errors display on localhost and off while in production server*/
if( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}else{
	error_reporting(0);
}
	  
require('settings.php');

$current_timestamp = DB::queryFirstRow('SELECT CURRENT_TIMESTAMP');
$current_timestamp = $current_timestamp['CURRENT_TIMESTAMP'];


/*Create a variable for start time*/
$time_start = microtime(true);

$all_categories = array('animes', 'movies', 'musics', 'tv', 'games', 'xxx', 'applications', 'others');

/*main code block*/

if (!filter_var($site_admin_email, FILTER_VALIDATE_EMAIL)) {
  die("Please enter your contact email id in  <b>\"site_admin_email\"</b> variable, line number 4, in <b>\"settings.php\"</b> file.<br/> We will use it to contact you for future updates.  ");
}

/*get analytics code*/
$analytics_code = get_include_contents("ads/analytics_code.php");

/*get all ads*/
if($enable_top_ads) { $top_ad = get_include_contents("ads/top_ad.php"); }
if($enable_bottom_ads) { $bottom_ad = get_include_contents("ads/buttom_ad.php"); }
if($enable_left_ads) { $side_bar_ad_left = get_include_contents("ads/side_bar_ad_left.php"); }
if($enable_right_ads) { $side_bar_ad_right = get_include_contents("ads/side_bar_ad_right.php"); }


/*rss view*/
$rss = @$_GET['rss'];
if( isset($rss) && ctype_alpha($rss) ) {
  $cat = $rss;
  
  if (!in_array($cat, $all_categories)) {
	  $torrents_data = DB::query("SELECT * FROM torrents  ORDER BY timestamp DESC LIMIT 10");
  }
  else{
	  $torrents_data = DB::query("SELECT * FROM torrents  WHERE category=%s ORDER BY timestamp DESC LIMIT 10", $cat);
  }
  header('Content-Type: application/rss+xml; charset=utf-8');	
  require('templates/rss.php');
  exit;
}
/*rss view end*/

$list_view = true;

$file_id = @$_GET['file_id'];
if(isset($file_id) && ctype_alnum($file_id) ) { 
  $list_view = false;
  $file_info = DB::queryFirstRow("SELECT * FROM torrents WHERE file_id=%s", $file_id);
 
  $file_title = $file_info['title'];
  $file_title2 = $file_info['title2'];
   
  
  $file_id = $file_info['file_id'];
  $file_hash_id = $file_info['hash_id'];
  $file_size = $file_info['size'];
  $file_category = $cat = $file_info['category'];
  $file_added_time = $file_info['timestamp'];
  $file_age = urlencode(get_age($current_timestamp, @$file_added_time));
  $file_title_encoded = urlencode($file_title);
  $download_link = "$base_torrent_download_url?file_id=$file_id&hash_id=$file_hash_id&title=$file_title_encoded&category=$file_category&size=$file_size&age=$file_age&site_domain=$site_domain&site_url=$site_url";
  //$download_link = "http://localhost:8080/download/v1/?file_id=$file_id&hash_id=$file_hash_id&title=$file_title_encoded&category=$file_category&size=$file_size&age=$file_age&site_domain=$site_domain&site_url=$site_url";
  
  $download_link = strrev (base64_encode($download_link) ); //encoding download link, because i don't want unwanted crawling.
  
  $total_rows = DB::queryFirstField("SELECT COUNT(*) FROM torrents WHERE category=%s", $cat);
  
  $meta_description = $title = "Download $file_title2 torrent- $file_category | $file_size";
  
  $meta_keywords = implode(', ', explode(' ', $file_title)) . ', ' . $meta_keywords;
  
  $file_title_slug = $file_info['slug'];
  $canonical_url = $site_url . "torrent/" . $file_title_slug;
  $recent_torrents = DB::query("SELECT * FROM torrents  WHERE category=%s ORDER BY timestamp DESC LIMIT 10", $file_category);
  
  $description_keywords = "";
  $primary_key_id = $file_info['id'];
  $offset_next = $primary_key_id - 20;
  $offset_next = abs($offset_next);
  $few_keywords = DB::query("SELECT * FROM torrents  LIMIT 20 OFFSET $offset_next");
  $few_keywords = array_reverse($few_keywords);
  foreach ($few_keywords as $desc_row) {
	  $description_keywords = $description_keywords . ' ' . $desc_row['title'];
    }

  }
  
  
//home page or list pages, such as category or search pages.
//get recent torrents
if($list_view){
//pagination
if (isset($_GET['page']) && ctype_digit($_GET['page']) ) {
    $pageno = $_GET['page'];
} else {
    $pageno = 1;
}

//pagination arguments
$saerch_arg = '';
$cat_arg = '';
//search
if (isset($_GET['search'])) {
    $search_view = true;
	$query = $_GET['q'];
	$saerch_arg = "&q=$query&search=1";
}

if (isset($_GET['cat'])) {
    $cat_view = true;
	$cat = $_GET['cat'];
	$cat_arg = "&cat=$cat";
	
	if (!in_array($cat, $all_categories)) {
	  //cat not in array, redirect to home.
      header("Location: $site_url"); 
	  exit;
    }
}


$no_of_records_per_page = 25;
$offset = ($pageno-1) * $no_of_records_per_page; 

if(@$search_view){
	//$results = DB::query("SELECT * FROM torrents  WHERE  (title LIKE  '%$query$') OR (tags LIKE '%$query%') ORDER BY timestamp DESC LIMIT $search_count OFFSET $offset");
	$total_rows = DB::queryFirstField("SELECT COUNT(*) FROM torrents WHERE `title` LIKE '%" .$query. "%'");
    if($total_rows > 0 ){
	   $torrents_data = DB::query("SELECT * FROM torrents WHERE `title` LIKE '%" .$query. "%' ORDER BY timestamp DESC LIMIT $offset, $no_of_records_per_page");
       $title = "Search \"$query\" - Page $pageno";
	   
    }
	
	if($total_rows == 0 ){
		$title = "No Torrents found for: $query.";
		$no_search_results = true;
		//no torrent found, showing recent torrents.
		$total_rows = DB::queryFirstField("SELECT COUNT(*) FROM torrents");
		$torrents_data = DB::query("SELECT * FROM torrents  ORDER BY timestamp DESC LIMIT $offset, $no_of_records_per_page");
	}
	
	}
elseif (@$cat_view){
	$total_rows = DB::queryFirstField("SELECT COUNT(*) FROM torrents WHERE category=%s", $cat);
	$torrents_data = DB::query("SELECT * FROM torrents  WHERE category=%s ORDER BY timestamp DESC LIMIT $offset, $no_of_records_per_page", $cat);
	$title = "Latest " . ucfirst($cat) . " Torrents - Page $pageno";
}
else{
  $total_rows = DB::queryFirstField("SELECT COUNT(*) FROM torrents");
  $torrents_data = DB::query("SELECT * FROM torrents  ORDER BY timestamp DESC LIMIT $offset, $no_of_records_per_page");
  //$torrents_data = DB::query("SELECT * FROM torrents LIMIT $offset, $no_of_records_per_page");
  if( $pageno > 1 ){
  $title = $title . " - Page $pageno";
  }
}

$total_pages = ceil($total_rows / $no_of_records_per_page);

/*pagination start*/
$pagination = '';
//taken from https://www.geeksforgeeks.org/php-pagination-set-3/

// K is assumed to be the middle index. 
$k = (($pageno+4>$total_pages)?$total_pages-4:(($pageno-4<1)?5:$pageno));  

// Show prev and first-page links. 
if($pageno>=2){ 
  $pagination = $pagination . "<a href='index.php?page=1$saerch_arg$cat_arg' class='page'> << </a>"; 
  $pagination = $pagination . "<a href='index.php?page=".($pageno-1)."$saerch_arg$cat_arg' class='page'> < </a>"; 
} 

// Show sequential links. 
for ($i=-4; $i<=4; $i++) { 
  if($k+$i==$pageno) {
    //$pagination = $pagination . "<a href='index.php?page=".($k+$i)."'><span class='page active'>".($k+$i)."</span></a>"; 
	//if only one page, then remove active index
	if( !($total_pages == 1) ){
       $pagination = $pagination . "<span class='page active'>".($k+$i)."</span>";
	}
  }
  else{
	//removing negative indices's
	if( !(($k+$i) <= 0)  ){
	  //removing index that is grater than total_pages
	  if( (($k+$i) <= $total_pages) ){
         $pagination = $pagination . "<a href='index.php?page=".($k+$i)."$saerch_arg$cat_arg' class='page'>".($k+$i)."</a>";
	  }
	}
  }	
};   

// Show next and last-page links. 
if($pageno<$total_pages){ 
  $pagination = $pagination . "<a href='index.php?page=".($pageno+1)."$saerch_arg$cat_arg' class='page'> > </a>"; 
  $pagination = $pagination . "<a href='index.php?page=".$total_pages."$saerch_arg$cat_arg' class='page'> >> </a>"; 
} 


/*pagination end*/

//die(print_r($total_pages));
}

require('templates/main_template.php');
/*main code block ends*/

ob_end_flush();