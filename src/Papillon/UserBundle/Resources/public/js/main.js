
/**
 *
 * @param proxy
 * @param apiUrl
 * @param apiParams
 * @returns {*}
 */
var sendAjaxRequest = function(proxy , apiUrl , apiParams){
    return $.ajax({
        type: "POST",
        dataType: 'json',
        url: proxy,
        data: {
            restUrl : apiUrl,
            method: 'POST',
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
 * Method to build datatable
 * @param container
 * @param aData
 * @returns {*|jQuery}
 */
var buildDataTable = function (container,aData) {

    var oTable = $(container).dataTable({

        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bLengthChange": true,
        "iDisplayLength": 10,
        "aaData": aData,
        fnDrawCallback: function () {
            var wrapper = this.parent();
            var rowsPerPage = this.fnSettings()._iDisplayLength;
            var rowsToShow = this.fnSettings().fnRecordsDisplay();
            var minRowsPerPage = this.fnSettings().aLengthMenu[0][0];
            if (rowsToShow <= rowsPerPage || rowsPerPage == -1) {
                $('.dataTables_paginate', wrapper).css('visibility', 'hidden');
            }
            else {
                $('.dataTables_paginate', wrapper).css('visibility', 'visible');
            }
            if (rowsToShow <= minRowsPerPage) {
                $('.dataTables_length', wrapper).css('visibility', 'hidden');
            }
            else {
                $('.dataTables_length', wrapper).css('visibility', 'visible');
            }
        }
    });

    return oTable;
};

/**
 * Convert UTC time to normal time format using Moment js
 * @param s
 * @returns {*}
 */
function dateFormatter(s) {
    return moment.parseZone(s).format('D MMM YYYY');
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