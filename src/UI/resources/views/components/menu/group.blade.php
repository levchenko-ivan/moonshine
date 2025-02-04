@props([
    'label' => '',
    'previewLabel' => '',
    'icon' => '',
    'items' => [],
    'isActive' => false,
    'top' => false,
])
<li {{ $attributes->class(['menu-inner-item']) }}
    @if($top)
        x-data="{ dropdown: false }"
        @click.outside="dropdown = false"
        data-dropdown-placement="bottom-start"
        x-ref="dropdownMenu"
    @else
        x-data="{ dropdown: {{ $isActive ? 'true' : 'false' }} }"
        x-ref="dropdownMenu"
    @endif
>
    <button
        x-data="navTooltip"
        @mouseenter="toggleTooltip()"
        @click.prevent="dropdown = ! dropdown; $nextTick(() => { if (dropdown && $refs.dropdownMenu) $refs.dropdownMenu.scrollIntoView({ behavior: 'smooth' }); })"
        class="menu-inner-button"
        :class="dropdown && '_is-active'"
        type="button"
    >
        @if($icon)
            {!! $icon !!}
        @elseif(!$top)
            <span class="menu-inner-item-char">
                {{ $previewLabel }}
            </span>
        @endif

        <span class="menu-inner-text">{{ $label }}</span>
        <span class="menu-inner-arrow">
            <x-moonshine::icon
                icon="chevron-down"
                size="6"
                color="gray"
            />
        </span>
    </button>

    @if($items)
        <x-moonshine::menu
            :dropdown="true"
            :items="$items"
            x-transition.top=""
            style="display: none"
            x-show="dropdown"
        />
    @endif
</li>
