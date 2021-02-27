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

                    <form method="post" action="/influencer/{{$service->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <input type="text" class="form-control" id="service" placeholder="Service" name="service" value="{{$service->name}}" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="cost" placeholder="Cost" name="cost" min="0" max="20000" value="{{$service->cost}}" required>
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" class="form-control" id="servicelink" placeholder="Servicelink" name="servicelink" value="{{$service->servicelink}}" required>
                    </div> -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="UPDATE">
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
