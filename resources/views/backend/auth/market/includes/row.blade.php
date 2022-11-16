<x-livewire-tables::bs4.table.cell>
    {{ $row->nama_permohonan }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->nama_perusahaan }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->kecamatan->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->tipe_market }}
</x-livewire-tables::bs4.table.cell>



<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.market.includes.actions', ['model' => $row])
</x-livewire-tables::bs4.table.cell>
