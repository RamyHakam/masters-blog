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
    var commentForm = $('.comment-form');
    commentForm.on('submit', function (e) {
        e.preventDefault();
        var $form = $(e.currentTarget);
        var  postId = $form.data('post-id');
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function (data) {
                var comments = $('.comments_' + postId);
                comments.append(data);
                var count = $('#comments-count_' + postId);
                count.text(parseInt(count.text()) + 1 + ' comments');
                $form.trigger('reset');
            }
        });
    });
});