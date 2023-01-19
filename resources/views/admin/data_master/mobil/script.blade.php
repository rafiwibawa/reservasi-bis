<script type="text/javascript">
    var Page = function() {
        var _componentPage = function(){
            var init_table;

            $(document).ready(function() {
                initTable();
                formSubmit();
                initAction();
                initFuntion();
            });

            const initTable = () => {
                init_table = $('#init-table').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    sScrollY: ($(window).height() < 700) ? $(window).height() - 200 : $(window).height() - 350,
                    ajax: {
                        type: 'POST',
                        url: "{{ url('mobil/dt') }}", 
                    },
                    columns: [
                        { data: 'DT_RowIndex' },
                        { data: 'supir_nama' }, 
                        { data: 'merek_nama' }, 
                        { data: 'jumlah_kapasitas' }, 
                        { data: 'cc' },
                        { defaultContent: '' }
                        ],
                    columnDefs: [
                        {
                            targets: 0,
                            searchable: false,
                            orderable: false,
                            className: "text-center"
                        },
                        {
                            targets: 3,
                            searchable: false,
                            orderable: false, 
                            render : function(data, type, full, meta) { 
                                return data+' Penumpang'
                            }
                        }, 
                        {
                            targets: 4,
                            searchable: false,
                            orderable: false, 
                            render : function(data, type, full, meta) { 
                                return data+' CC'
                            }
                        }, 
                        {
                            targets: -1,
                            searchable: false,
                            orderable: false,
                            className: "text-center",
                            data: "id",
                            render : function(data, type, full, meta) {
                                return `
                                        <a title="Edit" class="btn-edit text-info" href="{{url('/mobil')}}/${data}"><i class="fa fa-edit"></i></a>
                                   
                                        <a title="Hapus" class="btn-delete ml-1 text-danger" href="{{url('/mobil')}}/${data}"><i class="fa fa-trash"></i></a>
                                    `
                            }
                        },
                    ],
                    order: [[1, 'asc']],
                    searching: true,
                    paging:true,
                    lengthChange:false,
                    bInfo:true,
                    dom: '<"datatable-header"><tr><"datatable-footer"ip>',
                    language: {
                        search: '<span>Search:</span> _INPUT_',
                        searchPlaceholder: 'Search.',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        processing: '<div class="text-center"> <div class="spinner-border text-primary" role="status"> <span class="sr-only">Loading...</span> </div> </div>',
                    },
                });

                $('#search').keyup(searchDelay(function(event) {
                    init_table.search($(this).val()).draw()
                }, 1000));

                $('#pageLength').on('change', function () {
                    init_table.page.len(this.value).draw();
                });
            },
            initAction = () => {
                $(document).on('click', '#add_btn', function(event){
                    event.preventDefault();

                    $('#form_mobil').trigger("reset");
                    $('#form_mobil').attr('action','{{url('mobil')}}');
                    $('#form_mobil').attr('method','POST');
                    

                    showModal('modal_mobil');
                });

                $(document).on('click', '.btn-edit', function(event){
                    event.preventDefault();

                    var data = init_table.row($(this).parents('tr')).data();

                    $('#form_mobil').trigger("reset");
                    $('#form_mobil').attr('action', $(this).attr('href'));
                    $('#form_mobil').attr('method','PUT');

                    $('#form_mobil').find('select[name="supir_id"]').val(data.supir_id).trigger('change'); 
                    $('#form_mobil').find('select[name="merek_mobil_id"]').val(data.merek_mobil_id).trigger('change'); 
                    $('#form_mobil').find('input[name="cc"]').val(data.cc); 
                    $('#form_mobil').find('input[name="jumlah_kapasitas"]').val(data.jumlah_kapasitas); 
                    

                    showModal('modal_mobil');
                });

                $(document).on('click', '.btn-delete', function(event){
                    event.preventDefault();
                    var url = $(this).attr('href');

                    Swal.fire({
                        title: 'Hapus satuan produk?',
                        text: "Akun mobil yang dihapus akan hilang permanen!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal!',
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-danger ml-1',
                        buttonsStyling: false,
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                dataType: 'json',
                            })
                            .done(function(res, xhr, meta) {
                                if (res.status == 200) {
                                    toastr.success(res.message, 'Success')
                                    init_table.draw(false);
                                }
                            })
                            .fail(function(res, error) {
                                toastr.error(res.responseJSON.message, 'Gagal')
                            })
                            .always(function() { });
                        }
                    })
                });
            },
            formSubmit = () => {
                $('#form_mobil').submit(function(event){
                    event.preventDefault();

                    btn_loading('start')
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                    })
                    .done(function(res, xhr, meta) {
                        if (res.status == 200) {
                            toastr.success(res.message, 'Success')
                            init_table.draw(false);
                            hideModal('modal_mobil');
                        }
                    })
                    .fail(function(res, error) {
                        toastr.error(res.responseJSON.message, 'Gagal')
                    })
                    .always(function() {
                        btn_loading('stop')
                    });
                });
            }

            const showModal = function (selector) {
                $('#'+selector).modal('show')
            },
            hideModal = function (selector) {
                $('#'+selector).modal('hide')
            }

            initFuntion = () => {
                // Supir
                renderSelect2('#form_mobil select[name=supir_id]', {
                    data: [], 
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: 'supir_id-field',
                });

                axios({
                    method: 'post',
                    url: '{{ url('mobil/select2-supir') }}',
                    headers: {
                        Authorization: `Bearer ${getItems('token')}`,
                        Accept: 'application/json',
                    },
                }).then((res) => {
                    const { supir } = res.data; 
                    renderSelect2('#form_mobil select[name=supir_id]', {
                        data: supir, 
                        dropdownAutoWidth: true,
                        width: '100%',
                        containerCssClass: 'supir_id-field',
                        allowClear: true,
                    });

                }).catch((err) => {
                    console.log(err);
                    // handleErrorResponse(err.response);
                }); 
 
            }

        };

        return {
            init: function(){
                _componentPage();

                // Merek
                renderSelect2('#form_mobil select[name=merek_mobil_id]', {
                    data: [], 
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: 'merek_mobil_id-field',
                });

                axios({
                    method: 'post',
                    url: '{{ url('mobil/select2-merek') }}',
                    headers: {
                        Authorization: `Bearer ${getItems('token')}`,
                        Accept: 'application/json',
                    },
                }).then((res) => {
                    const { merek } = res.data; 
                    renderSelect2('#form_mobil select[name=merek_mobil_id]', {
                        data: merek, 
                        dropdownAutoWidth: true,
                        width: '100%',
                        containerCssClass: 'merek_mobil_id-field',
                        allowClear: true,
                    });

                }).catch((err) => {
                    console.log(err);
                    // handleErrorResponse(err.response);
                });
            }
        }

    }();

    document.addEventListener('DOMContentLoaded', function() {
        Page.init();
    });

</script>
