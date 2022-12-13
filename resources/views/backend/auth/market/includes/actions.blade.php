    <x-utils.edit-button :href="route('admin.auth.market.edit', $model)" />
    <x-utils.delete-button :href="route('admin.auth.market.destroy', $model)" />
    <x-utils.link :href="route('admin.auth.market.map', $model)" class="btn btn-success btn-sm" icon="fas fa-pencil-alt" :text="__('Lihat Map')" />
