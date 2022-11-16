@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Market'))

@section('content')
<x-forms.post :action="route('admin.auth.market.store')" enctype="multipart/form-data" >
    <x-backend.card>
        <x-slot name="header">
            @lang('Create Market')
        </x-slot>


        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.market.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">
            <div class="form-group row">
                <label for="kecamatan" class="col-md-2 col-form-label">@lang('Kecamatan')</label>
                <div class="col-md-10">
                    <select name="id_kecamatan" class="form-control" required>
                        <option value="">Pilih Kecamatan</option>
                        <?php foreach ($kecamatan as $kc) : ?>
                            <option value="{{$kc->id}}">{{$kc->name}}</option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <!--form-group-->
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Nama Permohonan')</label>

                <div class="col-md-10">
                    <input type="text" name="nama_permohonan" class="form-control" placeholder="{{ __('Nama Permohonan') }}" value="{{ old('nama_permohonan') }}" required />
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Nama Perusahaan')</label>

                <div class="col-md-10">
                    <input type="text" name="nama_perusahaan" class="form-control" placeholder="{{ __('Nama Perusahaan') }}" value="{{ old('nama_perusahaan') }}" required />
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Alamat')</label>

                <div class="col-md-10">
                    <textarea type="text" name="alamat" class="form-control" placeholder="{{ __('Alamat') }}" value="{{ old('alamat') }}" multiline required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Nomor Izin')</label>

                <div class="col-md-10">
                    <textarea type="text" name="nomor_izin" class="form-control" placeholder="{{ __('Nomor Izin') }}" value="{{ old('nomor_izin') }}" multiline required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Tanggal Izin')</label>

                <div class="col-md-10">
                    <textarea type="text" name="tanggal_izin" class="form-control" placeholder="{{ __('Tanggal Izin') }}" value="{{ old('tanggal_izin') }}" multiline required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Tipe Market')</label>

                <div class="col-md-10">
                    <select name="tipe_market" class="form-control" required>
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
                    <input type="file" name="gambar[]" class="form-control" placeholder="{{ __('Gambar') }}" value="{{ old('gambar[]') }}" multiple />
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Longitude')</label>

                <div class="col-md-10">
                    <textarea type="text" name="longitude" class="form-control" placeholder="{{ __('Longitude') }}" value="{{ old('longitude') }}" multiline required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">@lang('Latitude')</label>

                <div class="col-md-10">
                    <textarea type="text" name="latitude" class="form-control" placeholder="{{ __('Latitude') }}" value="{{ old('latitude') }}" multiline required></textarea>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Market')</button>
        </x-slot>
    </x-backend.card>
</x-forms.post>
@endsection