<?php 


/**
 * Template Name: Custom Add to cart
 
 */

 ?>
<?php




$custom_data = array(); // Initializing

$product_id=$_POST['productid'];

if( isset($_POST['Pickuplocation']) && ! empty($_POST['Pickuplocation']) )
    $custom_data['custom_data']['Pickup location']  = sanitize_text_field( $_POST['Pickuplocation'] );
if( isset($_POST['Destination']) && ! empty($_POST['Destination']) )
    $custom_data['custom_data']['Drop-off location'] = sanitize_text_field( $_POST['Destination'] );
if( isset($_POST['Pickupdate']) && ! empty($_POST['Pickupdate']) )
    $custom_data['custom_data']['Pickup date']   = sanitize_text_field( $_POST['Pickupdate'] );
if( isset($_POST['Pickuptime']) && ! empty($_POST['Pickuptime']) )
    $custom_data['custom_data']['Pickup time']   = sanitize_text_field( $_POST['Pickuptime'] );


if( isset($_POST['Return-Booking']) && ! empty($_POST['Return-Booking']) )
    $custom_data['custom_data']['Return transfer']   = sanitize_text_field( $_POST['Return-Booking'] );

if($_POST['Return-Booking']=='Yes'){

if( isset($_POST['Return-Date']) && ! empty($_POST['Return-Date']) )
    $custom_data['custom_data']['Return date']   = sanitize_text_field( $_POST['Return-Date'] );

if( isset($_POST['Return-Time']) && ! empty($_POST['Return-Time']) )
    $custom_data['custom_data']['Return time']   = sanitize_text_field( $_POST['Return-Time'] );

}



// Set the calculated item price as custom cart item data
if( isset($custom_data['custom_data']) && sizeof($custom_data['custom_data']) > 0 && $product_id > 0 ) {
    // Get an instance of the WC_Product object
    $product = wc_get_product( $product_id );
    // Save the new calculated price as custom cart item data

    
     $price=sanitize_text_field($_POST['price']);    
    

     $discountprice=sanitize_text_field($_POST['price']) /1.09;

     $dt= round($discountprice, 2);


    
     
    $custom_data['custom_data']['new_price'] = ($product->get_price())*$dt;

    $custom_data['custom_data']['org_price'] = ($product->get_price()*sanitize_text_field( $_POST['price'] ));
}

// Add product to cart with the custom cart item data
WC()->cart->add_to_cart( $product_id, '1', '0', array(), $custom_data );

$url=get_page_link(1567);

echo '<script>window.location.href="'.$url.'"</script>';


?>

