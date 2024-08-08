<?php   
function ump_like_dislike_buttons ($content) {
    $like_btn_label = get_option('ump_like_btn_label', 'Like');
    $dislike_btn_label = get_option('ump_dislike_btn_label', 'Dislike');

    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    $like_btn_wrap = '<div class="ump_buttons_container">';
    $like_btn = '<a href="javascript:;" onclick="ump_like_btn_ajax(' . $post_id . ',' . $user_id . ')" class="ump-btn ump-like-btn">' . $like_btn_label . '</a>'; 
    $dislike_btn = '<a href="javascript:;" onclick="ump_dislike_btn_ajax(' . $post_id . ',' . $user_id . ')" class="ump-btn ump-dislike-btn">' . $dislike_btn_label . '</a>'; 
    $like_btn_wrap_end = '</div>';

    $ump_ajax_response = '<div id="umpAjaxResponse" class="ump-ajax_response"><span></span></div>'; 

    $content .= $like_btn_wrap;
    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $like_btn_wrap_end;
    $content .= $ump_ajax_response;
    return $content;
}
add_filter('the_content', 'ump_like_dislike_buttons');
