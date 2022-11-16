@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Kecamatan'))

@section('content')
    <x-forms.post :action="route('admin.auth.kecamatan.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Kecamatan')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.kecamatan.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                   

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                        </div>
                    </div>

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Kecamatan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
