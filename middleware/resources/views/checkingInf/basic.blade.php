@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header">Links</div>
                <div class="card-body">
                
                 @foreach($links as $il)
                 @php
                 $iconname=strtolower($il->name);
                 $ii="fa-";
                 $iconname=$ii.$iconname;
                 @endphp
                 <a href="{{$il->link}}" style="margin-bottom:10px;margin-left:250px;" class="btn btn-success"><i class="fa {{$iconname}}"></i>&nbsp;{{$il->name}}</a><br>
                 @endforeach
                
                </div>
        </div>
            <div class="card">
                <div class="card-header">{{$user->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="lead">Click on the service to check the Influencer's activity on Social Networks!!</p>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Service</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter=1;
                            @endphp
                            @foreach($ser as $ser)
                            <tr>
                            <th scope="row">{{$counter}}</th>
                            <td style="color:blue;">{{$ser->name}}</td>
                            <td><a href="/home" class="btn btn-success">Add</a></td>
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
