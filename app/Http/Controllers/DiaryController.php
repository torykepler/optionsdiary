<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addSale(Request $request)
    {
        $input = $request->all();

        $result = (new SellOptionController())->store($request);

        return $result;
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function getSellOptions(Request $request)
    {
        $result = (new SellOptionController())->getSellOptions($request);

        return $result;
    }

    public function view(Request $request)
    {
        $sellOptions = $this->getSellOptions($request);

        return view('diary')->with('sellOptions', $sellOptions);
    }
}
