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
     * @param  Request $request
     * @return bool
     */
    public function addSale(Request $request) : bool
    {
        $input = $request->all();

        $result = (new SellOptionController())->store($request);

        return $result;
    }

    /**
     *
     * @param  Request $request
     * @return bool
     */
    public function deleteSale(Request $request) : bool
    {
        $result = (new SellOptionController())->deleteSellOption($request);

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
