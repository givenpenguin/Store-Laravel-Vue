<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    const CATEGORIES = 'categories';
    const SIZES = 'sizes';
    const PRICE = 'price';

    protected function getCallbacks()
    {
//        [
//            self::CATEGORIES => [$this, 'categories'],
//            self::SIZES => [$this, 'sizes'],
//            self::PRICE => [$this, 'price'],
//        ];
    }

    protected function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    protected function sizes(Builder $builder, $value)
    {
        $builder->whereIn('size_id', $value);
    }

    protected function price(Builder $builder, $value)
    {
        $builder->whereBetween($value['from'], $value['to']);
    }
}
