<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


function qs_booking() {
	ob_start();
	?>
	<div class="popup-col b-popup-right">
            <h4>Choose your vehicle</h4>
            
            <div class="car-box-scroll">
                <?php 
                $n=1;
                $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) : $loop->the_post();

                    $postid=get_the_ID();

               

                $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');   
           
               



                  
                ?>
                <div class="car-box-outer">
                    <div class="car-left-col">
                        <figure><img src="<?php echo  $image[0];?>" alt=""></figure>
                        <p><?php echo get_the_content();?></p>
                        <!--<p><b>Please note: Minimum fare is 50 euro.</b></p>-->
                    </div>
                    <div class="car-right-col">
                        <div class="car-price">
                            <p><b><?php echo get_the_title();?></b></p>
                            <p>Best price:<span id="car<?php echo $n;?>"> EUR 145.75</span></p>
                        </div>
                        <div class="car-option">
                            <div class="icon">
                                <img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2023/03/user.png" alt="">
                                <span><?php echo get_post_meta( $postid, 'Peaple', true );?></span>
                            </div>
                            <div class="icon">
                                <img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2023/03/briefcase.png" alt="">
                                <span><?php echo get_post_meta( $postid, 'Briefcase', true );?></span>
                            </div>
                        </div>
                        <a href="javascript:void(0);" value="" id="bokingcar<?php echo $n;?>" class="elementor-button" onclick=calculateprice(this.value,<?php echo $postid;?>)>Choose & Continue</a>
                    </div>
                </div>
               <?php  $n++; endwhile; } wp_reset_query();?>
                
                
            </div>
        </div>
	<?php
	return ob_get_clean();
}
add_shortcode('display_booking','qs_booking');




add_action( 'woocommerce_before_calculate_totals', 'custom_cart_item_price', 30, 1 );
function custom_cart_item_price( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach ( $cart->get_cart() as $cart_item ) {
        if( isset($cart_item['custom_data']['new_price']) )
            $cart_item['data']->set_price( $cart_item['custom_data']['new_price'] );
    
    }
}



// Display custom cart item meta data (in cart and checkout)
add_filter( 'woocommerce_get_item_data', 'display_cart_item_custom_meta_data', 10, 2 );
function display_cart_item_custom_meta_data( $item_data, $cart_item ) {

 


   //( [Pickuplocation] => DSM Delft, Alexander Fleminglaan, Delft, Netherlands [Destination] => Duisenberg school of finance, Gustav Mahlerplein, Amsterdam, Netherlands [Pickupdate] => 2023-03-29 [Pickuptime] => 16:35 [new_price] => 217.12 )

    $meta_key = 'Pickup location';
    if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }
   $meta_key = 'Drop-off location';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }

    $meta_key = 'Pickup date';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }

      $meta_key = 'Pickup time';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }

    $meta_key = 'Return transfer';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }

     $meta_key = 'Return date';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }

     $meta_key = 'Return time';
   if ( isset($cart_item['custom_data']) && isset($cart_item['custom_data'][$meta_key]) ) {
        $item_data[] = array(
            'key'       => $meta_key,
            'value'     => $cart_item['custom_data'][$meta_key],
        );
    }




    return $item_data;
}

// Save cart item custom meta as order item meta data and display it everywhere on orders and email notifications.
add_action( 'woocommerce_checkout_create_order_line_item', 'save_cart_item_custom_meta_as_order_item_meta', 10, 4 );
function save_cart_item_custom_meta_as_order_item_meta( $item, $cart_item_key, $values, $order ) {
    $meta_key = 'Pickup location';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

    $meta_key = 'Drop-off location';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

     $meta_key = 'Pickup date';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

     $meta_key = 'Pickup time';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

     $meta_key = 'Return transfer';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

     $meta_key = 'Return date';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }

     $meta_key = 'Return time';
    if ( isset($values['custom_data']) && isset($values['custom_data'][$meta_key]) ) {
        $item->update_meta_data( $meta_key, $values['custom_data'][$meta_key] );
    }
}


