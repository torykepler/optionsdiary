<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellOption;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SellOptionController extends Controller
{
    /**
     * Store a new sell option in the database.
     *
     * @param  Request  $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        $sellOption = new SellOption;

        $sellOption->ticker = strtoupper($request->input('ticker'));
        $sellOption->user_id = $request->user()->id;
        $sellOption->open_date = $request->input('open_date');
        $sellOption->exp_date = $request->input('exp_date');
        $sellOption->close_date = $request->input('close_date') ?? null;
        $sellOption->type = $request->input('type');
        $sellOption->strike = $request->input('strike');
        $sellOption->premium = $request->input('premium');
        $sellOption->exit_price = $request->input('exit_price') ?? null;
        $sellOption->fees = $request->input('fees');
        $sellOption->quantity = $request->input('quantity');

        return $sellOption->save();
    }

    /**
     * Delete sell option from the database.
     *
     * @param  Request  $request
     * @return bool
     */
    public function deleteSellOption(Request $request): bool
    {
        return SellOption::where('id', $request->input('id'))
            ->where('user_id', $request->user()->id)
            ->delete();
    }

    /**
     * Retrieve sell options by user id
     *
     * @param  Request  $request
     * @return SellOption[]
     */
    public function getSellOptions(Request $request)
    {
        return SellOption::where('user_id', $request->user()->id)->orderBy('open_date')->orderBy('id')->get();
    }

    /**
     * Retrieve sell options by user id grouped by ticker
     *
     * @param Request $request
     * @return Collection
     */
    public function getSellOptionsGroupedByTicker(Request $request)
    {
        return DB::table('sell_options')
            ->selectRaw('id, ticker, SUM(quantity) AS quantity, SUM((premium - exit_price) * 100 - fees) AS profit')
            ->where('user_id', $request->user()->id)
            ->groupBy('ticker')
            ->orderBy('ticker')
            ->get();
    }
}
