@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Links</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 style="padding-bottom:10px;">{{$user->name}}</h3>
                    <form method="POST" action="/influencer/links/store">
                    @csrf
                    <div class="form-group">
                    <label for="sel">Social Media</label>
                    <select class="form-control" id="name" name="name" onchange="CheckMedia(this.value);">
                        <option value="Facebook">Facebook</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Instagram">Instagram</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Youtube">Youtube</option>
                        <option value="Others">Others</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <input type="text" style="display:none;" class="form-control" id="name1" placeholder="Name of Social Media" name="name1" value="Others" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="link" placeholder="Link" name="link" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Create">
                    </div>
                    </form>


                    </div>
            </div>
        </div>
    </div>
</div>
@endsection