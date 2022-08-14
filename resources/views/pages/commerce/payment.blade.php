@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br>
        @endif
    </div>
</div>
<form>
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="form-label text-dark" for="amount">Amount <span class="text-danger">*</span></label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money"></i></span>
                    </div>
                    <input class="form-control" id="amount" type="number" name="amount">
                </div>
            </div>
        </div>
        <input type="hidden" id="stripe_publishable" value="{{env('STRIPE_PUBLISHABLE')}}">
        <div class="col-12 mt-4">
            <div class="text-center">
                <button type="submit" id="donate" class="btn btn-secondary mt-4 animate-up-2"><span class="mr-2"><i class="fas fa-donate"></i></span>Donate</button>
            </div>
        </div>
    </div>
</form>


@endsection

@section('extra-js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//js.stripe.com/v3/"></script>
<script src="/checkout.js"></script>

@endsection