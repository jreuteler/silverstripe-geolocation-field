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

                // refresh event
                input.parent().find('img.action.refresh').click(function (e) {
                    e.preventDefault();
                    refreshField();
                });

            },

        });
    });
})(jQuery);

var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};


function updatePosition(field) {
    navigator.geolocation.getCurrentPosition(function (position) {
        successForField(field, position);
    }, error, options);
}

function successForField(field, pos) {

    var crd = pos.coords;
    field.attr('value', crd.latitude + ',' + crd.longitude + ',' + crd.accuracy);
    field.parent().find('input.text.latitude').attr('value', crd.latitude);
    field.parent().find('input.text.longitude').attr('value', crd.longitude);
    field.parent().find('input.text.accuracy').attr('value', crd.accuracy);

    var accuracySpan = field.parent().find('input.text.accuracy').parent().find('.status');
    accuracySpan.removeClass('missing good average bad');

    var accuracyClass = 'missing';
    if (crd.accur > 0 && crd.accuracy < 25) {
        accuracyClass = 'good';
    } else if (crd.accuracy < 50) {
        accuracyClass = 'average';
    } else {
        accuracyClass = 'bad';
    }
    accuracySpan.addClass(accuracyClass);

};

function error(err) {
    console.warn('ERROR(${err.code}): ${err.message}');
    return false;
};

