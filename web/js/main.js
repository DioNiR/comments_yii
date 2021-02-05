$(document).ready(function () {
    $(document).on("click", '[data-toggle="collapse"]', function() {
        let $this = $(this),
            $parent = typeof $this.data('parent') !== 'undefined' ? $($this.data('parent')) : undefined;
        if ($parent === undefined) {
            $this.find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
            return true;
        }

        let currentIcon = $this.find('.glyphicon');
        currentIcon.toggleClass('glyphicon-plus glyphicon-minus');
        $parent.find('.glyphicon').not(currentIcon).removeClass('glyphicon-minus').addClass('glyphicon-plus');

    });

    $(document).on('click', '.show_comments', function() {
        let id = $(this).data('id');
        $(this).remove();
        $('#comments_' + id).find('.hide_comments').show();
    });

    $(document).on('click', '.delete_comment', function() {
        let id = $(this).data('id');
        console.log(id);
        $.ajax({
            type: "POST",
            url: '/comments/delete',
            data: {'id': id},
            success: function (data) {
                console.log(data);
                $('#comment_' + id).remove();
            },
            dataType: 'json'
        });

        return false;
    });

    $(document).on("submit", 'form', function() {
        let parentId = $(this).find('[name="CommentForm[parentId]"]').val();

        $.ajax({
            type: "POST",
            url: '/comments/create',
            data: $(this).serialize(),
            success: function (data) {
                if (0 == parentId) {
                    $('#comments').append(data['html']);
                } else {
                    $('#comments_' + parentId).append(data['html']);
                }
            },
            dataType: 'json'
        });

        return false;
    });
});