import './post.css';
$(document).ready(function() {
    var $wrapper = $('.new_post_form');
    $wrapper.on('submit', function (e) {
        e.preventDefault();
        var $form = $(e.currentTarget);
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function (data) {
                var posts = $('.posts');
                posts.prepend(data);
            }
        });
        console.log('submit');
    });
});