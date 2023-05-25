@props(['trigger'])

<div x-data='{ show: false}' @click.away='show = false'>
    <div @click='show = ! show'>
        {{ $trigger }}
    </div>
    <div x-show="show" class="py-2 absolute overflow-auto max-h-40">
        {{ $slot }}
    </div>
</div>