/**
 * Generates the notification on activity
 *
 * @param {str}  message    The message
 * @param {str}  alertType  The alert type
 */
function jGrowlAlert(message, alertType) {

    var header_msg = alertType == 'success' ? 'Success!' : 'Oh Snap!';
    $.jGrowl(message, {
        header: header_msg,
        theme: 'bg-' + alertType
    });
}

/**
 * Selects/deselects all the checkboxes
 *
 * @param {obj}  obj  The checkbox object
 */
function select_all(obj) {

    if (obj.checked) {
        $(".checkbox").each(function() {
            $(this).prop("checked", "checked");
            $(this).parent().addClass("checked");
        });
    } else {
        $('.checkbox').each(function() {
            this.checked = false;
            $(this).parent().removeClass("checked");
        });
    }
}