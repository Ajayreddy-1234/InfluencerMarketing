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

                    <h3 style="padding-bottom:10px;">Administrator</h3>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Influencer</th>
                            <th scope="col">Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter=1;
                            @endphp
                            @foreach($influencers as $inf)
                            <tr>
                            <th scope="row">{{$counter}}</th>
                            <td>{{$inf->name}}</td>
                            <td>
                            @if($inf->permission==0)
                            <a href="/admin/{{$inf->id}}/permission" class="btn btn-danger">Denied</a>
                            @else
                            <a href="/admin/{{$inf->id}}/permission" class="btn btn-success">Granted</a>
                            @endif
                            </td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
