'use strict'

async function refreshSessionCookie() {
    //  Prepare data
    const data = {
        action: 'read_session'
    };

    //  Do GET
    const result = await $.ajax({
        url: 'includes/requestHandler.php',
        data: data,
        type: 'GET',
        dataType: 'json'
    });

    if (!result.hasOwnProperty('isAdmin'))
        result['isAdmin'] = false;

    //  We must stringify because cookies must be stored as strings
    $.cookie('session', JSON.stringify(result));
}

async function ensureCookieExists() {
    //  Check if session cookie is already set
    if ($.cookie('session') == undefined)
        //  Cookie is not set; we must request it from the server and then cache it
        await refreshSessionCookie();
}

async function getSessionAsync() {
    ensureCookieExists();

    return JSON.parse($.cookie('session'));
}

window.addEventListener('load', () => {
    refreshSessionCookie();
});