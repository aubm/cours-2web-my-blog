(function() {
    window.addEventListener('load', function() {
        var postsContainer = document.getElementById('posts-container');
        var removeButtons = document.querySelectorAll('.remove-button');
        for (var i = 0 ; i < removeButtons.length ; i++) {
            removeButtons[i].addEventListener('click', function() {
                var button = this;
                var postElement = document.getElementById('post-' + button.getAttribute('data-post-id'));
                var requestBody = 'post_id=' + button.getAttribute('data-post-id');
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 204) {
                            postsContainer.removeChild(postElement);
                        }
                    }
                };
                xhr.open('POST', 'admin/remove_post_ajax', true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.setRequestHeader("Content-length", requestBody.length);
                xhr.send(requestBody);
            });
        }
    });
})();