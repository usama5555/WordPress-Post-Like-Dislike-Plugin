<?php
function UMP_setting_page_html(){
    if(!is_admin()){
       return;
    }
    ?>
    <div class="wrap">
       <h1><?= esc_html( get_admin_page_title() );?></h1>
       <form action="options.php" method="post">
          <?php
             settings_fields( 'ump-settings' );
             do_settings_sections( 'ump-settings' );
             submit_button( 'Save Changes' );
          ?>
       </form>
    </div>
       
    <?php
 }
 
 function ump_register_menu_page(){
 
     add_menu_page( 'UMP Like Dislike', 'UMP Settings', 'manage_options', 'ump-settings', 'UMP_setting_page_html', 'dashicons-thumbs-up', 30 );
 }
 add_action('admin_menu', 'ump_register_menu_page');
 
 function ump_plugin_settings(){
    register_setting( 'ump-settings', 'ump_like_btn_label');
    register_setting( 'ump-settings', 'ump_dislike_btn_label');
    add_settings_section( 'ump_label_settings_section', 'UMP Button Labels', 'ump_plugin_settings_section_cb', 'ump-settings' );
    add_settings_field( 'wmp_like_label_field', 'Like Button Label', 'ump_like_label_field_cb', 'ump-settings', 'ump_label_settings_section');
    add_settings_field( 'wmp_dislike_label_field', 'Dislike Button Label', 'ump_dislike_label_field_cb', 'ump-settings', 'ump_label_settings_section');
    
 }
 add_action('admin_init', 'ump_plugin_settings');
 
 function ump_plugin_settings_section_cb(){
    echo '<p>Define Button Labels</p>'; 
 }
 
 function ump_like_label_field_cb(){
    // get the value of the setting we've registered with register_setting()
     $setting = get_option('ump_like_btn_label');
     
     ?>
     <input type="text" name="ump_like_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
     <?php
 }
 function ump_dislike_label_field_cb(){
    // get the value of the setting we've registered with register_setting()
     $setting = get_option('ump_dislike_btn_label');
     
     ?>
     <input type="text" name="ump_dislike_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
     <?php
 }