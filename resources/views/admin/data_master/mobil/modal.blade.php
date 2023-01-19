<div class="modal fade" id="modal_mobil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="" autocomplete="off" id="form_mobil">

                <div class="modal-body"> 
                    {{-- Supir --}}
                    <div class="form-group">
                        <label>Supir <span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" name="supir_id"
                            data-placeholder="Select supir"></select>

                        <div class="supir_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div>

                    {{-- Merek --}}
                    <div class="form-group">
                        <label>Merek<span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" name="merek_mobil_id"
                            data-placeholder="Select merek"></select>

                        <div class="merek_mobil_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div>

                    {{-- CC --}}
                    <div class="form-group">
                        <label>CC<span class="text-danger">*</span></label>
                        <input type="number" name="cc" parsley-trigger="change" required
                            placeholder="CC" class="form-control">
                    </div>  

                    {{-- Jumlah kapasitas --}}
                    <div class="form-group">
                        <label>Jumlah Kapasitas<span class="text-danger">*</span></label>
                        <input type="text" name="jumlah_kapasitas" parsley-trigger="change" required
                            placeholder="jumlah" class="form-control">
                    </div>  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-loading">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
