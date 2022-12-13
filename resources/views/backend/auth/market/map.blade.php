@extends('backend.layouts.app')

@section('title', __('Market Map'))

@section('content')
    <div class="row">

        <div class="col-8">
            <x-backend.card>
                <x-slot name="header">
                    @lang('Market Map')
                </x-slot>



                <x-slot name="body">
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </x-slot>
            </x-backend.card>
        </div>
        <div class="col-4">
            <x-backend.card>
                <x-slot name="header">
                    @lang('Market Map')
                </x-slot>



                <x-slot name="body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($market->gambar as $i => $g)
                                <div class="carousel-item {{ $i === 0 ? 'active' : null }}">
                                    <img src="http://localhost:8000/gambar/{{ $g->doc }}" class="d-block w-100"
                                        alt="...">
                                </div>
                            @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <span style="font-size: 16px; font-weight: bold;">Nama Perusahaan : </span> <br>
                    <span>{{ $market->nama_perusahaan }}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Kecamatan : </span> <br>
                    <span>{{ $market->kecamatan->name }}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Tipe Market : </span> <br>
                    <span>{{ $market->tipe_market }}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Alamat : </span> <br>
                    <span>{{ $market->alamat }}</span><br>
                </x-slot>
            </x-backend.card>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var map;
        let market = {!! json_encode([$market]) !!};
        console.log(market);
        let dataShow = null;
        // var myOffcanvas = document.getElementById('dataShow')
        // var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)

        // const listGambar = document.getElementById('list-gambar');
        // const bodyData = document.getElementById('bodyData');


        window.onload = () => {
            app()
        }

        function app(position) {
            map = L.map('map', {
                // center: [-7.2162311, 107.8992377],
                zoom: 18
            });
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            }).addTo(map);


            let coords = market.map(e => [parseFloat(e.latitude), parseFloat(e.longitude)]);
            var bounds = L.latLngBounds();
            market.map(e => {
                let longitude = e.longitude;
                let latitude = e.latitude
                if (!((longitude).toString().indexOf("-") > -1)) {
                    longitude = "-" + longitude;
                }

                bounds.extend([parseFloat(longitude), parseFloat(latitude)])
                let iconOptions;

                switch (e.tipe_market) {
                    case "Alfamart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/alfamart.png',
                            iconSize: [80, 80]
                        };
                        break;
                    case "Indomaret":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/indomaret.png',
                            iconSize: [80, 80]
                        };
                        break;
                    case "Yomart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/yomart.png',
                            iconSize: [80, 80]
                        };
                        break;
                    case "Alfamidi":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/alfamidi.png',
                            iconSize: [80, 80]
                        };
                        break;
                    case "Lainnya":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/lainnya.png',
                            iconSize: [80, 80]
                        };
                        break;
                    case "Indomart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/indomaret.png',
                            iconSize: [80, 80]
                        };
                        break;
                }

                // Creating a custom icon
                var customIcon = L.icon(iconOptions);
                L.marker([longitude, latitude], {
                    icon: customIcon
                }).addTo(map).on('click', function() {
                    //     console.log(e);
                    //     listGambar.innerHTML = ''
                    //     let gambar = e.gambar;

                    //     if (gambar.length > 0) {
                    //         gambar.map((gmbr, i) => {
                    //             listGambar.innerHTML += `
                //         <div class="carousel-item ${i === 0 ? 'active' : null}">
                //             <img src="http://localhost:8000/gambar/${gmbr.doc}" class="d-block w-100" alt="...">
                //         </div>
                //         `
                    //         })
                    //     }
                    //     bodyData.innerHTML = `
                // <span style="font-size: 16px; font-weight: bold;">Nama Perusahaan : </span> <br>
                // <span>${e.nama_perusahaan}</span><br>
                // <span style="font-size: 16px; font-weight: bold;">Kecamatan : </span> <br>
                // <span>${e.kecamatan.name}</span><br>
                // <span style="font-size: 16px; font-weight: bold;">Tipe Market : </span> <br>
                // <span>${e.tipe_market}</span><br>
                // <span style="font-size: 16px; font-weight: bold;">Alamat : </span> <br>
                // <span>${e.alamat}</span><br>
                // `;
                    //     bsOffcanvas.toggle();

                });
            });
            console.log(bounds);
            map.fitBounds(bounds, {
                padding: [0, 0]
            });


        }
    </script>
@endsection
