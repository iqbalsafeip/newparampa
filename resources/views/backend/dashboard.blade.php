@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Total Market by Kecamatan
        </x-slot>

        <x-slot name="body">
            <div class="row">
                @foreach ($kecamatan as $index => $kc)
                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-primary shadow  p-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $kc->name }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total : {{ $kc->total }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <button class="btn" type="button" data-toggle="collapse"
                                    data-target="#collapse-{{ $index }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $index }}">
                                    Detail
                                </button>
                                <div class="collapse mt-2" id="collapse-{{ $index }}">
                                    <ul class="list-group">
                                        @foreach ($kc->market as $mk)
                                            <li class="list-group-item">{{ $mk->tipe_market }} : {{ $mk->total }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-backend.card>
    <x-backend.card>
        <x-slot name="header">
            Total Market by Perusahaan
        </x-slot>

        <x-slot name="body">
            <div class="row">
                @foreach ($type as $index => $kc)
                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-primary shadow  p-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $kc->tipe_market }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total : {{ $kc->total }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-market fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-backend.card>
@endsection
