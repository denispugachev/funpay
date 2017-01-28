/**
 * Performs HTTP request and shows result in Bootstrap modal dialog.
 *
 * @param {string} action
 * @param {string} text
 */
function request(action, text) {
    var result = '',
        $indicator = $('#indicator'),
        $result = $('#result');

    $indicator.show();
    $result.text('');

    $('#modal').modal();

    $.ajax({
        url: action,
        type: 'post',
        data: {
            text: text
        },
        success: function (data) {
            result = 'Wallet: ' + data.wallet + '<br>';
            result += 'Code: ' + data.code + '<br>';
            result += 'Sum: ' + data.sum;
        },
        error: function (error) {
            result = 'Error occured: ' + error.statusText;
        },
        complete: function () {
            $indicator.hide();
            $result.html(result);
        }
    });
}

/**
 * onready callback.
 */
$(function () {
    $('#request-form').on('submit', function (e) {
        e.preventDefault();
        var text = $('#text').val();

        if (text) {
            request($(this).attr('action'), text);
        }
    });
});