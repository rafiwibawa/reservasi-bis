<div class="modal fade" id="modal_promo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="" autocomplete="off" id="form_promo">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama<span class="text-danger">*</span></label>
                        <input type="text" name="name" parsley-trigger="change" required
                            placeholder="Nama" class="form-control">
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jumlah Diskon<span class="text-danger">*</span></label>
                        <input type="text" name="jumlah" parsley-trigger="change" required
                            placeholder="jumlah" class="form-control">
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status<span class="text-danger">*</span></label>
                        <select class="form-control" aria-label="Default select example" name="active" required>
                            <option selected>Open this select menu</option>
                            <option value=1>Active</option>
                            <option value=0>Non Active</option> 
                        </select> 
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
