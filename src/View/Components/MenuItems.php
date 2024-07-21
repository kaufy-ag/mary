<?php

namespace Mary\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class MenuItems extends Component
{
    public string $uuid;
    public array $menu_items = [];

    public function __construct(
        public string $menu = 'main'
    )
    {
        $user = auth()->user();

        $this->uuid = "mary" . md5(serialize($this));
        $this->menu_items = empty($user)
            ? []
            : config('menu.' . $menu);

        foreach ($this->menu_items as $index => $one) {
            if (!empty($one['can']) && !$user->can($one['can'])) {
                unset($this->menu_items[$index]);
                continue;
            }
            if (!empty($one['debug']) && app()->isProduction()) {
                unset($this->menu_items[$index]);
                continue;
            }

            if (!empty($one['submenu'])) {
                foreach ($one['submenu'] as $sindex => $sub) {
                    if (!empty($sub['can']) && !$user->can($sub['can'])) {
                        unset($this->menu_items[$index][$sindex]);
                        continue;
                    }
                    if (!empty($one['debug']) && app()->isProduction()) {
                        unset($this->menu_items[$index][$sindex]);
                        continue;
                    }
                }

                if (empty($this->menu_items[$index]['submenu'])) {
                    unset($this->menu_items[$index]);
                    continue;
                }
            }
        }
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'

    @foreach($menu_items as $one)
    
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
    HTML;
    }
}


