@extends('frontend.layouts.app')

@section('content')
<section class="text-center py-6">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="{{ static_asset('assets/img/404.svg') }}" class="mw-100 mx-auto mb-2" height="200">
			    <h1 class="fw-700">{{ translate('Page Not Found!') }}</h1>
			    <p class="fs-16 opacity-60">{{ translate('The page you are looking for has not been found on our server.') }}</p>
			    <a class="btn btn-primary" href="{{route('home')}}" ><i class="i-left-arrow la la-arrow-left fs-20"></i>Back To Home</a>
			</div>
		</div>
    </div>
</section>
@endsection
