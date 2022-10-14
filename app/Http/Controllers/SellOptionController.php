<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellOption;
use Illuminate\Support\Facades\DB;

class SellOptionController extends Controller
{
    /**
     * Store a new sell option in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        $sellOption = new SellOption;

        $sellOption->ticker = strtoupper($request->ticker);
        $sellOption->user_id = $request->user()->id;
        $sellOption->open_date = $request->open_date;
        $sellOption->exp_date = $request->exp_date;
        $sellOption->close_date = $request->close_date ?? null;
        $sellOption->type = $request->type;
        $sellOption->strike = $request->strike;
        $sellOption->premium = $request->premium;
        $sellOption->exit_price = $request->exit_price ?? null;
        $sellOption->fees = $request->fees;
        $sellOption->quantity = $request->quantity;

        return $sellOption->save();
    }

    /**
     * Delete sell option from the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function deleteSellOption(Request $request): bool
    {
        return SellOption::where('id', $request->id)
            ->where('user_id', $request->user()->id)
            ->delete();
    }

    /**
     * Retrieve sell options by user id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function getSellOptions(Request $request)
    {
        $sellOptions = SellOption::where('user_id', $request->user()->id)->orderBy('open_date', 'asc')->orderBy('id', 'asc')->get();

        return $sellOptions;
    }

    /**
     * Retrieve sell options by user id grouped by ticker
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function getSellOptionsGroupedByTicker(Request $request)
    {
        $sellOptions = DB::table('sell_options') ->selectRaw('id, ticker, SUM(quantity) AS quantity, SUM((premium - exit_price) * 100 - fees) AS profit')->where('user_id', $request->user()->id)->groupBy('ticker')->orderBy('ticker', 'asc')->get();

        return $sellOptions;
    }
}
