<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    const TITLE = 'title';
    const CATEGORIES = 'categories';
    const SIZES = 'sizes';
    const PRICES = 'prices';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CATEGORIES => [$this, 'categories'],
            self::SIZES => [$this, 'sizes'],
            self::PRICES => [$this, 'prices'],
        ];
    }

    protected function title(Builder $builder, $value)
    {
        $builder->whereIn($value['from'], 'like', "%{$value['to']}%");
    }

    protected function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    protected function sizes(Builder $builder, $value)
    {
        $builder->whereHas('sizes', function ($b) use ($value) {
            $b->whereIn('size_id', $value);
        });
    }

    protected function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price', $value);
    }
}
