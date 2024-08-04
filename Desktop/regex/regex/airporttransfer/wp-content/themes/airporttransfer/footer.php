 <!-- footer back -->
    <footer class="footerSec">
      <div class="ftrImg">
        <img src="<?php //echo get_field('footer_background_image','option');?>" alt="">
      </div>
      <div class="container">
        <div class="logoBox">
          <img src="<?php //echo get_field('footer_logo','option');?>" alt="">
        </div>
        
         <!--  <div class="form_group">
            <input type="text" placeholder="email address">
            <input type="submit" class="btn" value="Shop Now">
          </div> -->
          <div class="socialIcons">
            <a href="<?php //echo get_field('facebook_link','option');?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <!--<a href="<?php //echo get_field('youtube_link','option');?>" target="_blank"> <i class="fab fa-youtube"></i> </a>
            <a href="<?php //echo get_field('instragram_link','option');?>" target="_blank"><i class="fab fa-instagram"></i></a>-->
          </div>
          <div class="btmTxt">
            <p><?php //echo get_field('copyright_text','option');?></p>
            <?php //wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'quickLink', 'container' => 'ul')); ?>
            <!-- <ul class="quickLink">
              <li><a href="#">Home</a></li>
              <li><a href="#">CUSTOM</a></li>
              <li><a href="#">BRANDS</a></li>
              <li><a href="#">product</a></li>
              <li><a href="#"> BECOME A DEALER </a></li>
            </ul> -->
          </div>
        </form>
      </div>
    </footer>
 

<?php
	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>


</html>
