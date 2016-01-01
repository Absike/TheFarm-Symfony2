/**
 * Datatable management
 */

var DataTableBuilder =
{
    init: function ( container, config ) {

        if (!$(container).length) return false;

        //Default settings
        config.sPaginationType = 'full_numbers';
        config.fnDrawCallback = this.draw;
        config.fnInitComplete = this.dtFnComplete;
       // config.oLanguage = this.translation;

        var oTable = $(container).dataTable(config);

        $('.dataTables_filter').on('keyup',function(){
            oTable.fnFilter($(this).val());
        });

        return oTable;

    },

    draw: function (oSettings) {

        // Hide pagination if result in single page
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
            $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
        } else {
            $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }

        $(oSettings.oInstance).trigger('callbackDraw', oSettings);

    },

    translation: function () {

        var translate_fr = {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ lignes",
            "sInfo":           "Affichage de la ligne _START_ &agrave; _END_ sur _TOTAL_ lignes",
            "sInfoEmpty":      "Affichage de la ligne 0 &agrave; 0 sur 0 lignes",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donnée disponible.",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Pr&eacute;c&eacute;dent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }

        return translate_fr;
    },

    dtFnComplete : function(){
        $('#preloading').remove();
    }

}




/**.
 * Custom sorting URL links
 */
$.extend($.fn.dataTableExt.oSort, {

    "url-site-pre": function (a) {
        return a.replace(/^https?:\/\//,'');
    },

    "url-site-asc": function (a, b) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },

    "url-site-desc": function (a, b) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }


});