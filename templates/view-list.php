<div id="main">      
    
	<br/>
	<?php if(@$no_search_results){ echo "<div class=\"inner center\"><span class=\"not-found\">No Torrents Found for: \"$query\".</span></div>";} ?>

<?php 
 if($list_view){
	$placeholder = 'Search...';
	if( $total_rows >= 10000) {
	 if(isset($query)){ $placeholder = "Search total $total_rows torrents for: '$query'."; }
	 elseif (isset($cat)) { $placeholder = "Search total $total_rows torrents in " . ucfirst($cat) . ' category.'; }
	 else { $placeholder =  "Search total $total_rows torrents in database."; }
	}
	 
	 ?>
  <div class="inner center">  
      <form action="<?php echo @$site_url; ?>" method="get" class="card table-caption" style="width:750px;padding:10px;margin-bottom:15px;">
		<div class="search">
		<input type="text" class="searchTerm" placeholder="<?php echo $placeholder; ?>" name="q" value="<?php echo @$query; ?>" style="height:25px;" pattern=".{3,}" required title="3 characters minimum">
		<input type="hidden" value="1" name="search">
		<button type="submit" class="searchButton" style="height:41px;width:70px;"></button>
		</div>
	  </form> 
  </div>
 <?php } ?>
 
  <div class="inner center">  
    <table class="rtable">
	  <caption class="table-caption">Latest <?php echo @$cat; ?> Torrents <?php if(isset($query) && !@$no_search_results) {echo "for: \"$query\" [$total_rows Results]";} ?> <?php if($pageno> 1) { echo " - Page $pageno"; } ?></caption>
	  <thead>
		<tr>
		  <th>File Name</th>		  
		  <th>Size</td>
		  <th>Category</th>
		  <th>Age</th>
		</tr>
	  </thead>
		  <tbody>
	<?php foreach ($torrents_data as $row) { ?>
		<tr>
		  <td><a href="<?php echo @$site_url; ?>torrent/<?php echo $row['slug2']; ?>"><?php echo $row['title']; ?></a></td>
		  <td><?php echo $row['size']; ?></td>
		  <td><a href="<?php echo @$site_url; ?>category/<?php echo $row['category']; ?>.html"><?php echo ucfirst($row['category']); ?></a></td>
		  <td><?php echo get_age($current_timestamp, $row['timestamp']); ?></td>
		</tr>
	<?php } ?>	
	  </tbody>
	</table>

  </div>
  <br/>
  
  <div class="inner center">
      <div id="container">
		<div class="pagination">			
			
			<?php echo $pagination; ?>
			
		</div>
	  </div>
  </div>
              
</div>
