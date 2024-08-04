<?php
/**
 * Template Name: Become a Dealer
 
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


      <!-- dealer section -->
      <section class="dealerSec innerGap">
         <div class="container bigContainer">
            <div class="row">
               <div class="col-md-8">
                   <div class="dlrCont mt-0">
                    <?php the_content();?>
					</div>
               </div>
               <div class="col-md-4">
                  <div class="dlrImg">
				    <?php 
					$img =get_field('image');
					?>
                     <img src="<?php echo $img['url']?>" alt="">
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="dlrCont">
                     <?php echo get_field('content');?>
					</div>
               </div>
            </div>
         </div>
      </section>
<?php get_footer(); ?>
