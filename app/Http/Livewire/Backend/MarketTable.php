<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Role;
use App\Models\DataMarket;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class RolesTable.
 */
class MarketTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return DataMarket::with('kecamatan')
            ->when($this->getFilter('kecamatan'), fn ($query, $term) => $query->where('id_kecamatan', $term))
            ->when($this->getFilter('tipe_market'), fn ($query, $term) => $query->where('tipe_market', $term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Nama Permohonan'), 'nama_permohonan')
                ->sortable()->searchable(),
            Column::make(__('Nama Perusahaan'), 'nama_perusahaan')
                ->sortable()->searchable(),
            Column::make(__('Kecamatan'), 'market.kecamatan.name'),
            Column::make(__('Tipe'), 'tipe_market')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];


    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            // return (new UserExport($this->selectedRowsQuery))->download($this->tableName.'.xlsx');
        }

        // Not included in package, just an example.
    }


    public function filters(): array
    {
        return [
            'kecamatan' => Filter::make('Kecamatan')
                ->select($this->getKecamatan()),
            'tipe_market' => Filter::make('Tipe Market')
                ->select([
                    '' => 'Semua',
                    'Alfamart' => 'Alfamart',
                    'Indomart' => 'Indomart',
                    'Yomart' => 'Yomart',
                    'Alfamidi' => 'Alfamidi',
                    'Lainnya' => 'Lainnya',
                ]),


        ];
    }

    public function getKecamatan()
    {
        $kecamatan = Kecamatan::all();
        $temp = [];
        $temp[] = "Semua";
        foreach ($kecamatan as $kc) {
            $temp[$kc->id] = $kc->name;
        }

        return $temp;
    }

    public function rowView(): string
    {
        return 'backend.auth.market.includes.row';
    }
}
