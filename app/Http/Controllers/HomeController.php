<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function city($name)
    {
        $data = File::exists(public_path('storage/'.$name.'-page-data.json')) ? json_decode(File::get(public_path('storage/'.$name.'-page-data.json'))) : [];

        return view('city', compact(
            'data',
            'name'
        ));
    }
}
