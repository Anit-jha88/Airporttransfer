<?php 
//Anit Code goes here

add_action( 'woocommerce_after_add_to_cart_button', 'content_before_addtocart_button' );
function content_before_addtocart_button() {
 $post_id = get_the_ID();
 $terms = array('eo_setting_shape_cat');
 $terms2 =array('eo_diamond_shape_cat');


	if( has_term( $terms, 'product_cat', $post_id ) ){
		$terms = wp_get_object_terms($post_id, 'product_cat', array('parent'=>'32'));
		$redirect_to = 'https://webdev.wordpress-developer.us/bb-designer-jewellers-new/product-category/eo_diamond_shape_cat/';
		echo '<div class="content-section " style="margin-left:2px;"><a href="" data-shape="'.$terms[0]->slug.'"  data-redirect_to="'.$redirect_to.'" data-product_id="'.$post_id.'"   data-product_type="diamond" class="disabled button make_pair">Make Pair</a></div>';
	}elseif(has_term( $terms2, 'product_cat', $post_id )){
		$terms = wp_get_object_terms($post_id, 'product_cat', array('parent'=>'21'));
		$redirect_to ='https://webdev.wordpress-developer.us/bb-designer-jewellers-new/product-category/eo_setting_shape_cat/';
		echo '<div class="content-section" style="margin-left:2px;"><a href=""  data-shape="'.$terms[0]->slug.'" data-redirect_to="'.$redirect_to.'"  data-product_id="'.$post_id.'"  data-product_type="settings" class="disabled make_pair button">Make Pair</a></div>';
	}else{
	}
}

add_action( 'wp_ajax_nopriv_making_pair', 'making_pair' );
add_action( 'wp_ajax_making_pair', 'making_pair' );
function making_pair(){
	if($_POST['making_pair']!='' && $_POST['making_pair']=='making_pair'){
		$selected_shape = $_POST['selected_shape'];
		$redirect_to = $_POST['redirect_to'];
		$product_type = $_POST['product_type'];
		$product_id = $_POST['product_id'];
		$variation_id = $_POST['variation_id'];
		session_start();
		
		if($product_type=='diamond'){
			$_SESSION["diamondpairmaking"]['diamond_shape'] = $selected_shape;
			$_SESSION["diamondpairmaking"]['redirect'] = $redirect_to;
			$_SESSION["diamondpairmaking"]['product_id'] = $product_id;
			$_SESSION["diamondpairmaking"]['variation_id'] = $variation_id;
		}else{
			$_SESSION["settingspairmaking"]['settings_shape'] = $selected_shape;
			$_SESSION["settingspairmaking"]['redirect'] = $redirect_to;
			$_SESSION["settingspairmaking"]['product_id'] = $product_id;
			$_SESSION["settingspairmaking"]['variation_id'] = $variation_id;
		}
		$preview_popup = '';
		if($_SESSION["diamondpairmaking"]['product_id']!='' && $_SESSION["settingspairmaking"]['product_id']){
			$diamondimage = wp_get_attachment_image_src( get_post_thumbnail_id( $_SESSION["diamondpairmaking"]['product_id'] ), 'single-post-thumbnail' );
			$settingimage = wp_get_attachment_image_src( get_post_thumbnail_id( $_SESSION["settingspairmaking"]['product_id'] ), 'single-post-thumbnail' );
			$preview_popup .= '<div class="modal fade" id="pair_preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
			$preview_popup .= '<div class="modal-dialog">';
			$preview_popup .= '<div class="modal-content">';
			$preview_popup .= '<div class="modal-header">';
			$preview_popup .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$preview_popup .= '</div>';
			$preview_popup .= '<div class="modal-body">';
			$preview_popup .= '<div class="row">';
			$preview_popup .= '<div class="col-lg-6">';
			$preview_popup .= '<div class="diamond_whole_wrap shop_box">';
			$preview_popup .= '<div class="img_wrap">';
			$preview_popup .= '<figure>';
    		$preview_popup .= '<img src="'.$diamondimage[0].'">';
			$preview_popup .= '</figure>';
			$preview_popup .= '</div>';
			$preview_popup .= '<div class="diamond_title loop_title_price_wrap">';
			$preview_popup .= '<h2>'.get_the_title($_SESSION["diamondpairmaking"]['product_id']).'</h2>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '<div class="col-lg-6">';
			$preview_popup .= '<div class="settings_whole_wrap shop_box">';
			$preview_popup .= '<div class="img_wrap">';
			$preview_popup .= '<figure>';
    		$preview_popup .= '<img src="'.$settingimage[0].'">';
			$preview_popup .= '</figure>';
			$preview_popup .= '</div>';
			$preview_popup .= '<div class="settings_title loop_title_price_wrap">';
			$preview_popup .= '<h2>'.get_the_title($_SESSION["settingspairmaking"]['product_id']).'</h2>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '<div class="modal-footer">';
			$preview_popup .= '<button type="button" id="add_pair_to_cart" data-variation_id="'.$_SESSION["settingspairmaking"]['variation_id'].','.$_SESSION["diamondpairmaking"]['variation_id'].'" data-ids="'.$_SESSION["settingspairmaking"]['product_id'].','.$_SESSION["diamondpairmaking"]['product_id'].'"  class="btn btn-secondary" >Add To Cart</button>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
			$preview_popup .= '</div>';
		}
		$returnarr["status"] = true;
		$returnarr["diamond_id"] = $_SESSION["diamondpairmaking"]['product_id'];
		$returnarr["settings_id"] = $_SESSION["settingspairmaking"]['product_id'] ;
		$returnarr["pair_html"] = $preview_popup;
		$returnarr["redirect"] 	= $redirect_to;
		$returnarr["product_type"] 	= $product_type;
		$returnarr["session_data"] 	= $_SESSION;
		echo json_encode($returnarr);
		exit();
	}
}
add_action('wp_footer', 'make_pair_function');


