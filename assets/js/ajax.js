// Like btn Ajax
function ump_like_btn_ajax(postId, usrId) {
    var post_id = postId;
    var usr_id = usrId;
    
    jQuery.ajax({
        url: ump_ajax_url.ajax_url,
        type: 'post',
        data: {
            action: 'ump_like_btn_ajax_action',
            pid: post_id,
            uid: usr_id
        },
        success: function(response) {
            jQuery("#umpAjaxResponse span").html(response);
            // Update the like count
            // jQuery("#like_count_" + post_id).text(response.like_count);
            // // Update the dislike count to zero
            // jQuery("#dislike_count_" + post_id).text(0);
        }
    });
}

// Dislike btn Ajax
function ump_dislike_btn_ajax(postId, usrId) {
    var post_id = postId;
    var usr_id = usrId;
    
    jQuery.ajax({
        url: ump_ajax_url.ajax_url,
        type: 'post',
        data: {
            action: 'ump_dislike_btn_ajax_action',
            pid: post_id,
            uid: usr_id
        },
        success: function(response) {
            jQuery("#umpAjaxResponse span").html(response);
            // Update the dislike count
            // jQuery("#dislike_count_" + post_id).text(response.dislike_count);
            // // Update the like count to zero
            // jQuery("#like_count_" + post_id).text(0);
        }
    });
}