add_filter( 'woocommerce_cart_item_quantity', 'wc_cart_item_quantity', 10, 3 );
function wc_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
    if( is_cart() ){
        $product_quantity = sprintf( '%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity'] );
    }
    return $product_quantity;
}



add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );

function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {

        switch ( $translated_text ) {

            case 'Return to shop' :

                $translated_text = __( 'Return to Home', 'woocommerce' );
                break;

        }

    return $translated_text;
}




function custom_empty_cart_redirect_url(){

return get_page_link(12);

}






add_filter( 'woocommerce_return_to_shop_redirect', 'custom_empty_cart_redirect_url' );


function custom_wc_translations($translated){
    $text = array(
    'Your order' => 'Booking Summary',
    'any other string' => 'New string',
    );
    $translated = str_ireplace(  array_keys($text),  $text,  $translated );
    return $translated;
}

add_filter( 'gettext', 'custom_wc_translations', 20 );



function th_wc_order_review_strings( $translated_text, $text, $domain ) {

  if(is_checkout()){
    switch ($translated_text) {
     
    
     case 'Your order':
        $translated_text = __('My Order', 'woocommerce');
        break;
     case 'Product':
        $translated_text = __('Your Transfer Details', 'woocommerce');
        break;
    }
  }
  return $translated_text;
}
add_filter( 'gettext', 'th_wc_order_review_strings', 20, 3 );


add_action( 'after_setup_theme', 'setup_woocommerce_support' );

 function setup_woocommerce_support()
{
  add_theme_support('woocommerce');
}

//add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );



add_filter( 'woocommerce_add_cart_item_data', '_empty_cart' );

    function _empty_cart( $cart_item_data ) {

        WC()->cart->empty_cart();

        return $cart_item_data;
    }





function md_custom_woocommerce_checkout_fields( $fields ) 
{
    $fields['order']['order_comments']['placeholder'] = 'Special notes';
    $fields['order']['order_comments']['label'] = 'Note to the driver';

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'md_custom_woocommerce_checkout_fields' );



add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field( 'my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Flight or Train Number'),
        'label'         => __('Flight or Train Number'),
        'required'   => 'required',

        ), $checkout->get_value( 'my_field_name' ));

    echo '</div>';


     echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field( 'vat', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('VAT'),
        'placeholder'   => __(''),
        ), $checkout->get_value( 'vat' ));

    echo '</div>';
	
	echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field( 'passengers', array(
        'type'          => 'number',
        'custom_attributes' => array(
                    
                    'min'   => '1'
                ),
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('No of passengers '),
        'placeholder'   => __(''),
        'required'   => 'required',
        ), $checkout->get_value( 'passengers' ));

    echo '</div>';

}


add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['my_field_name'] ) ) {
        update_post_meta( $order_id, 'Flight or Train Number', sanitize_text_field( $_POST['my_field_name'] ) );
    }

     if ( ! empty( $_POST['vat'] ) ) {
        update_post_meta( $order_id, 'VAT', sanitize_text_field( $_POST['vat'] ) );
    }
	
	if ( ! empty( $_POST['passengers'] ) ) {
        update_post_meta( $order_id, 'passengers', sanitize_text_field( $_POST['passengers'] ) );
    }
}


// add_action('woocommerce_cart_calculate_fees', function() {
// if (is_admin() && !defined('DOING_AJAX')) {
// return;
// }
// $percentage = 0.09;
// $percentage_fee = (WC()->cart->get_cart_contents_total() + WC()->cart->get_shipping_total()) * $percentage;
//  WC()->cart->add_fee(__('Vat Tax(9%)', 'txtdomain'), $percentage_fee);
// });



add_filter( 'the_title', 'woo_title_order_received', 10, 2 );

function woo_title_order_received( $title, $id ) {
    if ( function_exists( 'is_order_received_page' ) && 
         is_order_received_page() && get_the_ID() === $id ) {
        $title = "Thank you for your Booking";
    }
    return $title;
}


