<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    @stack('after-styles')
</head>

<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')

    @auth
    <div style="z-index: 999; position: absolute; width: 100vw; margin-top: 10px;">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="title">
                            <h5>SIG MARKET</h5>
                        </div>
                        <div class=" links">
                            @auth
                            @if ($logged_in_user->isUser())
                            <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                            @else
                            <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                            @endif

                            <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                            @else
                            <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                            @if (config('boilerplate.access.user.registration'))
                            <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                            @endif
                            @endauth
                            <button class="btn btn-primary rounded-full" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="offcanvas offcanvas-start z-index-4" tabindex="-1" id="dataShow" aria-labelledby="dataShowLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="dataShowLabel">Detail Market</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="list-gambar">
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="mt-2" id="bodyData">

            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start z-index-3" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Settings Map</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Tipe Market')</label>

                    <div class="col-md-10">
                        <select name="tipe_market" class="form-control">
                            <option value="">Pilih Tipe</option>
                            <option value="Alfamart">Alfamart</option>
                            <option value="Indomart">Indomart</option>
                            <option value="Yomart">Yomart</option>
                            <option value="Alfamidi">Alfamidi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan" class="col-md-2 col-form-label">@lang('Kecamatan')</label>
                    <div class="col-md-10">
                        <select name="id_kecamatan" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan as $kc) : ?>
                                <option value="{{$kc->id}}">{{$kc->name}}</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary float-right" type="submit">Filter</button>
            </form>
            <div class="dropdown mt-3">
                <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                    Tiles Type
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul> -->
            </div>
        </div>
    </div>
    <div id="map" style="width: 100vw; height: 100vh; position: absolute; top: 0px; left: 0px;"></div>

    @else
    <div id="app" class="flex-center position-ref height-full">
        <div class="top-right links">
            @auth
            @if ($logged_in_user->isUser())
            <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
            @else
            <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
            @endif

            <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
            @else
            <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

            @if (config('boilerplate.access.user.registration'))
            <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
            @endif
            @endauth
        </div>
        <!--top-right-->

        <div class="content">
            @include('includes.partials.messages')


            @auth

            @else
            <div class="title m-b-md">
                <h1>SIG MARKET</h1>
            </div>
            <!--title-->
            @endauth


        </div>
        <!--content-->
    </div>
    <!--app-->
    @endauth
    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @stack('after-scripts')
    <script>
        var map;
        let market = {!!json_encode($market) !!};
        let dataShow = null;
        var myOffcanvas = document.getElementById('dataShow')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)

        const listGambar = document.getElementById('list-gambar');
        const bodyData = document.getElementById('bodyData');


        window.onload = () => {
            app()
        }

        function app(position) {
            map = L.map('map', {
                center: [-7.2162311, 107.8992377],
                zoom: 18
            });
             L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);


            let coords = market.map(e => [parseFloat(e.longitude), parseFloat(e.latitude)]);
            market.map(e => {
                let longitude = e.longitude;
                let latitude = e.latitude
                if (!((longitude).toString().indexOf("-") > -1)) {
                    longitude = "-" + longitude;
                    console.log(longitude);
                }

                let iconOptions;

                switch (e.tipe_market) {
                    case "Alfamart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/alfamart.png',
                            iconSize: [50, 50]
                        };
                        break;
                    case "Indomaret":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/indomaret.png',
                            iconSize: [50, 50]
                        };
                        break;
                    case "Yomart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/yomart.png',
                            iconSize: [50, 50]
                        };
                        break;
                    case "Alfamidi":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/alfamidi.png',
                            iconSize: [50, 50]
                        };
                        break;
                    case "Lainnya":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/lainnya.png',
                            iconSize: [50, 50]
                        };
                        break;
                    case "Indomart":
                        iconOptions = {
                            iconUrl: 'http://localhost:8000/img/indomaret.png',
                            iconSize: [50, 50]
                        };
                        break;
                }

                console.log(e);
                // Creating a custom icon
                var customIcon = L.icon(iconOptions);
                L.marker([parseFloat(longitude), parseFloat(latitude)], {
                    icon: customIcon
                }).addTo(map).on('click', function() {
                    console.log(e);
                    listGambar.innerHTML = ''
                    let gambar = e.gambar;
                    if (gambar.length > 0) {
                        gambar.map((gmbr, i) => {
                            listGambar.innerHTML += `
                            <div class="carousel-item ${i === 0 ? 'active' : null}">
                                <img src="http://localhost:8000/gambar/${gmbr.doc}" class="d-block w-100" alt="...">
                            </div>
                            `
                        })
                    }
                    bodyData.innerHTML = `
                    <span style="font-size: 16px; font-weight: bold;">Nama Permohonan : </span> <br>
                    <span>${e.nama_permohonan}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Nama Perusahaan : </span> <br>
                    <span>${e.nama_perusahaan}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Kecamatan : </span> <br>
                    <span>${e.kecamatan.name}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Tipe Market : </span> <br>
                    <span>${e.tipe_market}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Alamat : </span> <br>
                    <span>${e.alamat}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Nomor Izin : </span> <br>
                    <span>${e.nomor_izin}</span><br>
                    <span style="font-size: 16px; font-weight: bold;">Tanggal Izin : </span> <br>
                    <span>${e.tanggal_izin}</span><br>
                    `;
                    bsOffcanvas.toggle();

                });
            });
            console.log(coords);
            // map.fitBounds(coords, {
            //     padding: [40, 40]
            // });

            // setTimeout(() => {
            //     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            //     }).addTo(map);
            // }, 2000)
        }
    </script>
</body>

</html>