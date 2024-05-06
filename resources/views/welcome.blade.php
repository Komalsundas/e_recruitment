@extends('layouts.app2')

@section('content')
    <div class="div1 text-center">
        <div class="row no-gutters">
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('images/a.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Vacancy</h5>
                        <p class="card-text">Bhutan telecom is pleased to announce new positions</p>
                        <a href="{{ route('vacancy') }}" class="btn btn-success">View all vacancy</a>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('images/b.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Results</h5>
                        <p class="card-text">See the result for all the vacancy announced</p>
                        <a href="{{ route('result') }}" class="btn btn-success">View all results</a>
                    </div>
                </div>
        </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
@endsection
