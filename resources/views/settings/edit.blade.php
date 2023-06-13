@extends('layouts.app')

@section('content')
<div class="container">
 
<h1 align='center'>Update</h1>
<form action="/userUpdate/{{$user->id}}" method="POST">
    @csrf
    @method('Patch')
    <div class="row pt-4" style="padding-bottom: 31em;">
        <div class="col-8 offset-2">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">Phone No.</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href ="/deactivate/{{$user->id}}" class="btn btn-danger">
                        Deactivate
                    </a>
                </div>
            </div>


        </div>
    </div>
</form>

</div>
@endsection
