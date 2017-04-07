<input $AttributesHTML data-config="$JSConfig"/>

<!-- controls.proxy -->
$Controls.Proxy
<div class="geoLocationFieldPreview">
    <!--
     // TODO: implement/add map-preview
    -->
</div>
<div class="geoLocationFieldControls field dropdown text">

    <div class="geoLocation">
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
    <a href="/gps_testing_02/new-test-page#" class="refresh">Refresh Position</a>
</div>