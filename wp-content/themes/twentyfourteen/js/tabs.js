jQuery(document).ready(function($){
    $('#tabs').tabs({
        beforeLoad: function( event, ui ) {
            ui.jqXHR.error(function(){
                ui.panel.html(
                    "Couldn't load tab content!"
                );
            });
        }
    });
    $('#dialog_link, ul#icons li').hover(
        function() { $(this).addClass('ui-state-hover'); },
        function() { $(this).removeClass('ui-state-hover'); }
    );
});