$("#tickets_numb,#finished").each(function () {
    $(this).change(function () {
        var filter = '';
        if ($('#finished').is(':checked')) {
            filter = 'finished';
        }
        var top = $('#tickets_numb').val();
        // ajax request :
        var url = '/ticket/List?top=' + top + '&filter=' + filter;
        $.ajax({
            url: url,
            type: 'GET',
            success: function (html) {
                $('#tickets').html(html);
            }
        });
    });
});







