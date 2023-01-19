@extends('admin.layouts.app')

@section('content')
@include('admin.datatables.style')

<!-- Content Row -->
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
              <div class="table-header d-flex justify-content-between mb-1">
                  <h4 class="">Data Jurusan</h4>
                  <div class="d-flex justify-content-end">
                      <fieldset>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text bg-primary text-white"><i class="fas fa-grip-vertical"></i></span>
                              </div>
                              <select class="form-control" id="pageLength">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                          </div>
                      </fieldset>
                      <fieldset>
                          <div class="input-group pl-1">
                              <div class="input-group-prepend">
                                  <span class="input-group-text bg-primary text-white"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="search" placeholder="Pencarian">
                          </div>
                      </fieldset>
                      <fieldset>
                          <button type="button" id="add_btn" class="btn btn-primary waves-effect width-md waves-light ml-1">
                              <i class="fas fa-plus-circle"></i> Tambah
                          </button>
                      </fieldset>
                  </div>
              </div>
              <div class="table-responsive">
                  <table class="table table-sm table-bordered table-hover" id="init-table" width="100%">
                      <thead class="thead-light">
                          <tr>
                              <th>#</th>
                              <th width="30%">Nama Driver</th> 
                              <th width="25%">Mobil</th> 
                              <th width="25%">Kapasitas</th> 
                              <th width="15%">Tanggal Input</th> 
                              <th width="5%">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div> 

@endsection


@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ url('lib/tinymce/tinymce.min.js') }}"></script>
@include('admin.jurusan.script')
@include('admin.local_storage.script')
@include('admin.datatables.script')

@include('admin.jurusan.modal')
 
<script>
    $('.dropify').dropify();
</script>
    
@endpush