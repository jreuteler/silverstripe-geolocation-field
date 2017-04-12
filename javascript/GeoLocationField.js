/**
 * Register geolocation functions with fields.
 */

(function ($) {
    jQuery.entwine('ss.geolocation', function ($) {

        jQuery('input.text.hidden.geolocation').entwine({

            onmatch: function () {

                var input = $(this);
                var hiddenInput = input.parent().find(':hidden');
                var valueHolder = input.parent().find('.value-holder');
                var valueEl = input.parent().find('.value-holder .value');

                var refreshField = function () {
                    hiddenInput.val('');
                    valueHolder.addClass('has-value');
                    updatePosition(input);
                };

                // Prevent from loading itself more than once
                if (input.attr('data-position-set') == 'true')
                    return;
                input.attr('data-position-set', 'true');

                // only load current position on startup when field is empty
                if (input.attr('value') == '') {
                    refreshField();
                }

                // refresh event
                input.parent().find('img.action.refresh').click(function (e) {
                    e.preventDefault();
                    refreshField();
                });

            },

        });
    });
})(jQuery);


function updatePosition(field) {
    navigator.geolocation.getCurrentPosition(function (position) {
        successForField(field, position);
    }, error);
}


function successForField(field, pos) {

    var crd = pos.coords;
    field.attr('value', crd.latitude + ',' + crd.longitude + ',' + crd.accuracy);
    field.parent().find('input.text.latitude').attr('value', crd.latitude);
    field.parent().find('input.text.longitude').attr('value', crd.longitude);
    field.parent().find('input.text.accuracy').attr('value', crd.accuracy);
};

function error(err) {
    console.warn('ERROR(${err.code}): ${err.message}');
    return false;
};

