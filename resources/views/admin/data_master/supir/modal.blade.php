<div class="modal fade" id="modal_supir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="" autocomplete="off" id="form_supir">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama<span class="text-danger">*</span></label>
                        <input type="text" name="nama" parsley-trigger="change" required
                            placeholder="Nama" class="form-control">
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Umur<span class="text-danger">*</span></label>
                        <input type="text" name="umur" parsley-trigger="change" required
                            placeholder="Umur" class="form-control">
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status vaksin<span class="text-danger">*</span></label>
                        <select class="form-control" aria-label="Default select example" name="status_vaksin" required>
                            <option selected>Open this select menu</option>
                            <option value="Vaksin 1">Vaksin 1</option>
                            <option value="Vaksin 2">Vaksin 2</option>
                            <option value="Booster 1">Booster 1</option>
                            <option value="Booster 2">Booster 2</option>
                        </select> 
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Sim<span class="text-danger">*</span></label>
                        <input type="text" name="sim" parsley-trigger="change" required
                            placeholder="Sim" class="form-control">
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
