@extends('layouts.app')
@section('content')
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Order Code</th>
							<th>Customer Name</th>
							<th>Sub Total</th>
							<th>VAT</th>
							<th>Service Charge</th>
							<th>Delivery Charge</th>
							<th>Total Amount</th>
							<th>Status</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						@if($order_data)
						@foreach($order_data as $key =>$value)
						<tr>
							<td><a href="{{ route('user-order-cart-list',$value->order_code) }}">{{$value->order_code}}</a></td>
							<td>{{$value->user->name}}</td>
							<td>{{$value->sub_total}}</td>
							<td>{{$value->vat_amount}}</td>
							<td>{{$value->service_charge}}</td>
							<td>{{$value->delivery_charge}}</td>
							<td>{{$value->total_amount}}</td>
							<td>{{$value->status}}</td>
							<td>{{ $value->created_at->format('Y-m-d') }}</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
				{{$order_data->links()}}
			</div>
		</div>
	</div>
</section>	
@endsection