<?php
add_action( 'admin_menu', 'yay_local_review_page' );
function yay_local_review_page() {
    add_menu_page(
        'Local Review',
        'Local Review',
        'manage_options',
        'local review',
        'local_review_page_html',
        plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
        20
    );

    add_submenu_page(
		'local review',
		'Local Review Setting',
		'Local Review Setting',
		'manage_options',
		'local_review_setting',
		'yay_local_review_page_html'
	);

    remove_submenu_page('local review', 'local review');

    // add_menu_page(
    //     'Local Test',
    //     'Local Test',
    //     'manage_options',
    //     'local test',
    //     'local_test_page_html',
    //     plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
    //     21
    // );

}

function yay_local_review_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wporg_options"
			settings_fields( 'wporg_options' );
			// output setting sections and their fields
			// (sections are registered for "wporg", each field is registered to a specific section)
			do_settings_sections( 'wporg' );
			// output save settings button
			submit_button( __( 'Save Settings', 'textdomain' ) );
			?>
		</form>
	</div>
	<?php
}

function yay_local_review_go_to_review_button( $title, $post_id ) {

    $title = $title.'<a class="yay-local-display" href="#yay-local-review-text-area">Go to Review</a>';

    return $title;
}
add_filter( 'the_title', 'yay_local_review_go_to_review_button', 10, 2 );


function yay_local_add_id( $fields ) {
	$fields['comment'] = '<div id="yay-local-review-text-area">' . $fields['comment'] . '</div>';
	return $fields;
}
add_filter( 'comment_form_fields','yay_local_add_id', 10, 1 );


function enqueue_styles() {
  wp_enqueue_style( 'frontend-style', LOCAL_REVIEW_PLUGIN_URL . './styles/styles.css' );
}

add_action( 'wp_head', 'enqueue_styles', 9); 
