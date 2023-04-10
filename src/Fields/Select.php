<?php

declare(strict_types=1);

namespace MoonShine\Fields;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Traits\Fields\CanBeMultiple;
use MoonShine\Traits\Fields\Searchable;
use MoonShine\Traits\Fields\SelectTrait;

class Select extends Field
{
    use CanBeMultiple;
    use Searchable;
    use SelectTrait;

    protected static string $view = 'moonshine::fields.select';

    public function indexViewValue(Model $item, bool $container = true): string
    {
        return (string)(
            $this->values()[$item->{$this->field()}]
            ?? parent::indexViewValue($item, $container)
        );
    }
}
