<div id="main">
   <script>
   document.title =  '<?php echo "Download " . addslashes(@$file_title); ?>';
   window.history.pushState("object or string", "slug", "<?php echo @$site_url . 'torrent/' . $file_title_slug; ?>");
   </script>
   <div class="inner center">
     <?php if(@$enable_top_ads) { echo $top_ad; } ?>
	 
   </div>
   
   <?php if(@$enable_left_ads) { echo "<div  class=\"left-ad\">$side_bar_ad_left</div>"; } ?>
   <?php if(@$enable_right_ads) { echo "<div class=\"right-ad\">$side_bar_ad_right</div>"; } ?>

  <br/>
  <div class="inner center">
  
    <div id="detailsouterframe">
	<div id="response"></div>
	<div id="message"></div>
	<div id="detailsframe">
	<div id="title">
		Download <?php echo @$file_title; ?>
	</div>

    <div id="details">
        <dl class="col1"><dt>Category:</dt>
            <dd><a href="<?php echo @$site_url; ?>category/<?php echo @$file_category; ?>.html" title="More from this category: <?php echo @$file_category; ?>"><?php echo ucfirst(@$file_category); ?></a></dd>
        <!--will be added soon-->
        <!--dt>Tags:</dt>
        <dd>{{tags_links}}</dd-->

		<dt>Size:</dt>
		<dd><?php echo @$file_size; ?></dd>

		<!--dt>Language(s):</dt>
		<dd>English</dd-->        
                
        </dl>
		
		<dl class="col2"><dt>Added on:</dt>
            <dd><?php echo @$file_added_time . ' ' . urldecode(@$file_age) . ' ago.'; ?></dd>
			
			<!--will be added soon-->
            <!--dt>Shared By:</dt>
            <dd>{{file_owner}}</dd-->
            
        </dl>
		
		<div id="CommentDiv" style="display:none;">
        
        </div>
		
       <br><br>
	   <div id="social">
	   <?php /*if (@$social_buttons) { require("templates/social_buttons.php"); }*/ ?>
	   <?php if (@$social_buttons) { echo '<div style="float:right;"><div class="addthis_inline_share_toolbox"></div></div><br/><br/>'; } ?>
       </div>
       
	   <br/><br/>
	   <div>
	   
			<div class="download center" >  		          
				<a href="" class="buttonDownload" rel="nofollow" target="_blank" id="dl_link">Download Torrent</a>
				<script>
				function reverse_str(str) { return str.split("").reverse().join(""); }
				function base64_decode(str){ return atob(str); }
				document.getElementById('dl_link').href= base64_decode(reverse_str("<?php echo @$download_link; ?>"));
				</script>
			</div>
		
		
		<!--will be added soon-->
        <!--div class="nfo">
            <pre>{{file_description}}</pre>
        </div-->
		
		<div class="description">
            <pre><?php echo $description_keywords; ?></pre>
        </div>
		
        <br>
            <div id="comments"></div>            
            <div class="center"><?php if(@$enable_bottom_ads) { echo $bottom_ad; } ?></div>            
                       
		 </div>
        </div>
    </div>
	
    </div>	
	
  </div>
    
	<br/>
	
	<div class="inner center">
    <table class="rtable">
		  <caption class="table-caption">More Latest <?php echo @$cat; ?> Torrents</caption>
	  <thead>
		<tr>
		  <th>File Name</th>		  
		  <th>Size</td>
		  <th>Category</th>
		  <th>Age</th>
		</tr>
	  </thead>
		  <tbody>
	<?php foreach ($recent_torrents as $row) { ?>
		<tr>
		  <td><a href="<?php echo @$site_url; ?>torrent/<?php echo $row['slug2']; ?>" class="l"><?php echo $row['title']; ?></a></td>
		  <td><?php echo $row['size']; ?></td>
		  <td><a href="<?php echo @$site_url; ?>category/<?php echo $row['category']; ?>.html"><?php echo ucfirst($row['category']); ?></a></td>
		  <td><?php echo get_age($current_timestamp, $row['timestamp']); ?></td>
		</tr>
	<?php } ?>	
	  </tbody>
	  <tfoot>
		<tr>
		  <td></td>
		  <td>		   
		  </td>
		  <td>
		  </td>
		  <td >
		   <a href="<?php echo @$site_url; ?>category/<?php echo @$cat; ?>.html" style="color: var(--main-theme-color);font-weight: bold;">More &#129094;</a>
		  </td>
		</tr>
	  </tfoot>
	</table>
	<script>
	var elements = document.getElementsByClassName("l");
	for(var i=0; i<elements.length; i++) {
		elements[i].setAttribute('onclick','window.location.href="'+ elements[i].getAttribute('href') +'"');
		elements[i].setAttribute('href','javascript:void(0);');
	}
	</script>

  </div>
  
  <div class="inner center">
    <!--h1 class="nav__title" >
	  More <a href="<?php echo @$site_url; ?>?cat=<?php echo @$cat; ?>" style="text-decoration:none;"><?php echo @$cat; ?></a> Torrents.
	</h1-->
  </div>
	
  
	  
</div>
