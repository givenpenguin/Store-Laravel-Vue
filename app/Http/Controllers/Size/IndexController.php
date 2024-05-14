<?php

namespace App\Http\Controllers\Size;

use App\Http\Controllers\Controller;
use App\Models\Size;

class IndexController extends Controller
{
    public function __invoke()
    {
        $sizes = Size::paginate(20);

        return view('size.index', compact('sizes'));
    }
}
