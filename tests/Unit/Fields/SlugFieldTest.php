<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Fields\Text;

uses()->group('fields');

beforeEach(function (): void {
    $this->field = Slug::make('Slug')
        ->from('title')
        ->separator('-');
    $this->item = new class () extends Model {
        public string $title = 'Title';
        public string $slug = 'title';
    };

    fillFromModel($this->field, $this->item);
});

it('type', function (): void {
    expect($this->field->getAttributes()->get('type'))
        ->toBe('text');
});

it('text is parent', function (): void {
    expect($this->field)
        ->toBeInstanceOf(Text::class);
});

it('view', function (): void {
    expect($this->field->getView())
        ->toBe('moonshine::fields.input');
});

it('apply', function (): void {
    $this->item->title = 'Hello world';

    expect($this->field->apply(static fn () => null, $this->item))
        ->slug
        ->toBe('hello-world')
        ->and($this->field->separator('_')->apply(static fn () => null, $this->item))
            ->slug
            ->toBe('hello_world')
    ;
});
