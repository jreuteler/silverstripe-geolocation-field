<input $AttributesHTML data-config="$JSConfig"/>

<!-- controls.proxy -->
$Controls.Proxy
<div class="geoLocationFieldPreview">
    <!--
     // TODO: implement/add map-preview
    -->
</div>
<img src="{$Path}/images/update_position_icon.png" alt="Refresh Position" width="32" height="32" class="geolocation action refresh"/>


    <div class="geolocation fields">
        <div class="third">
            <label class="left" for="$Fields.Latitude.ID">Latitude</label> $Fields.Latitude
        </div>
        <div class="third">
            <label class="left" for="$Fields.Longitude.ID">Longitude</label> $Fields.Longitude
        </div>
        <div class="third">
            <label class="left" for="$Fields.Accuracy.ID">Accuracy</label> $Fields.Accuracy
        </div>
    </div>
