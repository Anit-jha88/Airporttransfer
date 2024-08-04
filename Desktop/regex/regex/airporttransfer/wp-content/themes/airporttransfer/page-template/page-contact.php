<?php
/**
 * Template Name: Contact
 
 */

get_header();

if( !empty(get_the_post_thumbnail_url( get_the_ID(),'full')) ):
	$bannerImage = get_the_post_thumbnail_url( get_the_ID(),'full');
else:
	$bannerImage = get_template_directory_uri().'/images/dealerBannerImg.png';
endif;
 
?>

<section class="bannerSec innerBanner">
         <div class="bannerImg">
            <img src="<?php echo $bannerImage;?>" alt="">               
         </div>
         <div class="bannerCont">
            <div class="container bigContainer">
               <div class="content">
                  <h1><?php the_title();?></h1>   
               </div>
            </div>
         </div>
      </section>
   
      <!-- contact section -->

      <section class="contactSec innerGap">
         <div class="container">
            <div class="adsSec">
               <div class="row">
                  <div class="col-lg-4 col-sm-6">
                     <div class="contBox">
                        <div class="icon">
                           <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="txt">
                           <p>
                              Address
                              <span class="atag"><?php echo get_field('address')?></span>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                     <div class="contBox">
                        <div class="icon">
                           <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="txt">
                           <p>
                              Phone Number
                              <a href="tel:<?php echo get_field('phone_number')?>" class="atag num"><?php echo get_field('phone_number')?></a>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                     <div class="contBox">
                        <div class="icon">
                           <i class="fas fa-envelope"></i>
                        </div>
                        <div class="txt">
                           <p>
                              Email Address
                              <a href="mailto:<?php echo get_field('email_address')?>" class="atag"><?php echo get_field('email_address')?></a>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="frmBox">
               <h3>Send Us a Note</h3>
               <?php echo do_shortcode('[contact-form-7 id="5" title="Contact"]');?>
            </div>

         </div>
      </section>
<?php get_footer(); ?>
