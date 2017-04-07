<?php

/**
 * Class SS_GeoLocation
 */
class SS_GeoLocation extends DBField
{
    /**
     * @var
     */
    protected $latitude;
    /**
     * @var
     */
    protected $longitude;
    /**
     * @var
     */
    protected $accuracy;


    /**
     * SS_GeoLocation constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        $this->defaultVal = ',,';
        parent::__construct($name);
    }


    /**
     *
     */
    public function requireField()
    {
        $parts = array(
            'datatype' => 'varchar',
            'precision' => 255,
            'character set' => 'utf8',
            'collate' => 'utf8_general_ci',
            'arrayValue' => $this->arrayValue
        );

        $values = array(
            'type' => 'varchar',
            'parts' => $parts
        );

        // Add support for both SS DB API 3.2 and <3.2
        if (method_exists('DB', 'require_field')) {
            DB::require_field($this->tableName, $this->name, $values);
        } else {
            DB::requireField($this->tableName, $this->name, $values);
        }
    }


    /**
     * @param null $title
     * @return GeoLocationField
     */
    public function scaffoldFormField($title = null)
    {
        $field = new GeoLocationField($this->name, $title);

        return $field;
    }


    /**
     * @return null
     */
    public function nullValue()
    {
        return null;
    }


    /**
     * @param $value
     * @return string
     */
    protected function formatValue($value)
    {
        $val = $value;

        if ($val === null || $val === '' || $val === 0) {
            $val = $this->defaultVal;
        }

        return $val;
    }


    /**
     * @param mixed $value
     * @param null $record
     */
    public function setValue($value, $record = null)
    {
        $this->value = $value;
        $values = explode(',', $value);
        $this->latitude = @$values[0];
        $this->longitude = @$values[1];
        $this->accuracy = @$values[2];
    }


    /**
     *
     */
    protected function syncValue()
    {
        $this->value = $this->latitude . ',' . $this->longitude . ',' . $this->accuracy;
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function extractLatitude($value)
    {
        $values = explode(',', $value);
        return $values[0];
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function extractLongitude($value)
    {
        $values = explode(',', $value);
        return $values[1];
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function extractAccuracy($value)
    {
        $values = explode(',', $value);
        return $values[2];
    }

    /**
     * @param $latidude
     * @return $this
     */
    public function setLatitude($latidude)
    {
        $this->latitude = $latidude;
        $this->syncValue();
        return $this;
    }

    /**
     * @return mixed
     */
    public function Latitude()
    {
        return $this->latitude;
    }


    /**
     * @param $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        $this->syncValue();
        return $this;
    }

    /**
     * @return mixed
     */
    public function Longitude()
    {
        return $this->longitude;
    }


    /**
     * @param $accuracy
     * @return $this
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;
        $this->syncValue();
        return $this;
    }

    /**
     * @return mixed
     */
    public function Accuracy()
    {
        return $this->accuracy;
    }

}