
/**
 *
 * @param proxy
 * @param apiUrl
 * @param apiParams
 * @returns {*}
 */
var sendAjaxRequest = function(apiUrl , method , apiParams){

    if (_.isUndefined(apiParams)) {
        apiParams = {};
    }

    if (_.isUndefined(method)) {
        method = 'GET'
    }

    return $.ajax({
        type: "POST",
        dataType: 'json',
        url: Routing.generate('_ajaxProxy'),
        data: {
            restUrl : apiUrl,
            method: method,
            params: apiParams
        }
    });
}

/**
 * Proceed Ajax calling
 * @param pUrl
 * @param pData
 * @param callback
 * @returns {*}
 */

var ajaxCall = function (aUrl,aOption) {

    return $.ajax({
        url: aUrl,
        type: aOption.method,
        data: aOption.params
    });

};

/**
 * Convert UTC time to normal time format using Moment js
 * @param date date
 * @param format string
 * @returns {*}
 */
function dateFormatterZone(date,format) {

    if (_.isUndefined(format)){
        format = 'YYYY-MM-DD'
    }

    return moment.parseZone(date).format(format);
}


/** Gestion cookies **/

//Set Cookies
function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

//Get Cookies
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

//Check cookies
function checkCookie(name) {

    if (document.cookie.indexOf(name) > 0 ) {
        return true
    }

    return false
}