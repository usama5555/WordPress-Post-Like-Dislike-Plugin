<?php   
function ump_like_dislike_buttons ($content) {

    if (is_single() && get_post_type() === 'post') {
    $like_btn_label = get_option('ump_like_btn_label', 'Like');
    $dislike_btn_label = get_option('ump_dislike_btn_label', 'Dislike');



    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    //---------
    global $wpdb;
    $table_name = $wpdb->prefix . "ump_like_system";
    
    $initial_like_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND like_count = 1", $post_id));
    
    $initial_dislike_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND dislike_count = 1", $post_id));
    //-----------

    $like_btn_wrap = '<div class="ump_buttons_container">';
    $like_btn = '<a href="javascript:;" onclick="ump_like_btn_ajax(' . $post_id . ',' . $user_id . ')" class="ump-btn ump-like-btn">' . $like_btn_label . '</a>'; 
    $dislike_btn = '<a href="javascript:;" onclick="ump_dislike_btn_ajax(' . $post_id . ',' . $user_id . ')" class="ump-btn ump-dislike-btn">' . $dislike_btn_label . '</a>'; 
    $like_btn_wrap_end = '</div>';



    $ump_ajax_response = '<div id="umpAjaxResponse" ><span></span></div>'; 
//---------
    $show_like_count = '<div id="like_count" class="ump-ajax_response">Like Count: <span>' . $initial_like_count . '</span></div>';

    $show_dislike_count = '<div id="dislike_count" class="ump-ajax_response">Dislike Count: <span>' . $initial_dislike_count . '</span></div>';

//--------------
    $content .= $like_btn_wrap;
    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $like_btn_wrap_end;
    $content .= $ump_ajax_response;
    //---------
    $content .= $show_like_count;
    $content .= $show_dislike_count;
    //---------
    }
    return $content;
}
add_filter('the_content', 'ump_like_dislike_buttons');
