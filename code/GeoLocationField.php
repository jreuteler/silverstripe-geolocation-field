<?php


class GeoLocationField extends TextField
{

    /**
     * @param string      $name         The name of the field.
     * @param null|string $title        The title to use in the form.
     * @param string      $value        The initial value of this field.
     * @param null|int    $maxLength    Maximum number of characters.
     * @param null|string $form
     */
    public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value, $maxLength, $form);
    }

    /**
     * @return string
     */
    public function Type()
    {
        return 'geolocation text';
    }

    /**
     * @param array $properties
     *
     * @return string
     */
    public function Field($properties = array())
    {
        // jQuery
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');

        // Entwine
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');

        // init script for this field
        Requirements::javascript(GEOLOCATIONFIELD_DIR . '/javascript/GeoLocationField.js');

        return parent::Field($properties);
    }


}
