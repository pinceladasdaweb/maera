<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

require_once locate_template( '/lib/customizer/custom-controls/checkbox.php' );
require_once locate_template( '/lib/customizer/custom-controls/color.php' );
require_once locate_template( '/lib/customizer/custom-controls/google-fonts.php' );
require_once locate_template( '/lib/customizer/custom-controls/image.php' );
require_once locate_template( '/lib/customizer/custom-controls/radio.php' );
require_once locate_template( '/lib/customizer/custom-controls/select.php' );
require_once locate_template( '/lib/customizer/custom-controls/sliderui.php' );
require_once locate_template( '/lib/customizer/custom-controls/text.php' );
require_once locate_template( '/lib/customizer/custom-controls/textarea.php' );
require_once locate_template( '/lib/customizer/custom-controls/upload.php' );

function shoestrap_customizer_controls( $wp_customize ) {

	$controls = apply_filters( 'shoestrap/customizer/controls', array() );

	if ( isset( $controls ) ) {
		foreach ( $controls as $control ) {

			// Add settings
			$wp_customize->add_setting( $control['setting'], array(
				'default'    => $control['default'],
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options'
			) );

			// Checkbox controls
			if ( 'checkbox' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Checkbox_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'description' => $control['description'],
					) )
				);

			// Color Controls
			} elseif ( 'color' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Color_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Google Fonts Controls
			} elseif ( 'google_fonts' == $control['type'] ) {

				$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Image Controls
			} elseif ( 'image' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Image_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Radio Controls
			} elseif ( 'radio' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Radio_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
						'mode'        => $control['mode'], // Can be 'radio', 'image' or 'buttonset'.
					) )
				);

			// Select Controls
			} elseif ( 'select' == $control['type'] ) {

				$wp_customize->add_control( new SS_Select_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Slider Controls
			} elseif ( 'slider' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Sliderui_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Text Controls
			} elseif ( 'text' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Text_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Text Controls
			} elseif ( 'textarea' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Textarea_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);

			// Upload Controls
			} elseif ( 'upload' == $control['type'] ) {

				$wp_customize->add_control( new SS_Customize_Upload_Control( $wp_customize, $control['setting'], array(
						'label'       => $control['label'],
						'section'     => $control['section'],
						'settings'    => $control['setting'],
						'priority'    => $control['priority'],
						'choices'     => $control['choices'],
						'description' => $control['description'],
					) )
				);
			}
		}
	}
}
add_action( 'customize_register', 'shoestrap_customizer_controls' );

function shoestrap_enqueue_customizer_controls_styles() {

	wp_register_style( 'ss-customizer-css', get_template_directory_uri() . '/lib/customizer/assets/customizer.css', NULL, NULL, 'all' );
	wp_register_style( 'ss-customizer-ui',  get_template_directory_uri() . '/lib/customizer/assets/jquery-ui-1.10.0.custom.css', NULL, NULL, 'all' );
	wp_enqueue_style( 'ss-customizer-css' );
	wp_enqueue_style( 'ss-customizer-ui' );

	wp_enqueue_script( 'ss_customizer_js', get_template_directory_uri() . '/lib/customizer/assets/js/customizer.js');
	wp_enqueue_script( 'tipsy', get_template_directory_uri() . '/lib/customizer/assets/js/tooltipsy.min.js', array( 'jquery' ) );

}
add_action( 'customize_controls_print_styles', 'shoestrap_enqueue_customizer_controls_styles' );