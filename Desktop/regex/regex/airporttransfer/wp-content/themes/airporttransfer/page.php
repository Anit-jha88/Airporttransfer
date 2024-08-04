<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 

?>

	
  <?php
	while ( have_posts() ) : the_post();
	$image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); 
	if($image!=''){
		$image=$image[0];
	}else{
	$image=get_stylesheet_directory_uri().'/images/bannerImg.jpg';	
	}
	?>
	<section class="bannerSec innerBanner">
         <div class="bannerImg">
           <img src="<?php echo $image; ?>" alt="">              
         </div>
         <div class="bannerCont">
            <div class="container bigContainer">
               <div class="content">
               <h1><?php the_title();?></h1>  
             	   
               </div>
            </div>
         </div>
      </section>
	   <div class="alldefoultpagess">
	   <div class="container">
          <?php the_content();?>
	   </div>
	  </div>
   
    <?php endwhile; ?> 
    
  
<?php get_footer(); ?>
