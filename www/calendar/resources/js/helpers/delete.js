$(document).ready(function () {
    $('body').on('click', 'a[data-type="delete"]', function (e) {
        e.preventDefault();

        if (!confirm('Are you sure?')) {
            return;
        }

        const url = $(this).attr('href'), token = $(this).attr('data-csrf');
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'delete'},
            success: function () {
                location.reload()
            }
        });
    })
});
