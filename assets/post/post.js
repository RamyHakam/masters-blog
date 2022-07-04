import './post.css';
$(document).ready(function() {
    var $wrapper = $('.new_post_form');
    $wrapper.on('submit', function (e) {

        var $form = $(e.currentTarget);
        var file = $form.find('input[type="file"]')[0].files[0];
        if(file && file !== '') {
            return;
        }
        e.preventDefault();
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function (data) {
                var posts = $('.posts');
                posts.prepend(data);
                   $form.trigger('reset');
            }
        });
    });
});