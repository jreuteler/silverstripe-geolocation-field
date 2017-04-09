/**
 * Register geolocation functions with fields.
 */

(function ($) {
    jQuery.entwine('ss.geolocation', function ($) {

        jQuery('.field.geolocation input.text').entwine({

            onmatch: function () {

                var input = $(this);
                var hiddenInput = input.parent().find(':hidden');
                var valueHolder = input.parent().find('.value-holder');
                var valueEl = input.parent().find('.value-holder .value');

                var refreshField = function () {
                    hiddenInput.val('');
                    valueHolder.addClass('has-value');
                    updatePosition();
                };

                // Prevent from loading itself more than once
                if (input.attr('data-position-set') == 'true')
                    return;
                input.attr('data-position-set', 'true');

                // init
                refreshField();

                // refresh event
                input.parent().find('a.refresh').click(function (e) {
                    e.preventDefault();
                    refreshField();
                });

            },

        });
    });
})(jQuery);


// TODO: rewrite
var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};


function success(pos) {
    var crd = pos.coords;
    jQuery('.field.geolocation input.text.geolocation').attr('value', crd.latitude + ',' + crd.longitude + ',' + crd.accuracy);
    jQuery('.field.geolocation input.text.latitude').attr('value', crd.latitude);
    jQuery('.field.geolocation input.text.longitude').attr('value', crd.longitude);
    jQuery('.field.geolocation input.text.accuracy').attr('value', crd.accuracy);
};

function error(err) {
    console.warn('ERROR(${err.code}): ${err.message}');
    return false;
};

function updatePosition() {
    return navigator.geolocation.getCurrentPosition(success, error, options);
}
