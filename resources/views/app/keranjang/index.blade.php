@extends('app.layouts.app')
@section('content')
 
<!-- New Arrivals section end -->
<!-- contact section start -->
<div class="layout_padding contact_section" style="background-color: white">
	<div class="container">
		<h1 class="new_text"><strong>Checkout Now</strong></h1>
	</div>
	<div class="container-fluid ram">
		<div class="row">
			<div class="col-md-12"> 
					<div class="input_main">
						<div class="container">
							@if ($notification = Session::get('success')) 
								<div class="alert alert-primary" role="alert">
									This is a primary alert—check it out!
							  	</div>
							@endif
							<table class="table table-hover">
								<thead style="background-color: #4e8fff">
								  <tr style="color: aliceblue">
									<th scope="col">#</th>
									<th scope="col">Nama</th>
									<th scope="col">Nik</th>
									<th scope="col">Harga</th>
									<th scope="col">Aksi</th>
								  </tr>
								</thead>
								<tbody>
									@php
										$grand_total = 0;
									@endphp
									@foreach ($data as $item)
										<tr>
											<th scope="row">1</th>
											<td>{{$item->nama}}</td>
											<td>{{$item->nik}}</td>
											<td>@currency($item->harga)</td>
											<td>
												<a title="Hapus" class="btn-delete ml-1 text-danger" href="{{url('app/keranjang/delete')}}/{{$item->id}}"><i class="fa fa-trash"></i></a>
											</td>
										</tr> 
										@php
											$grand_total+=$item->harga;
										@endphp
									@endforeach
								</tbody>
								<tfoot style="background-color: #4e8fff"> 
									<tr style="color: aliceblue">
										<th style="text-align: right" colspan="3">Total</th>
										<th>@currency($grand_total)</th>
										<th></th>
									</tr>  
								</tfoot>
							  </table>
						</div>
						<div class="send_btn">
							<form class="form-hotd" id="form-hotd" action="{{ url('app/keranjang/store') }}" method="post">
								@csrf

								<input type="hidden" name="midtrans_id" id="midtrans_id" value="">  
								<button id="payment-form" style="background-color: #4e8fff; color: #fff"  class="buy_bt mt-3" type="submit">Bayar</button>  
							</form> 
						</div>
					</div> 
			</div> 
		</div>
	</div>
</div>
<!-- contact section end -->

@endsection