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

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function getSellOptionsGroupedByTicker(Request $request)
    {
        $result = (new SellOptionController())->getSellOptionsGroupedByTicker($request);

        return $result;
    }

    public function view(Request $request)
    {
        $data = new \stdClass();

        $sellOptions = $this->getSellOptions($request);
        $sellOptionsGroupedByTicker = $this->getSellOptionsGroupedByTicker($request);
        $totals = $this->calculateSaleTotals($sellOptions);

        $data->sellOptions = $sellOptions;
        $data->sellOptionsGroupedByTicker = $sellOptionsGroupedByTicker;
        $data->totals = $totals;

        return view('diary')->with('data', $data);
    }

    private function calculateSaleTotals(\Illuminate\Database\Eloquent\Collection $sellOptions)
    {
        $data = new \stdClass();
        $data->totalPremium = 0;
        $data->totalProfit = 0;
        $data->totalFees = 0;
        $data->totalQuantity = 0;
        $data->totalExitPrice = 0;

        foreach($sellOptions as $sellOption)
        {
            $data->totalPremium += $sellOption->premium * $sellOption->quantity;
            $data->totalProfit += $sellOption->profit;
            $data->totalFees += $sellOption->fees;
            $data->totalQuantity += $sellOption->quantity;
            $data->totalExitPrice += $sellOption->exit_price;
        }

        return $data;
    }
}
