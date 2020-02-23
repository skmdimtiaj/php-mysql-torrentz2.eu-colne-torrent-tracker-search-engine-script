<header class="header">
  <a href="<?php echo @$site_url; ?>" class="logo">
    <!--img src="<?php echo @$site_url; ?>templates/logo.png" style="width:25px;height:30px;" class="hvr-pulse-grow" /-->
    &#128640;<i>T</i>orrents<sup style="font-size:15px;color:black;"><i>&#946;</i></sup>
	</a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">    
	<li><a href="<?php echo @$site_url; ?>category/tv.html" class="nav-tv" title="TV Torrents"><span>Tv</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/movies.html" class="nav-movies" title="Movie Torrents"><span>Movies</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/musics.html" class="nav-musics" title="Music Torrents"><br/><span>Musics</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/games.html" class="nav-games" title="Game Torrents"><span>Games</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/xxx.html" class="nav-xxx" title="XXX Torrents"><span>XXX</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/applications.html" class="nav-applications" title="Application Torrents"><span>Apps</span></a></li>
	<li><a href="<?php echo @$site_url; ?>category/others.html" class="nav-others" title="Misc Torrents"><span>Misc</span></a></li>
	<!--li><a href="<?php echo @$site_url; ?>category/animes.html" class="nav-anime" title="Animes" style=""></a></li-->
	
	
    <!--li><a href="#dmca" class="glightbox">DMCA</a></li-->
	<!--li><a href="#privacy" class="glightbox">Privacy</a></li-->
	
	<?php 
 if(!$list_view){
	 ?>
	<li>
	  <form action="<?php echo @$site_url; ?>" method="get">
		<div class="search">
		<input type="text" class="searchTerm" placeholder="Search.." name="q" value="<?php echo @$query; ?>" pattern=".{3,}" required title="3 characters minimum">
		<input type="hidden" value="1" name="search">
		<button type="submit" class="searchButton"></button>
		</div>
	  </form>
	</li> 
 <?php } ?>	
    
  </ul>
</header>
<br/><br/>