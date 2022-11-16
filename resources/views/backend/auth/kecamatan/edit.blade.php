@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Kecamatan'))

@section('content')
    <x-forms.patch :action="route('admin.auth.kecamatan.update', $kecamatan)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Kecamatan')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.kecamatan.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $kecamatan->type }}'}">
                    

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text"  name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $kecamatan->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Kecamatan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
