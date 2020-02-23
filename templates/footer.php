<!--modal start-->
<div class="inner center">
	<div id="open-modal" class="modal-window">
	  <div>
		<a href="#modal-close" title="Close" class="modal-close topX" id="modal-close">X</a>
		<h1 id="modal_title" style="text-transform: capitalize;">Modal Title</h1>
		<div id="modal_body">Loading...</div>
		<div class="modal_btn_container"><a href="#modal-close" class="modal-close modal_btn" id="modal-close">Close</a></div>
		</div>
	</div>
</div>
<script>
function open_modal(elm) {
  document.getElementById("modal_title").innerHTML = elm + ':';
  
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     response = this.responseText;	 
	 document.getElementById("modal_body").innerHTML = response;
    }
  };
  xhttp.open("GET", "<?php echo $site_url; ?>texts/" + elm + ".txt", true);
  xhttp.send();
}
</script>
<!--modal end-->

<!--scroll to top -->
<button onclick="topFunction()" id="scrollToTop" title="Go to top">&#128743;</button>
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("scrollToTop").style.display = "block";
  } else {
    document.getElementById("scrollToTop").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
<!--scroll to top end -->

<footer class="footer">
  <div class="footer__addr">
    <h1 class="footer__logo"><?php echo ucwords ($site_title); ?></h1>
        
    <h2><b>Contact: <?php echo $contact_emails; ?></b></h2>
    
    <address>
      <?php echo $contact_address; ?><br>
          
      <a class="footer__btn" href="mailto:<?php echo $contact_emails; ?>">&#128231; Email Us</a>
    </address>
  </div>
  
  <ul class="footer__nav">
    <li class="nav__item">
      <h2 class="nav__title">Main</h2>

      <ul class="nav__ul">
        <li>
          <a href="<?php echo @$site_url; ?>">&#127968; Home</a>
        </li>

        <li>
          <a href="#" onclick="window.print();">&#9113; Print</a>
        </li>
            
        <li>
          <a href='<?php echo @$site_url; ?>?rss=<?php echo @$cat; ?>'>&#128225; Rss <?php echo strtoupper(@$cat); ?></a>
        </li>
      </ul>
    </li>
    
    <!--li class="nav__item nav__item--extra">
      <h2 class="nav__title">Technology</h2>
      
      <ul class="nav__ul nav__ul--extra">
        <li>
          <a href="#">Hardware Design</a>
        </li>
        
        <li>
          <a href="#">Software Design</a>
        </li>
        
        <li>
          <a href="#">Digital Signage</a>
        </li>
        
        
      </ul>
    </li-->
	
	<li class="nav__item">
      <h2 class="nav__title">Information</h2>
      
      <ul class="nav__ul">
        <li>
          <a href="#open-modal" onclick="open_modal('terms');">&#128462; Terms & Conditions</a>
        </li>
        
        <li>
          <a href="#open-modal" onclick="open_modal('privacy');">&#128462; Privacy Policy</a>
        </li>
        
        <li>
          <a href="#open-modal" onclick="open_modal('dmca');">&#128462; DMCA</a>
        </li>
		
		<li>
          <a href="#open-modal" onclick="open_modal('2257');">&#128462; 2257 Statement</a>
        </li>
      </ul>
    </li>
	
	<li class="nav__item">
      <h2 class="nav__title">&#129309; Partners</h2>
      
      <ul class="nav__ul">
        
        <li>
          <a href="https://www.thepiratebay.org" target="_blank">thepiratebay.org</a>
        </li>
        
        <li>
          <a href="https://1337x.to/" target="_blank">1337x</a>
        </li>
		
		<li>
          <a href="https://torrentz2.eu/" target="_blank">torrentz2.eu</a>
        </li>
		
		<li>
          <a href="http://yts.am/" target="_blank">yts.am</a>
        </li>
      </ul>
    </li>
    
    <li class="nav__item">
      <h2 class="nav__title">Support</h2>
      
      <ul class="nav__ul">
        <li>
          <a href="#open-modal" onclick="open_modal('contact');">&phone; Contact Us</a>
        </li>
		
		<li>
          <a href="#open-modal" onclick="open_modal('about');">&#128462; About</a>
        </li>
        
        <li>
          <a href="#open-modal" onclick="open_modal('feed back');">&#128231; Give Feedback</a>
        </li>
        
      </ul>
    </li>
  </ul>
  
  
  <div class="legal">
    <p>&copy; <script>document.write(new Date().getFullYear());</script>
	<!-- Hy buddy don't delete this link, your site will stop getting torrents-->
	by <a href="https://www.boysofts.com/" target="_blank">Boysofts.com</a>. 
	<?php 
	echo "Ver:$script_version. ";
	 /*Create a variable for end time and Subtract the two times to get seconds*/
     $time_end = microtime(true);
     $execution_time = $time_end - $time_start;
	 $precision = 2;
	 $execution_time_precise = number_format((float) $execution_time, $precision, '.', ''); 
     echo '&#128336; '.$execution_time_precise.' sec.';
	 
	 //total number of files in db.
	 echo " $total_rows torrents "; 
	 //echo (isset($cat)) ? ucfirst($cat) : 'db';
	 //echo (isset($cat)) ? 'in ' . ucfirst($cat) : (isset($query)) ? "for search\: \"$query\"" : 'in db'; //not working
	 
	 if(isset($query)){ echo "for search: \"$query\""; }
	 elseif (isset($cat)) { echo 'in <b>' . ucfirst($cat) . '</b>'; }
	 else { echo 'in db'; }
	 ?>. </p>
    
    <div class="legal__links">
      <span>Made with <span class="heart">&#9829;</span> on planet earth.</span><br/>
    </div>
  </div>
</footer>

<?php if (@$social_buttons) { echo '<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5df22b16ea90d6b3"></script>'; } ?>

<?php echo @$analytics_code; ?>

<?php 
  $corn_time_diff = @(time()-filemtime("corn"));
  if($corn_time_diff >=$cron_frequency ){
	  $is_bot = smart_ip_detect_crawler();
	  if($is_bot) {
		  include("cron.php");
	  }
	  else{
	    echo "<script src=\"" . $site_url . "cron.php\"></script>";
	  }
  }
  ?>
  
 </body>
</html>
