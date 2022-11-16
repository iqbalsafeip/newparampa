@extends('backend.layouts.app')

@section('title', __('Kecamatan Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Kecamatan Management')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.kecamatan.create')"
                :text="__('Create Kecamatan')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.kecamatan-table />
        </x-slot>
    </x-backend.card>
@endsection
