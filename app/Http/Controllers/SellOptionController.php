<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellOption;

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
     * Store a new sell option in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function getSellOptions(Request $request)
    {
        $sellOptions = SellOption::where('user_id', $request->user()->id)->get();

        return $sellOptions;
    }
}
