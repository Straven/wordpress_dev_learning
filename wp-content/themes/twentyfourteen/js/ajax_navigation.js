jQuery('#navigation a').click(function (e) {
    e.preventDefault();
    var page = jQuery(this).attr('href').split('=');
    jQuery.ajax({
        type: 'GET',
        url: more_posts.ajaxurl,
        data: {
            action: 'more_posts',
            page: page[1]
        },
        dataType: "html",
        success: function (data, textStatus, XMLHttpRequest) {
            jQuery("#articles").hide(100, function () {
                jQuery("#articles").html(data);
            });
            jQuery("#articles").show(100);

        },
        error: function (MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }

    });
    return false;
});

