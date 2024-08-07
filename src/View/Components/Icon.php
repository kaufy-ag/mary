<?php

namespace Mary\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Icon extends Component
{
    public string $uuid;

    public function __construct(
        public string $name,
        public ?string $label = null
    ) {
        $this->uuid = "mary" . md5(serialize($this));
    }

    public function icon(): string
    {
        $name = Str::of($this->name);

        return $name->contains('.') ? $name->replace('.', '-') : "heroicon-$this->name";
    }

    public function labelClasses(): ?string
    {
        // Remove `w-*` and `h-*` classes, because it applies only for icon
        return Str::replaceMatches('/(w-\w*)|(h-\w*)/', '', $this->attributes->get('class') ?? '');
    }

    public function render(): View|Closure|string
    {
        $name = Str::of($this->name);

        $is_hero_icon = strlen($name) >= 2 && $name[0] == 'o' && $name[1] == '-';;

        $icon = $this->icon();

        if ($is_hero_icon) {
            return <<<'HTML'
                @if(strlen($label ?? '') > 0)
                    <div class="inline-flex items-center gap-1">
                @endif
                <x-svg
                    :name="$icon()"
                    {{
                        $attributes->class([
                            'inline',
                            'w-5 h-5' => !Str::contains($attributes->get('class') ?? '', ['w-', 'h-'])
                        ])
                     }}
                />
        
                @if(strlen($label ?? '') > 0)
                        <div class="{{ $labelClasses() }}">
                            {{ $label }}
                        </div>
                    </div>
                @endif
            HTML;
        }
        else {
            return <<<'HTML'
                @if(strlen($label ?? '') > 0)
                    <div class="inline-flex items-center gap-1">
                @endif
                
                <i 
                    {{
                        $attributes->class([
                            ($attributes->has('button') ? 'fa-regular' : 'fa-sharp-duotone') . ' ' .$name . ' duotone-colors',
                            'fa-lg' => !Str::contains($attributes->get('class') ?? '', ['fa-'])
                        ])
                     }}
                 ></i>
        
                @if(strlen($label ?? '') > 0)
                        <div class="{{ $labelClasses() }}">
                            {{ $label }}
                        </div>
                    </div>
                @endif    
            HTML;
        }

    }
}
