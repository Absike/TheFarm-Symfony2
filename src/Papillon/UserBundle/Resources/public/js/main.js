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