function make_pair_function(){
	?>
		<script>
			jQuery(document).ready(function($) {
				$("body").on("click",".make_pair",function(e){
					e.preventDefault();

					if($(this).hasClass("disabled")){
						alert('Please select some product options before make pair with this product.');
						return;
					}
					var selected_shape = $(this).attr("data-shape");
					var redirect_to = $(this).attr("data-redirect_to");
					var product_type = $(this).attr("data-product_type");
					var product_id = $(this).attr("data-product_id");
					var variation_id = $(this).attr("data-variation_id");
					$.ajax({
					type	: "POST",
					url: ajax_params.ajax_url,
					data	: {action: "making_pair",product_type, product_id, variation_id, selected_shape,  redirect_to, making_pair:"making_pair"},				
					success	: function(res){ 
						var result = jQuery.parseJSON(res);
						console.log(result); 
						var fshape = ''; 
						if(result.product_type=='settings'){
							var shape = result.session_data.settingspairmaking.settings_shape;
							
							fshape = shape.replace("diamond", "setting");
							if(result.diamond_id!=null && result.settings_id!=null){

							
								jQuery(result.pair_html).appendTo('#populated_pair');
								$("#pair_preview").modal('show');
							}else{
								window.location.href = result.redirect+'/?shape='+fshape ;
							}
						}else{
							var shape = result.session_data.diamondpairmaking.diamond_shape;
							
							fshape = shape.replace("setting", "diamond");
							if(result.diamond_id!=null && result.settings_id!=null){

								jQuery(result.pair_html).appendTo('#populated_pair');
								$("#pair_preview").modal('show');
							}else{
								window.location.href = result.redirect+'/?shape='+fshape ;
							}
						}

												
					}
					});
				});


				$("body").on("click","#add_pair_to_cart",function(e){
					e.preventDefault();
					var selected_product_ids = $(this).attr("data-ids");
					var selected_variation_id = $(this).attr("data-variation_id");
					$.ajax({
						type	: "POST",
						url: ajax_params.ajax_url,
						data	: {action: "multi_ajax_add_to_cart",selected_product_ids, selected_variation_id, multi_ajax_add_to_cart:"multi_ajax_add_to_cart"},				
						success	: function(res){ 
							var result = jQuery.parseJSON(res);
							window.location.href = result.url ;
						}
					});
				});
				setTimeout(function () {
					var variation_id = $('.variation_id').val(); 
					if( variation_id && variation_id!=0){
						document.getElementsByClassName("make_pair")[0].setAttribute('data-variation_id',variation_id);
						document.getElementsByClassName("make_pair")[0].classList.remove("disabled");
					}else{
						$("body").on("change",".woo-variation-raw-select",function(e){
							e.preventDefault();
							var variation_id = $('.variation_id').val(); 
							if(variation_id){
								document.getElementsByClassName("make_pair")[0].setAttribute('data-variation_id',variation_id);
								document.getElementsByClassName("make_pair")[0].classList.remove("disabled");

							}
						});
					}
				}, 2500);


				/* jQuery("#pair_preview").on("hidden",".bs.modal", function () {
					alert('hide');
				}); */

				jQuery(document).on('hide.bs.modal','#pair_preview', function () {
					$.ajax({
						type	: "POST",
						url: ajax_params.ajax_url,
						data	: {action: "destroy_session", currenturl: "<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"},	
						success	: function(res){ 
							var result = jQuery.parseJSON(res);
							window.location.href = result.url ;
						}			
						
					});
				});




			});
		</script>
	<?php 
}

add_action('wp_ajax_multi_ajax_add_to_cart', 'multi_ajax_add_to_cart');
add_action('wp_ajax_nopriv_multi_ajax_add_to_cart', 'multi_ajax_add_to_cart');
function multi_ajax_add_to_cart() {
    if (isset($_POST['selected_product_ids']) ) {
		$product_ids = explode(',',$_POST['selected_product_ids']);
		$product_selected_variation_ids = explode(',',$_POST['selected_variation_id']);
        $item_keys = array();

		$tmp = array_filter($product_selected_variation_ids);
		if (empty($tmp)) {
			foreach( $product_ids as $item ) {
                $item_keys[] = WC()->cart->add_to_cart($item, 1);
        	}
		}else{
			foreach( $product_selected_variation_ids as $item ) {
                $item_keys[] = WC()->cart->add_to_cart($item, 1);
        	}
		}
		global $woocommerce;
		$cart_url = wc_get_page_permalink( 'cart' );
		$returnarr["status"] = true;
		$returnarr["url"] = $cart_url;
	
		echo json_encode($returnarr);
		exit();



		//return $checkout_url;
    }
}
add_action('wp_ajax_destroy_session', 'destroy_session');
add_action('wp_ajax_nopriv_destroy_session', 'destroy_session');
function destroy_session() {
	$curl = $_POST['currenturl'];
	session_start();
	session_destroy();
	
	$returnarr["status"] = true;
	$returnarr["url"] = $curl;
	
	echo json_encode($returnarr);
	exit();

}


add_filter( 'woocommerce_get_price_html', 'afterprice' ,100, 2);

function afterprice($price){

	 $post_id = get_the_ID();
     $terms = array('eo_diamond_shape_cat');

     if(has_term($terms, 'product_cat', $post_id)){

    $text_to_add_after_price  = ' + Price excludes diamond '; 
		  
	return $price .   $text_to_add_after_price;

}
		  
} 

//Anit Code end here
