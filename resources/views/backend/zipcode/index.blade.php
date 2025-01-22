@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Shipping Class')}}</h1>
		</div>
        @can('add_staff')
            <div class="col-md-6 text-md-right">
                <a href="{{ route('zipcode.create') }}" class="btn btn-circle btn-info">
                    <span>{{translate('Add New')}}</span>
                </a>
            </div>
        @endcan
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Shipping Class')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Zipcode')}}</th>
                    <th>{{translate('Zipcode Charges')}}</th>
                    <th>{{translate('Delivery Interval Time(hour)')}}</th>
                    <th>{{translate('Type')}}</th>
                    <th 1data-breakpoints="lg">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($zipcode))
                @foreach($zipcode as $key => $row)
                    <tr>
                        <td>{{ ($key+1) + ($zipcode->currentPage() - 1)*$zipcode->perPage() }}</td>
                        <td>{{ ucfirst($row->name) }}</td>
                        <td>{{ implode(', ', json_decode($row->zipcode)) }}</td>
                        <td>{{ ucfirst($row->charges) }}</td>
                        <td>{{ ucfirst($row->delivery_interval) }}</td>
                        <td>{{ ucfirst($row->type) }}</td>
                        <td>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('zipcode.edit', ['id' => $row->id])}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('zipcode.destroy', $row->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $zipcode->appends(request()->input())->links() }}
        </div>
        @endif
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
