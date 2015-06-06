(function($) {
    $(document).ready(function() {
        $(".remove-button").click(function() {
            var postId = $(this).data().postId;
            $.ajax({
                url: "remove-post-ajax.php",
                method: "POST",
                data: {
                    post_id: postId
                }
            }).done(function(responseBody, textStatus, xhr) {
                if (xhr.status === 204) {
                    $("#post-" + postId).remove();
                }
            });
        });
    });
})(jQuery);