add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2 );
function woo_change_order_received_text( $str, $order ) {
    $new_str = ' Thank you. Booking  summary has been  received.';
    return $new_str;
}


add_action( 'woocommerce_cart_calculate_fees','custom_tax_surcharge_for_swiss', 10, 1 );
function custom_tax_surcharge_for_swiss( $cart ) {
    if ( is_admin() && ! defined('DOING_AJAX') ) return;

   
    $percent = 9;
    # $taxes = array_sum( $cart->taxes ); // <=== This is not used in your function

   // print_r($cart->get_cart());

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {

         $surcharge = (  $cart_item['custom_data']['org_price'] + $cart->shipping_total ) - $cart_item['custom_data']['new_price'];

    
    }


   

    // Calculation
   

    // Add the fee (tax third argument disabled: false)
    $cart->add_fee( __( 'Vat Tax', 'woocommerce')." ($percent%)", $surcharge, false );
}


add_filter('woocommerce_cart_item_permalink','__return_false');





add_action('woocommerce_after_order_notes', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {

   

    woocommerce_form_field( 'checkedinluggage', array(
        'type'          => 'select',
        'class'         => array( 'wps-drop' ),
        'label'         => __( 'Do you have checked in luggage?' ),
        'required'   => 'required',
        'options'       => array(
            ''     => __( 'Select', 'wps' ),
            'Yes'   => __( 'Yes', 'wps' ),
            'No' => __( 'No', 'wps' )
           
        )
 ),

    $checkout->get_value( 'daypart' ));
	
	   echo '<div id="numberofsuitcase" style="display:none">';

    woocommerce_form_field( 'nsuitcase', array(
        'type'          => 'number',
        'custom_attributes' => array(
                    
                    'min'   => '1'
                ),
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('No of suitcases'),
        'placeholder'   => __(''),

        'required'   => 'required',
        ), $checkout->get_value( 'nsuitcase' ));

    echo '</div>';

}


add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error.
    if ($_POST['checkedinluggage'] == "")
     wc_add_notice( '<strong>Please select a day part under Delivery options</strong>', 'error' );

 }


 add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {

   if ($_POST['checkedinluggage']) update_post_meta( $order_id, 'checked in luggage', esc_attr($_POST['checkedinluggage']));
	 
   if ($_POST['checkedinluggage']) update_post_meta( $order_id, 'No of suitcases', esc_attr($_POST['nsuitcase']));

 }






function subscribe_link_att($atts) {

 
   
  $customer_orders = get_posts( array( 
    'numberposts'    => 1,
    'post_type' => 'shop_order',
    'post_status'    => array_keys( wc_get_order_statuses() ) 
) );

  foreach ( $customer_orders as $customer_order ) {

    $order_id = $customer_order->ID;

  }

   
    
  
    $order            = wc_get_order($order_id);
    


    $FlightorTrainNumber= esc_html( $order->get_meta( 'Flight or Train Number' ) );
    $VAT = esc_html( $order->get_meta( 'VAT' ) );
    $checkedinluggage = esc_html( $order->get_meta( 'checked in luggage' ) );
    $noofsuitcase = esc_html( $order->get_meta( 'No of suitcases' ) );

    $noofppl = esc_html( $order->get_meta( 'passengers' ) );

    


      
      
            $a=   '<h2>Other Information</h2>';
            $a.=  '<ul>';

           $a.=  ' <li><strong>Flight or Train Number:</strong> '.$FlightorTrainNumber.'</li>';
            $a.=  ' <li><strong>VAT:</strong> '.$VAT.'</li>';
            $a.=  ' <li><strong>No of passengers:</strong> '.$noofppl.'</li>';
            $a.=  ' <li><strong>Do you have checked in luggage:</strong> '.$checkedinluggage.' </li>';
            $a.=  ' <li><strong>No of suitcases:</strong> '.$noofsuitcase.' </li>';
            $a.=  '</ul>';

            $a.=  '</ul>';

            return $a;
       



}
add_shortcode('subscribe', 'subscribe_link_att');

