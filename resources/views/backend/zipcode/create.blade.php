@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Shipping Class Add')}}</h5>
            </div>

            <form class="form-horizontal" action="{{ route('zipcode.insert') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="locality">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="zipcode_availability">{{translate('Zipcode')}}</label>
                        <div class="col-sm-9">
                            <textarea rows="4" placeholder="{{ translate('Zipcode') }}" name="zipcode" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="zipcode_charges">{{translate('Zipcode Charges')}}</label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="{{ translate('Zipcode Charges') }}" name="zipcodecharges" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="delivery_interval">{{translate('Delivery Interval Time(hour)')}}</label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="{{ translate('Delivery Interval Time(hour)') }}" name="delivery_interval" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
