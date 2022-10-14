<?php

namespace App\Http\Controllers;

use App\Models\SellOption;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

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
     * Add an option sale
     *
     * @param  Request $request
     * @return bool
     */
    public function addSale(Request $request) : bool
    {
        return (new SellOptionController())->store($request);
    }

    /**
     * Delete an existing option sale
     *
     * @param  Request $request
     * @return bool
     */
    public function deleteSale(Request $request) : bool
    {
          return (new SellOptionController())->deleteSellOption($request);
    }

    /**
     * Get all sell options for the
     *
     * @param Request $request
     * @return SellOption[]
     */
    public function getSellOptions(Request $request)
    {
        return (new SellOptionController())->getSellOptions($request);
    }

    /**
     * Get all sell options grouped by the ticker
     *
     * @param Request $request
     * @return Collection
     */
    public function getSellOptionsGroupedByTicker(Request $request)
    {
        return (new SellOptionController())->getSellOptionsGroupedByTicker($request);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function view(Request $request)
    {
        $data = new stdClass();

        $sellOptions = $this->getSellOptions($request);
        $sellOptionsGroupedByTicker = $this->getSellOptionsGroupedByTicker($request);
        $totals = $this->calculateSaleTotals($sellOptions);

        $data->sellOptions = $sellOptions;
        $data->sellOptionsGroupedByTicker = $sellOptionsGroupedByTicker;
        $data->totals = $totals;

        return view('diary')->with('data', $data);
    }

    /**
     * Calculates the total premium, total profit, total fees, total quantity and total exit price
     * @param \Illuminate\Database\Eloquent\Collection|SellOption[] $sellOptions
     * @return stdClass
     */
    private function calculateSaleTotals(\Illuminate\Database\Eloquent\Collection|array $sellOptions)
    {
        $data = new stdClass();
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
