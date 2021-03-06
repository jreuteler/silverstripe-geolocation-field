<?php


/**
 * Class GeoLocationField
 */
class GeoLocationField extends FormField
{

    /**
     * @var int
     */
    protected $maxLength = 255;

    /**
     * @var array
     */
    protected $jsConfig = array(
        'enableHighAccuracy' => true,
        'timeout' => 5000,
        'maximumAge' => 0
    );

    /**
     * @var array
     */
    protected $jsConfigOverrides = array(
        'inline' => true
    );

    /**
     * GeoLocationField constructor.
     * @param string $name
     * @param null $title
     * @param null $value
     * @param array $jsConfig
     */
    public function __construct($name, $title = null, $value = null, $jsConfig = array())
    {
        $this->jsConfig = array_merge($this->jsConfig, $jsConfig);
        parent::__construct($name, $title, $value);
    }


    /**
     * @return string
     */
    public function Type()
    {
        return 'geolocation text';
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return array_merge(
            parent::getAttributes(),
            array(
                'size' => $this->maxLength,
                'class' => 'text hidden geolocation'
            )
        );
    }


    /**
     * @return array
     */
    public function getJSConfig()
    {
        return $this->jsConfig;
    }


    /**
     * @param $key
     * @param $val
     * @return $this
     */
    public function setJSConfig($key, $val)
    {
        $this->jsConfig[$key] = $val;
        return $this;
    }



    public function getAccuracyLevel()
    {
        $values = explode(',', $this->Value());
        $accuracy = (int) @$values[2];

        if($accuracy == 0) {
            return 'missing';
        } else if($accuracy < 25) {
            return 'good';
        } else if($accuracy < 50) {
            return 'average';
        } else  {
            return 'bad';
        }
    }


    /**
     * @param array $properties
     * @return HTMLText
     */
    public function Field($properties = array())
    {
        // jQuery
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');

        // Entwine
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');

        // init script for this field
        Requirements::javascript(GEOLOCATIONFIELD_DIR . '/javascript/GeoLocationField.js');
        Requirements::css(GEOLOCATIONFIELD_DIR . '/css/GeoLocationField.css');

        Requirements::javascript(GEOLOCATIONFIELD_DIR . '/vendor/countdown/jquery.countdown360.min.js');
        $jsConfig = array_merge($this->jsConfig, $this->jsConfigOverrides);
        $id = $this->ID();
        $geoLocation = DBField::create_field('SS_GeoLocation', $this->Value(), 'GeoLocation');

        $latitude = $geoLocation->latitude;
        $longitude = $geoLocation->longitude;
        $accuracy = $geoLocation->accuracy;


        $data = array(
            'Path' => GEOLOCATIONFIELD_DIR,
            'JSConfig' => htmlspecialchars(json_encode($jsConfig)),
            'GeoLocation' => array(
                'Latitude' => $latitude,
                'Longitude' => $longitude,
                'Accuracy' => $accuracy,
            ),
            'Fields' => array(
                'Latitude' => NumericField::create($id . '_latitude', '', $latitude)->setReadonly(true)
                    ->addExtraClass('latitude'),
                'Longitude' => NumericField::create($id . '_longitude', '', $longitude)->setReadonly(true)
                    ->addExtraClass('longitude'),
                'Accuracy' => NumericField::create($id . '_accuracy', '', $accuracy)->setReadonly(true)
                    ->addExtraClass('accuracy'),

            )
        );
        return $this->customise($data)->renderWith('GeoLocationField');
    }
}
