@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 style="padding-bottom:10px;">{{$user->name}}</h3>

                    <p class="lead">The Admin did not grant the permission</p>
                    <p class="lead">If this is the first time you created the account wait for sometime to give access else you are blocked!!</p>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
