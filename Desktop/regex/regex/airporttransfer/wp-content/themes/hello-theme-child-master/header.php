<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>



<body <?php body_class(); ?>>

<?php hello_elementor_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content">
	<?php esc_html_e( 'Skip to content', 'hello-elementor' ); ?></a>

<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-header' );
	} else {
		get_template_part( 'template-parts/header' );
	}
}

?>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
  $( function() {
    $( "#datefild" ).datepicker({numberOfMonths: 2,minDate: 0,dateFormat: 'dd/mm/yy'});
	$( "#datefild2" ).datepicker({numberOfMonths: 2,minDate: 0,dateFormat: 'dd/mm/yy'});
  } );
</script>
	
	