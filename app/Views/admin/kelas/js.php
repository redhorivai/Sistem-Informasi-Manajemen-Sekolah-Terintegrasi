<script type="text/javascript">
    var method;
    $(function() {
        _getKelas();
    });

    function _getKelas() {
        $("#viewTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            language: {
                searchPlaceholder: 'Cari...',
                sSearch: '',
                lengthMenu: '_MENU_',
                emptyTable: 'Tidak ada data'
            },
            "order": [],
            "columnDefs": [{
                "targets": [0, 2, 3, 4],
                "orderable": false
            }, ],
            "columns": [{
                    "data": "col1"
                },
                {
                    "data": "col2"
                },
                {
                    "data": "col3"
                },
                {
                    "data": "col4"
                },
                {
                    "data": "action"
                },
            ],
            "ajax": "<?= site_url('Kelas/getData') ?>",
        });
    }

    function _tambahData() {
        method = 'save';
        $('.select2').select2();
        $('#modal-form').modal('show');
        $('#modal-title').text('Tambah Data');
    }

    function _simpanData() {
        const url = method === "save" ?
            "<?= site_url('Kelas/insert_data') ?>" :
            "<?= site_url('Kelas/update_data') ?>";

        const fields = [{
                id: "kode_kelas",
                required: true
            },
            {
                id: "nama_kelas",
                required: true
            },
            {
                id: "keterangan",
                required: false
            }
        ];

        let isValid = true;

        // Validasi input
        fields.forEach(field => {
            const $el = $("#" + field.id);
            if (field.required && !$el.val()) {
                $el.addClass("is-invalid");
                isValid = false;
            } else {
                $el.removeClass("is-invalid");
            }
        });
        if (!isValid) {
            toastr.warning("Silakan lengkapi data yang wajib diisi.");
            return;
        }

        if (confirm(`Yakin data akan disimpan?`)) {
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($('#formInput')[0]),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.sukses) {
                        toastr.success(`data berhasil disimpan`);
                        $('#modal-form').modal('hide');
                        $('.form-data')[0].reset();
                        $('#viewTable').DataTable().ajax.reload();
                    }
                    if (data.gagal) {
                        toastr.error(`kode kelas: <b>${$("#kode_kelas").val()}</b> sudah ada, silakan coba yang lain`);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data');
                }
            });
        }
    }

    function _btnEdit(id, kode_kelas, nama_kelas) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('Kelas/get_edit') ?>",
            type: 'GET',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                if (data.error) {
                    toastr.error(data.error);
                    return;
                }
                $('[name=id]').val(data.id);
                $('[name=kode_kelas]').val(data.kode_kelas);
                $('[name=nama_kelas]').val(data.nama_kelas);
                $('[name=keterangan]').val(data.keterangan);
                $('.select2').select2();
                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }

    function _btnDelete(id, kode_kelas, nama_kelas) {
        if (confirm(`Apakah Anda Yakin Hapus Data ${nama_kelas} ?`)) {
            $.ajax({
                url: "<?= site_url('Kelas/del_data') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.sukses) {
                        toastr.error(`anda telah menghapus data <b>${nama_kelas}</b>`);
                        $('#viewTable').DataTable().ajax.reload();
                    }
                    if (response.gagal) {
                        toastr.warning("Gagal menghapus data");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }
    }
</script>