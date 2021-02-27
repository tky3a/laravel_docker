<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Test;

class TestController extends Controller
{
    //
    public function index()
    {
        // モデルから直接取得
        $values = Test::all();

        // クエリで取得
        $tests = DB::table('tests')->select('id')->where('id', '<>', 1)->get();

        dump($tests);

        // compact("values")で$valuesをviewに渡す
        return view('tests.test', compact("values"));
    }
}
