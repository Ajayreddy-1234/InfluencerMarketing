@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Oops!! No Influencer Found</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <p class="lead">New to Market Influencers??</p>
                  <p>Then Tap on the Influencer button in Welcome Page, to get to know new Influencers and check their Services!!</p>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
