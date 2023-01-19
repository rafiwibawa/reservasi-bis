<script type="text/javascript">
    var Page = function() {
        var _componentPage = function(){
            var init_table;

            $(document).ready(function() {
                initTable();
                formSubmit();
                initAction();
            });

            const initTable = () => {
                init_table = $('#init-table').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    sScrollY: ($(window).height() < 700) ? $(window).height() - 200 : $(window).height() - 350,
                    ajax: {
                        type: 'POST',
                        url: "{{ url('jurusan/dt') }}", 
                    },
                    columns: [
                        { data: 'DT_RowIndex' },
                        { data: 'nama_supir' }, 
                        { data: 'nama_mobil' }, 
                        { data: 'jumlah_kapasitas' }, 
                        { data: 'created_at' }, 
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
                            targets: -1,
                            searchable: false,
                            orderable: false,
                            className: "text-center",
                            data: "id",
                            render : function(data, type, full, meta) {
                                return ` 
                                        <a title="Disabled" class="btn-delete ml-1 text-danger" href="{{url('/jurusan')}}/${data}"><i class="fa fa-minus"></i></a>
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

                    $('#form_jurusan').trigger("reset");
                    $('#form_jurusan').attr('action','{{url('jurusan')}}');
                    $('#form_jurusan').attr('method','POST');
                    

                    showModal('modal_jurusan');
                });

                $(document).on('click', '.btn-edit', function(event){
                    event.preventDefault();

                    var data = init_table.row($(this).parents('tr')).data();

                    $('#form_jurusan').trigger("reset");
                    $('#form_jurusan').attr('action', $(this).attr('href'));
                    $('#form_jurusan').attr('method','PUT');

                    $('#form_jurusan').find('input[name="name"]').val(data.name); 
                    $('#form_jurusan').find('input[name="kode"]').val(data.kode); 
                    

                    showModal('modal_jurusan');
                });

                $(document).on('click', '.btn-delete', function(event){
                    event.preventDefault();
                    var url = $(this).attr('href');

                    Swal.fire({
                        title: 'Hapus jurusan?',
                        text: "Akun jurusan yang dihapus akan hilang permanen!",
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
                $('#form_jurusan').submit(function(event){
                    event.preventDefault();

                    btn_loading('start') 
                    var formData = new FormData();
 
                    let _token = $('meta[name="csrf-token"]').attr('content');  
 
                    var kota_id = $(this).find('select[name="kota_id"]').val();
                    var kota_tujuan_id = $(this).find('select[name="kota_tujuan_id[]"]').val();
                    var mobil_id = $(this).find('select[name="mobil_id"]').val(); 
                    var promo_id = $(this).find('select[name="promo_id"]').val(); 
                    var harga = $(this).find('input[name="harga"]').val();  
                    var photo = $('#file').prop('files')[0]; 
                    var description = $(this).find('textarea[name="description"]').val(); 
                        
                    formData.append('kota_id', kota_id);
                    formData.append('kota_tujuan_id', kota_tujuan_id);
                    formData.append('mobil_id', mobil_id);
                    formData.append('promo_id', promo_id);
                    formData.append('harga', harga);
                    formData.append('photo', photo);
                    formData.append('description', description); 
  
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        contentType: 'multipart/form-data',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        headers: {
                            Authorization: `Bearer ${getItems('token')}`,
                            Accept: 'application/json',
                        },
                    })
                    .done(function(res, xhr, meta) {
                        if (res.status == 200) {
                            toastr.success(res.message, 'Success')
                            init_table.draw(false);
                            hideModal('modal_jurusan');
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

        };

        return {
            init: function(){
                _componentPage();

            var slim_select;

            renderSelect2('#form_jurusanselect[name=kota_tujuan_id]', {
                data: [],
                // minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: '100%',
                containerCssClass: 'kota_tujuan_id-field',
            });
 

            $.ajax({
                    url: `{{url('jurusan/get-kota')}}`,
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function (res, xhr, meta) {

                if (res.status == 200) {

                    if(slim_select){
                        slim_select.destroy();
                    }

                    let element = '';

                    $.each(res.data, function (index, data) { 
                        element += `<option value="${data.id}">${data.text} <span class="text-danger"> </span></option>`;
                    })

                    $('#kota_tujuan').html(element);

                    slim_select =  new SlimSelect({
                        select: '#kota_tujuan',
                        placeholder: 'Pilih CLient',
                    })
                }
            })
            .fail(function () {
                alert('Terjadi Kesalahan');
            }); 

            renderSelect2('#form_jurusan select[name=kota_id]', {
                data: [],
                // minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: '100%',
                containerCssClass: 'kota_id-field',
            });

            axios({
                method: 'post',
                url: '{{ url('jurusan/select2-kota') }}',
                headers: {
                    Authorization: `Bearer ${getItems('token')}`,
                    Accept: 'application/json',
                },
            }).then((res) => {
                const { kota } = res.data;
                
                renderSelect2('#form_jurusan select[name=kota_id]', {
                    data: kota,
                    // minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: 'kota_id-field',
                    allowClear: true,
                });
        
            }).catch((err) => {
                console.log(err);
                // handleErrorResponse(err.response);
            }); 

            renderSelect2('#form_jurusan select[name=mobil_id]', {
                data: [],
                // minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: '100%',
                containerCssClass: 'mobil_id-field',
            });

            axios({
                method: 'post',
                url: '{{ url('jurusan/select2-mobil') }}',
                headers: {
                    Authorization: `Bearer ${getItems('token')}`,
                    Accept: 'application/json',
                },
            }).then((res) => {
                const { mobil } = res.data;
                
                renderSelect2('#form_jurusan select[name=mobil_id]', {
                    data: mobil,
                    // minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: 'mobil_id-field',
                    allowClear: true,
                });

            }).catch((err) => {
                console.log(err);
                // handleErrorResponse(err.response);
            }); 

            renderSelect2('#form_jurusan select[name=promo_id]', {
                data: [],
                // minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: '100%',
                containerCssClass: 'promo_id-field',
            });

            axios({
                method: 'post',
                url: '{{ url('jurusan/select2-promo') }}',
                headers: {
                    Authorization: `Bearer ${getItems('token')}`,
                    Accept: 'application/json',
                },
            }).then((res) => {
                const { promo } = res.data;
              
                renderSelect2('#form_jurusan select[name=promo_id]', {
                    data: promo,
                    // minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: 'promo_id-field',
                    allowClear: true,
                });

            }).catch((err) => {
                console.log(err);
                // handleErrorResponse(err.response);
            }); 
 
            // note
            var editor_config = {
                path_absolute : "/",
                selector: "textarea.note-editor",
                menubar: false,
                statusbar: false,
                plugins: [
                    "table advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | tableprops",
                table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;

                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'File Manager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };

            tinymce.init(editor_config);
        } 

            
        }

    }();

    document.addEventListener('DOMContentLoaded', function() {
        Page.init();
    });

</script>
