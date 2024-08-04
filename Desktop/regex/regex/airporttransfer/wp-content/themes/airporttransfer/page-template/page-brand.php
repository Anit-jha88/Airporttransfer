<?php
/**
 * Template Name: Brand
 
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
      <!-- brans section -->
      <section class="brndSec innerGap">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="brnd_heading">
                     <?php the_content();?>
					</div>
                  <div class="logoRow brandliveclass">
				   <?php
						if( have_rows('adddelete_brand_logo') ):

						
						while( have_rows('adddelete_brand_logo') ) : the_row();

						$brand_logo = get_sub_field('brand_logo');
						
						
						?>
                     <div class="brndBox">
                        <a href="<?php echo get_page_link(15); ?>"><img src="<?php echo $brand_logo['url']?>" alt=""></a>
                     </div>
                          <?php 
						    
						   endwhile;
						   endif;

						   ?>
                  </div>
               </div>
            </div>
         </div>
      </section>
<?php get_footer(); ?>
