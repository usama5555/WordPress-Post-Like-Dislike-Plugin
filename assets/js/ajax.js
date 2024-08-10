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
            var data = JSON.parse(response);
            jQuery("#umpAjaxResponse span").html('You Liked this post.');
            jQuery("#like_count span").text(data.like_count);
            jQuery("#dislike_count span").text(data.dislike_count);
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
            var data = JSON.parse(response);
            jQuery("#umpAjaxResponse span").html('You Disliked this post.');
            jQuery("#like_count span").text(data.like_count);
            jQuery("#dislike_count span").text(data.dislike_count);
        }
    });
}
