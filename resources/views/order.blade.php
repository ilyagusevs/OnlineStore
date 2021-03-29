@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>Total price: <b>&euro; {{$order->totalprice()}}</b></p>
            <form action="{{route('cart-confirm')}}" method="POST">
                <div>
                    <p></p>

                    <div class="container">
                        <div class="form-group">
                            <label for="country" class="control-label col-lg-offset-3 col-lg-2">Country</label>
                            <div class="col-lg-4">
                                <input type="text" name="country" id="country" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="city" class="control-label col-lg-offset-3 col-lg-2">City</label>
                            <div class="col-lg-4">
                                <input type="text" name="city" id="city" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-offset-3 col-lg-2">Address</label>
                            <div class="col-lg-4">
                                <input type="text" name="address" id="address" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="zipcode" class="control-label col-lg-offset-3 col-lg-2">Zip Code</label>
                            <div class="col-lg-4">
                                <input type="text" name="zipcode" id="zipcode" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Phone</label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" value="Order">
                </div>
            </form>
        </div>
    </div>
@endsection