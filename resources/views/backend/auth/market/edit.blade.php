@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Market'))

@section('content')
    <x-forms.patch :action="route('admin.auth.market.update', $market)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Market')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.market.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="kecamatan" class="col-md-2 col-form-label">@lang('Kecamatan')</label>
                    <div class="col-md-10">
                        <select name="id_kecamatan" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan as $kc) : ?>
                            <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!--form-group-->
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Nama Permohonan')</label>

                    <div class="col-md-10">
                        <input type="text" name="nama_permohonan" class="form-control"
                            placeholder="{{ __('Nama Permohonan') }}" value="{{ $market->nama_permohonan }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Nama Perusahaan')</label>

                    <div class="col-md-10">
                        <input type="text" name="nama_perusahaan" class="form-control"
                            placeholder="{{ __('Nama Perusahaan') }}" value="{{ $market->nama_perusahaan }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Alamat')</label>

                    <div class="col-md-10">
                        <input type="text" name="alamat" class="form-control" placeholder="{{ __('Alamat') }}"
                            value="{{ $market->alamat }}" multiline></input>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Nomor Izin')</label>

                    <div class="col-md-10">
                        <input type="text" name="nomor_izin" class="form-control" placeholder="{{ __('Nomor Izin') }}"
                            value="{{ $market->nomor_izin }}" multiline></input>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Tanggal Izin')</label>

                    <div class="col-md-10">
                        <input type="text" name="tanggal_izin" class="form-control"
                            placeholder="{{ __('Tanggal Izin') }}" value="{{ $market->tanggal_izin }}" multiline></input>
                    </div>
                </div>
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
                <!--form-group-->

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Gambar')</label>

                    <div class="col-md-10">
                        <input type="file" name="gambar[]" class="form-control" placeholder="{{ __('Gambar') }}"
                            multiple />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Longitude')</label>

                    <div class="col-md-10">
                        <input type="text" name="longitude" class="form-control" placeholder="{{ __('Longitude') }}"
                            value="{{ $market->longitude }}" multiline></input>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Latitude')</label>

                    <div class="col-md-10">
                        <input type="text" name="latitude" class="form-control" placeholder="{{ __('Latitude') }}"
                            value="{{ $market->latitude }}" multiline></input>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Market')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
