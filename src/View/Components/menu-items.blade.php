@props(['menu' => 'main' ])
<?php

$menu = Config::get('menu.'.$menu);

$user = auth()->user();

if (empty($user)) {
    return;
}

?>
@foreach($menu as $one)
    <?php
    if (!empty($one['can']) && !$user->can($one['can'])) {
        continue;
    }
    if (!empty($one['debug']) && App::isProduction()) {
        continue;
    }
    ?>
    @if (!empty($one['submenu']))
        <x-menu-sub :title="__($one['title'])" :icon="$one['icon']">
        @foreach($one['submenu'] as $sub)
            <?php
            if (!empty($sub['can']) && !$user->can($sub['can'])) {
                continue;
            }
            if (!empty($one['debug']) && App::isProduction()) {
                continue;
            }
            ?>
            <x-menu-item :title="__($sub['title'])" :icon="$sub['icon']"  :link="$sub['link']" />
        @endforeach
    </x-menu-sub>
    @else
        <x-menu-item :title="__($one['title'])" :icon="$one['icon']"  :link="$one['link']" />
    @endif
@endforeach


