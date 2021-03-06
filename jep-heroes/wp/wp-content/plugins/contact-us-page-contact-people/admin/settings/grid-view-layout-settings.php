<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
Grid View Layout Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class People_Contact_Grid_View_Layout_Settings extends People_Contact_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'profile-cards';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'people_contact_grid_view_layout';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'people_contact_grid_view_layout';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;
	
	/**
	 * @var array
	 */
	public $form_fields = array();
	
	/**
	 * @var array
	 */
	public $form_messages = array();
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Profile Cards successfully saved.', 'cup_cp' ),
				'error_message'		=> __( 'Error: Profile Cards can not save.', 'cup_cp' ),
				'reset_message'		=> __( 'Profile Cards successfully reseted.', 'cup_cp' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'reset_default_settings' ) );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {
		
		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $people_contact_admin_interface;
		
		$people_contact_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* reset_default_settings()
	/* Reset default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function reset_default_settings() {
		global $people_contact_admin_interface;
		
		$people_contact_admin_interface->reset_settings( $this->form_fields, $this->option_name, true, true );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $people_contact_admin_interface;
		
		$people_contact_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}
	
	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array ( 
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {
		
		$subtab_data = array( 
			'name'				=> 'profile-card-type',
			'label'				=> __( 'Profile Card Type', 'cup_cp' ),
			'callback_function'	=> 'people_contact_grid_view_layout_settings_form',
		);
		
		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {
	
		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();
		
		return $subtabs_array;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $people_contact_admin_interface;
		
		$output = '';
		$output .= $people_contact_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );
		
		return $output;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		
  		// Define settings			
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
			
			array(
            	'name' 		=> '',
            	'desc'		=> __( '<strong>Profile Cards Dynamic CSS</strong>. Profile card layout and style in the Lite Version is a static style sheet that can be edited by any competent CSS programmer. The advanced Pro and Ultimate versions have dynamic style sheets instead of the static style sheet and a unique profile card layout and style can be created from this page, with the settings below - without touching the code.', 'cup_cp' ),
                'type' 		=> 'heading',
           	),

			array(
            	'name' 		=> __( 'Profile Card Layout', 'cup_cp' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'profile_card_type_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Profile Image Position', 'cup_cp' ),
				'id' 		=> 'thumb_image_position',
				'type' 		=> 'onoff_radio',
				'class'		=> 'thumb_image_position',
				'default' 	=> 'left',
				'onoff_options' => array(
					array(
						'val' 				=> 'left',
						'text' 				=> __( 'Card Type 1. Image Left - Content Right', 'cup_cp' ) . ' (' . __( 'Default', 'cup_cp' ) . ')',
						'checked_label'		=> __( 'ON', 'cup_cp') ,
						'unchecked_label' 	=> __( 'OFF', 'cup_cp') ,
					),
					array(
						'val' 				=> 'right',
						'text' 				=> __( 'Card Type 2. Content Left - Image Right', 'cup_cp' ),
						'checked_label'		=> __( 'ON', 'cup_cp') ,
						'unchecked_label' 	=> __( 'OFF', 'cup_cp') ,
					),
					array(
						'val' 				=> 'top',
						'text' 				=> __( 'Card Type 3. Image Top - Content Bottom', 'cup_cp' ),
						'checked_label'		=> __( 'ON', 'cup_cp') ,
						'unchecked_label' 	=> __( 'OFF', 'cup_cp') ,
					),
				),			
			),
			
			array(
            	'class'		=> 'thumb_image_position_side',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Profile Image Width', 'cup_cp' ),
				'desc'		=> '%. ' . __( 'Set as a percentage of total Profile Card width.', 'cup_cp' ),
				'id' 		=> 'thumb_image_wide',
				'type' 		=> 'slider',
				'default'	=> 25,
				'min'		=> 25,
				'max'		=> 50,
				'increment'	=> 1,
			),
			array(
            	'class'		=> 'thumb_image_position_top',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Image Height', 'cup_cp' ),
				'desc' 		=> __( "Dynamic image and hence profile card height will vary if uploaded profile images are different dimensions.", 'cup_cp' ),
				'id' 		=> 'fix_thumb_image_height',
				'class'		=> 'fix_thumb_image_height',
				'type' 		=> 'switcher_checkbox',
				'default'	=> '1',
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'FIXED', 'cup_cp' ),
				'unchecked_label' 	=> __( 'DYNAMIC', 'cup_cp' ),
			),

			array(
            	'class'		=> 'fix_thumb_image_height_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Image Fixed Height', 'cup_cp' ),
				'desc'		=> 'px. ' . __( 'Max height of image. Example set 200px and will fix image container at 200px with image aligned to the top. Default', 'cup_cp' ) . ' [default_value]px',
				'id' 		=> 'thumb_image_height',
				'type' 		=> 'text',
				'default'	=> 150,
				'css'		=> 'width:40px;',
			),

			array(
            	'class'		=> 'thumb_image_position_top',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Title Position', 'cup_cp' ),
				'id' 		=> 'item_title_position',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'above',
				'checked_value' 	=> 'above',
				'unchecked_value' 	=> 'below',
				'checked_label'		=> __( 'Above the image', 'cup_cp' ),
				'unchecked_label' 	=> __( 'Below the image', 'cup_cp' ),
			),
			

			array(
            	'name' 		=> __( 'Profile Card Style', 'cup_cp' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'profile_card_style_box',
                'is_box'	=> true,
           	),
			array(
            	'name' 		=> __( 'Create a Custom Profile Card Design', 'cup_cp' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Profile Card background Colour', 'cup_cp' ),
				'desc' 		=> __( "Profile Card body background colour. Default", 'cup_cp') . ' [default_value]',
				'id' 		=> 'grid_view_item_background',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' 		=> __( 'Profile Card border', 'cup_cp' ),
				'id' 		=> 'grid_view_item_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#DBDBDB', 'corner' => 'square' , 'rounded_value' => 0 )
			),
			
			array(  
				'name' 		=> __( 'Card Border Shadow', 'cup_cp' ),
				'id' 		=> 'grid_view_item_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 1, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#DBDBDB', 'inset' => '' )
			),
			array(  
				'name' => __( 'Border Padding', 'cup_cp' ),
				'id' 		=> 'grid_view_item_padding',
				'desc'		=> __( 'Adds padding (space) between the card borders and the card content', 'cup_cp' ),
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'grid_view_item_padding_top',
	 										'name' 		=> __( 'Top', 'cup_cp' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10 ),
	 
	 								array(  'id' 		=> 'grid_view_item_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'cup_cp' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10 ),
											
									array( 
											'id' 		=> 'grid_view_item_padding_left',
	 										'name' 		=> __( 'Left', 'cup_cp' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10 ),
											
									array( 
											'id' 		=> 'grid_view_item_padding_right',
	 										'name' 		=> __( 'Right', 'cup_cp' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10 ),
	 							)
			),

			array(
            	'name' 		=> __( 'Profile Card Image Style', 'cup_cp' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'profile_image_style_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Image Style', 'cup_cp' ),
				'id' 		=> 'item_image_border_type',
				'type' 		=> 'select',
				'default'	=> 'rounder',
				'options'		=> array( 
					'rounder' 	=> __( 'Rounded Border', 'cup_cp' ), 
					'square' 	=> __( 'Square Border', 'cup_cp' ), 
					'no' 		=> __( 'Flat Image', 'cup_cp' ), 
				),
				'css' 		=> 'width:160px;',
			),
			array(  
				'name' 		=> __( 'Image Background Colour', 'cup_cp' ),
				'desc' 		=> __( "Shows in Image Padding area or if image is transparent. Default", 'cup_cp') . ' [default_value]',
				'id' 		=> 'item_image_background',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' 		=> __( 'Image Border', 'cup_cp' ),
				'id' 		=> 'item_image_border',
				'type' 		=> 'border_styles',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#DBDBDB' )
			),
			
			array(  
				'name' 		=> __( 'Image Shadow', 'cup_cp' ),
				'id' 		=> 'item_image_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 1, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#DBDBDB', 'inset' => '' )
			),
			array(  
				'name' 		=> __( 'Image Padding', 'cup_cp' ),
				'desc' 		=> 'px. ' . __( "Padding (space) between the image border and the image.", 'cup_cp'),
				'id' 		=> 'item_image_padding',
				'type' 		=> 'text',
				'default'	=> 2,
				'css' 		=> 'width:40px;',
			),


			array(
            	'name' 		=> __( 'Profile Card No Image', 'cup_cp' ),
				'desc'		=> __( "Upload custom 'No Image' image, .jpg or.png format.", 'cup_cp' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'default_profile_image_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Default Profile Image', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[default_profile_image]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/no-avatar.png',
				'separate_option'	=> true,
			),
			array(
            	'name' 		=> __( 'Profile Card Contact Icons', 'cup_cp' ),
				'desc'		=> __( "Delete default icons. Upload custom icons, transparent .png format, 16px by 16px recommended size.", 'cup_cp' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'profile_contact_icons_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Phone icon', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[grid_view_icon_phone]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/p_icon_phone.png',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Fax icon', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[grid_view_icon_fax]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/p_icon_fax.png',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Mobile icon', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[grid_view_icon_mobile]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/p_icon_mobile.png',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Email icon', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[grid_view_icon_email]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/p_icon_email.png',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Email Link Text', 'cup_cp' ),
				'desc'		=> __( 'Set hyperlink text that shows to the right of the Email icon. Default', 'cup_cp' ) . " '[default_value]'",
				'id' 		=> 'people_contact_grid_view_icon[grid_view_email_text]',
				'type' 		=> 'text',
				'default'	=> __( 'Click Here', 'cup_cp' ),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Website icon', 'cup_cp' ),
				'id' 		=> 'people_contact_grid_view_icon[grid_view_icon_website]',
				'type' 		=> 'upload',
				'default'	=> PEOPLE_CONTACT_IMAGE_URL.'/p_icon_website.png',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Website Link Text', 'cup_cp' ),
				'desc'		=> __( 'Set hyperlink text that shows to the right of the Website icon. Default', 'cup_cp' ) . " '[default_value]'",
				'id' 		=> 'people_contact_grid_view_icon[grid_view_website_text]',
				'type' 		=> 'text',
				'default'	=> __( 'Visit Website', 'cup_cp' ),
				'separate_option'	=> true,
			),
        ));
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.fix_thumb_image_height:checked").val() != '1') {
		$(".fix_thumb_image_height_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	if ( $("input.thumb_image_position:checked").val() == 'top') {
		$(".thumb_image_position_side").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".thumb_image_position_top").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".fix_thumb_image_height_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	$(document).on( "a3rev-ui-onoff_radio-switch", '.thumb_image_position', function( event, value, status ) {
		$(".thumb_image_position_side").attr('style','display:none;');
		$(".thumb_image_position_top").attr('style','display:none;');
		$(".fix_thumb_image_height_container").attr('style','display:none;');
		if ( value == 'top' && status == 'true' ) {
			$(".thumb_image_position_top").slideDown();
			$(".thumb_image_position_side").slideUp();
			if ( $("input.fix_thumb_image_height:checked").val() == '1') {
				$(".fix_thumb_image_height_container").slideDown();
			}
		} else if ( status == 'true' ) {
			$(".thumb_image_position_top").slideUp();
			$(".thumb_image_position_side").slideDown();
			$(".fix_thumb_image_height_container").slideUp();
		}
	});
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.fix_thumb_image_height', function( event, value, status ) {
		$(".fix_thumb_image_height_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".fix_thumb_image_height_container").slideDown();
		} else {
			$(".fix_thumb_image_height_container").slideUp();
		}
	});
});
})(jQuery);
</script>
    <?php
	}

}

global $people_contact_grid_view_layout_settings;
$people_contact_grid_view_layout_settings = new People_Contact_Grid_View_Layout_Settings();

/** 
 * people_contact_grid_view_layout_settings_form()
 * Define the callback function to show subtab content
 */
function people_contact_grid_view_layout_settings_form() {
	global $people_contact_grid_view_layout_settings;
	$people_contact_grid_view_layout_settings->settings_form();
}

?>
