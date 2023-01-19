<div class="modal fade" id="modal_jurusan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <form action="" method="" autocomplete="off" id="form_jurusan">
                <div class="modal-header">
                    <h4 class="modal-title">Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body"> 
                    <div class="form-group">
                        <label>Dari Kota <span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" name="kota_id"
                            data-placeholder="Select kota"></select>

                        <div class="kota_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label>Kota Tujuan <span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" id="kota_tujuan" name="kota_tujuan_id[]" multiple></select>

                        <div class="kota_tujuan_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label>Mobil <span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" name="mobil_id"
                            data-placeholder="Select Mobil"></select>

                        <div class="mobil_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label>Promo <span style="color: rgb(249, 91, 91">*</span></label>

                        <select class="form-control" name="promo_id"
                            data-placeholder="Select promo"></select>

                        <div class="promo_id-validation invalid-feedback" style="display: none;">
                            <i class="bx bx-radio-circle"></i>
                            <span></span>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label>Harga<span class="text-danger">*</span></label>
                        <input type="number" name="harga" parsley-trigger="change" required
                            placeholder="Harga" class="form-control">
                    </div>    

                    <div class="import-field form-control form-control-sm resumable resumable-file mt-3" data-id="import"> 
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="file" id="file" class="dropify" data-height="200" required/> 
                    </div>

                    <div class="form-group">
                        <label>Description<span class="text-danger">*</span></label>
                        <textarea type="text" name="description"  
                            class="form-control note-editor"></textarea>
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
