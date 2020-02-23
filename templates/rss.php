<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
  <title><?php echo $site_title; ?></title>
  <link><?php echo $site_url; ?></link>
  <description><?php echo $title; ?> <?php echo $site_title; ?></description>
  <?php foreach ($torrents_data as $row) { 
     $item_link = $site_url . "torrent/" . $row['slug'];
	 $title = $row['title'];
	 $cat = $row['category'];
	 $size = $row['size'];
	 $file_id = $row['file_id'];
	 $description = "Download " . $title . " - $cat | $size";
  ?>
  <item>
    <title><?php echo $title; ?></title>
    <link><?php echo htmlentities($item_link); ?></link>
    <description><?php echo $description; ?></description>
	<category><?php echo $cat; ?></category>
	<guid isPermaLink="false"><?php echo htmlentities($file_id); ?></guid>
	<pubDate><?php echo date("D, d M Y H:i:s +0000"); ?></pubDate>
  </item>
  <?php } ?>
</channel>

</rss>