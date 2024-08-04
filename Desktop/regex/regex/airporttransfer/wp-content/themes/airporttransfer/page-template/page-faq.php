<?php
/**
 * Template Name: FAQ
 
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

         <section class="faqSec innerGap">
            <div class="container">
                <div class="accordion" id="faq">
				 <?php
						if( have_rows('adddelete_faq') ):

						$n=1;
						while( have_rows('adddelete_faq') ) : the_row();

						$question = get_sub_field('question');
						$answer = get_sub_field('answer');
						
						?>
                  <div class="cardRow">
                        <div class="card_header" id="faqhead1">
                           <h4 class="btn_strip show" data-toggle="collapse" data-target="#faq<?php echo $n;?>"
                           aria-expanded="true" aria-controls="faq<?php echo $n;?>">
                           <?php echo $question; ?>
                        </h4>
                        </div>

                        <div id="faq<?php echo $n;?>" class="collapse <?php if($n==1){ echo 'show';}?>" aria-labelledby="faqhead1" data-parent="#faq">
                           <div class="card_body">
                             <p><?php echo $answer; ?></p>
                           </div>
                        </div>
                  </div>
                   
                     
                   
                         <?php 
						   $n++;
						   endwhile;
						   endif;

						   ?>


                    
                 </div>
            </div>
         </section>

                
                      
                 

            
<?php get_footer(); ?>
