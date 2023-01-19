@extends('app.layouts.app')
@section('content')
	  
 
<!-- new collection section end -->
<!-- New Arrivals section start -->
<div class="layout_padding gallery_section">
	<div class="container">
		<div class="row">

			@foreach ($data as $item)
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">{{$item->nama_supir}}</p>
						<div class="shoes_icon"><img src="/img/{{$item->gambar}}"></div>
						<div class="star_text">
							<div class="row">
								<div class="col-sm-8">
									<div class="shoes_price"><span style="color: #3eade8;">@currency($item->harga)</span></div>
								</div>
								<div class="col-sm-4">
									<div class="shoes_price">
										
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
											<i class="fa fa-cart-plus"></i>
										</button> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<!-- Modal -->
				<div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal reservasi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<form action="{{url('app/jurusan')}}" method="post">
							@csrf
							<div class="modal-body">
									
									<div class="form-group">
										<label>Id<span class="text-danger">*</span></label>
										<input type="text" name="jurusan_id" value="{{$item->id}}" readonly
											class="form-control">
									</div> 

									<div class="form-group">
										<label>Nama<span class="text-danger">*</span></label>
										<input type="text" name="nama" parsley-trigger="change" required
											placeholder="Nama" class="form-control">
									</div> 
									
									<div class="form-group">
										<label>Nik<span class="text-danger">*</span></label>
										<input type="text" name="nik" parsley-trigger="change" required
											placeholder="Nik" class="form-control">
									</div> 

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
					</div>
				</div>
			@endforeach

		</div> 
	</div>
</div> 	 

@endsection