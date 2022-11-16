@extends('backend.layouts.app')

@section('title', __('Market Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Market Management')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.market.create')"
                :text="__('Create Market')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.market-table />
        </x-slot>
    </x-backend.card>
@endsection
