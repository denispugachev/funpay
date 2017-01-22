function request(url) {
    var result = '',
        $indicator = $('#indicator'),
        $result = $('#result');

    $indicator.show();
    $result.text('');

    $('#modal').modal();

    $.ajax({
        url: url,
        dataType: 'text',
        success: function (data) {
            result = data;
        },
        error: function (error) {
            result = 'Error occured: ' + error.statusText;
        },
        complete: function () {
            $indicator.hide();
            $result.text(result);
        }
    });
}

$(function () {
    $('#request-form').on('submit', function (e) {
        e.preventDefault();
        var url = $('#url').val();

        if (url) {
            request(url);
        }
    });
});