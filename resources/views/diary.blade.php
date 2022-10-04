@extends('layouts.app')

@section('content')
    <head>
        <script type="text/javascript" src="js/diary.js"></script>
        <link href="css/diary.css" rel="stylesheet">
        <title>Options Diary</title>
    </head>
<div class="container">
    <table class="table" id="diary-table">
        <thead>
            <tr>
                <th scope="col">Ticker</th>
                <th scope="col">Type</th>
                <th scope="col">Open Date</th>
                <th scope="col">Exp Date</th>
                <th scope="col">Close Date</th>
                <th scope="col">Strike</th>
                <th scope="col">Premium</th>
                <th scope="col">Fees</th>
                <th scope="col">Exit Price</th>
                <th scope="col">Qty</th>
            </tr>
        </thead>
        @foreach($sellOptions as $sellOption)
            <tr>
                <td>{{ $sellOption->ticker }}</td>
                <td>{{ $sellOption->type }}</td>
                <td>{{ $sellOption->open_date }}</td>
                <td>{{ $sellOption->exp_date }}</td>
                <td>{{ $sellOption->close_date }}</td>
                <td>{{ $sellOption->strike }}</td>
                <td>{{ $sellOption->premium }}</td>
                <td>{{ $sellOption->fees }}</td>
                <td>{{ $sellOption->exit_price }}</td>
                <td>{{ $sellOption->quantity }}</td>
            </tr>


        @endforeach
    </table>
    <button class="btn btn-dark" id="add-sale">Add Sale</button>
</div>

    <div id="add-modal" class="d-flex justify-content-center">
        <form id="add-sale-form" action=" {{route('add-sale')}}">
            @csrf
            <div class="row mb-3">
                <label for="ticker" class="col-md-2 col-form-label text-md-end">{{ __('Ticker') }}</label>

                <div class="col-md-4">
                    <input id="ticker" type="text" class="form-control" name="ticker" required autofocus>
                </div>

                <label for="premium" class="col-md-2 col-form-label text-md-end">{{ __('Premium') }}</label>

                <div class="col-md-4">
                    <input id="premium" type="number" step="0.01" class="form-control" name="premium" required>
                </div>

            </div>
            <div class="row mb-3">
                <label for="type" class="col-md-2 col-form-label text-md-end">{{ __('Type') }}</label>

                <div class="col-md-4">
                    <select id="type" name="type" class="form-select">
                        <option value="call">Call</option>
                        <option value="put">Put</option>
                    </select>
                </div>

                <label for="strike" class="col-md-2 col-form-label text-md-end">{{ __('Strike') }}</label>

                <div class="col-md-4">
                    <input id="strike" type="number" step="0.01" class="form-control" name="strike" required>
                </div>

            </div>
            <div class="row mb-3">
                <label for="open_date" class="col-md-2 col-form-label text-md-end">{{ __('Open Date') }}</label>

                <div class="col-md-4">
                    <input id="open_date" type="date" class="form-control" name="open_date" required>
                </div>

                <label for="exit_price" class="col-md-2 col-form-label text-md-end">{{ __('Exit Price') }}</label>

                <div class="col-md-4">
                    <input id="exit_price" type="number" step="0.01" class="form-control" name="exit_price">
                </div>

            </div>
            <div class="row mb-3">
                <label for="exp_date" class="col-md-2 col-form-label text-md-end">{{ __('Exp Date') }}</label>

                <div class="col-md-4">
                    <input id="exp_date" type="date" class="form-control" name="exp_date" required>
                </div>

                <label for="fees" class="col-md-2 col-form-label text-md-end">{{ __('Fees') }}</label>

                <div class="col-md-4">
                    <input id="fees" type="number" step="0.01" class="form-control" name="fees" value="0.00" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="close_date" class="col-md-2 col-form-label text-md-end">{{ __('Close Date') }}</label>

                <div class="col-md-4">
                    <input id="close_date" type="date" class="form-control" name="close_date">
                </div>



                <label for="quantity" class="col-md-2 col-form-label text-md-end">{{ __('Quantity') }}</label>

                <div class="col-md-4">
                    <input id="quantity" type="number" class="form-control" name="quantity" value="1" required>
                </div>
            </div>
            <div class="row mb-3">
                <button type="submit" id="add-sale-submit" class="btn btn-primary col-md-12">Submit</button>
            </div>
        </form>
    </div>
@endsection