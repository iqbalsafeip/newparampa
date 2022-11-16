@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-frontend.card>
                <x-slot name="header">
                    @lang('Dashboard')
                </x-slot>

                <x-slot name="body">
                    <div id="map" style="width: 100%; height: 40vh;"></div>
                </x-slot>
            </x-frontend.card>
        </div>
        <!--col-md-10-->
    </div>
    <!--row-->
</div>
<!--container-->
@endsection

@section('script')
<script>
    var map = L.map('map', {
        center: [51.505, -0.09],
        zoom: 13
    });

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);
</script>
@endsection