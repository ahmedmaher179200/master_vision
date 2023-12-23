@php
    if(!isset($showInput))
        $showInput = "true";
@endphp

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
<style>  
    .map {
        height: 300px;
        width: 100%;
    }
</style>

<div class="row">
    <div class="col-lg-12" style="z-index: 20;margin-bottom: 12px;">
        <label>{{$label}}</label>
        <div id="{{$name}}" class="map">
        </div> 
    </div>
    @if ($showInput == "true")
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control {{$latName}}" attribute="required readonly"
                    name="{{$latName}}" value="{{$latValue}}"
                    label="{{ trans('admin.Latitude') }}"/>
        </div>
        <br>
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control {{$longName}}" attribute="required readonly"
                    name="{{$longName}}" value="{{$longValue}}"
                    label="{{ trans('admin.Longitude') }}"/>
        </div>
    @endif
</div>


<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<script>
    var current = [{{$latValue}}, {{$longValue}}];
    //change
    $(document).ready(init);

    function init() {
    var mymap = L.map('{{$name}}').setView(current, 8),
    latSpan = $('.{{$latName}}'),
    lonSpan = $('.{{$longName}}');

    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c']
    }).addTo( mymap );

    var marker = L.marker(current).addTo(mymap);

    mymap.on('click', function(e) {
    lonSpan.val(e.latlng.lng)
    latSpan.val(e.latlng.lat)
    
    marker.setLatLng(e.latlng)
    });
    }
</script>

{{-- example
<x-form.map label="map" name="name2" showInput="true"
    latName="lat" longName="long"
    latValue="22" longValue="33"/> --}}
