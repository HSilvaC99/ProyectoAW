'use strict'

function getSessionAsync(successCallback, errorCallback) {
    //  Prepare data
    const data = {
        action: 'read_session'
    };

    //  Do GET
    $.ajax({
        url: 'includes/requestHandler.php',
        data: data,
        type: 'GET',
        success: successCallback,
        error: errorCallback,
        dataType: 'json'
    });
}