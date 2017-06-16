/**
 * Register geolocation functions with fields.
 */

var latitude, longitude, accuracy;
function setGeoLocation() {
    var geolocation = window.navigator.geolocation.watchPosition(
        function (position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
            accuracy = position.coords.accuracy;
        },
        function () { /*error*/
        }, {
            maximumAge: 250,
            enableHighAccuracy: true
        }
    );

    window.setTimeout(function () {
            window.navigator.geolocation.clearWatch(geolocation)
        },
        5000 //stop after 5sec (to save battery)
    );
};



(function ($) {
    jQuery.entwine('ss.geolocation', function ($) {

        jQuery('.text.hidden.geolocation').entwine({

            onmatch: function () {

                var input = $(this);
                var hiddenInput = input.parent().find(':hidden');
                var valueHolder = input.parent().find('.value-holder');
                var valueEl = input.parent().find('.value-holder .value');

                var refreshField = function () {
                    hiddenInput.val('');
                    valueHolder.addClass('has-value');
                    updatePos(input);
                };

                // Prevent from loading itself more than once
                if (input.attr('data-position-set') == 'true')
                    return;
                input.attr('data-position-set', 'true');

                // refresh event
                input.parent().find('.action.refresh').click(function (e) {
                    e.preventDefault();
                    refreshField();
                });

            },

        });
    });
})(jQuery);


function updatePos(field) {

    console.log('updatePos');
    setGeoLocation();

    var container = field.parent().find('.countdown-container');
    container.show();

    console.log('add countdown');

    var countdown = container.countdown360({
        radius: 40,
        seconds: 6,
        label: ['sec', 'secs'],
        fontColor: '#FFFFFF',
        autostart: false,
        onComplete: function () {
            storeCurrentGeoLocation(field);
            container.hide();
        }
    });
    countdown.start();
}



function storeCurrentGeoLocation(field) {
    field.attr('value', latitude + ',' + longitude + ',' + accuracy);
    field.parent().find('input.text.latitude').attr('value', latitude);
    field.parent().find('input.text.longitude').attr('value', longitude);
    field.parent().find('input.text.accuracy').attr('value', accuracy);
};
