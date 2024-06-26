<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    const TITLE = 'title';
    const CATEGORIES = 'categories';
    const SIZES = 'sizes';
    const PRICES = 'prices';
    const SORT_METHOD = 'sort_method';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CATEGORIES => [$this, 'categories'],
            self::SIZES => [$this, 'sizes'],
            self::PRICES => [$this, 'prices'],
            self::SORT_METHOD => [$this, 'sort'],
        ];
    }

    protected function title(Builder $builder, $value): void
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    protected function categories(Builder $builder, $value): void
    {
        $builder->whereIn('category_id', $value);
    }

    protected function sizes(Builder $builder, $value): void
    {
        $builder->whereHas('sizes', function ($b) use ($value) {
            $b->whereIn('size_id', $value);
        });
    }

    protected function prices(Builder $builder, $value): void
    {
        $builder->whereBetween('price', $value);
    }

    protected function sort(Builder $builder, $value): void
    {
        $array = explode('-', $value);
        $column = $array[0];
        $method = $array[1];

        $builder
            ->orderBy($column, $method)
            ->get();
    }
}
