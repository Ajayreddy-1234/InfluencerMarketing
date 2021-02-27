@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Links</div>
                <div class="card-body">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Link</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter=1;
                            @endphp
                            @foreach($links as $il)
                            <tr>
                            <th scope="row">{{$counter}}</th>
                            <td><a href="{{$il->link}}">{{$il->name}}</a></td>
                            <td><a href="/influencer/links/{{$il->id}}/del" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                <a href="/influencer/links/create" class="btn btn-success">Add Link</a>
                </div>
        </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      
                    <h3 style="padding-bottom:10px;">{{$user->name}}</h3>
                    <p class="lead">The services you Provide are :</p>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Service</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter=1;
                            @endphp
                            @foreach($services as $ser)
                            <tr>
                            <th scope="row">{{$counter}}</th>
                            <td>{{$ser->name}}</td>
                            <td>{{$ser->cost}}</td>
                            <td><a href="{{route('influencer.edit',$ser->id)}}" class="btn btn-primary">Edit</a>
                            <a href="/influencer/{{$ser->id}}/del" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('influencer.create')}}" class="btn btn-success">Add</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
