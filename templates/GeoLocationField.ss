<input $AttributesHTML data-config="$JSConfig"/>

<!-- controls.proxy -->
$Controls.Proxy
<div class="geoLocationFieldPreview">
    <!--
     // TODO: implement/add map-preview
    -->
</div>


    <div class="geolocation fields">
        <div class="third latitude">
            <label class="left full" for="$Fields.Latitude.ID">Latitude</label>
            <label class="left mobile" for="$Fields.Latitude.ID">Lat</label>
            $Fields.Latitude
        </div>
        <div class="third longitude">
            <label class="left full" for="$Fields.Longitude.ID">Longitude</label>
            <label class="left mobile" for="$Fields.Longitude.ID">Lon</label>
            $Fields.Longitude
        </div>
        <div class="third accuracy">
            <label class="left full" for="$Fields.Accuracy.ID">Accuracy</label>
            <span class="value $AccuracyLevel" alt="Accuracy: {$Fields.Accuracy.Value}m"></span>
            $Fields.Accuracy
        </div>
    </div>
<img src="{$Path}/images/update_position_icon.png" alt="Refresh Position" width="32" height="32" class="geolocation action refresh"/>
