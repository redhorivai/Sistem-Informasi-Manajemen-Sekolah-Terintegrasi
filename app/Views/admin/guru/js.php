<script type="text/javascript">
    var method;
    $(function() {
        _getGuru();
    });

    function _getGuru() {
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
                    "data": "col5"
                },
                {
                    "data": "action"
                },
            ],
            "ajax": "<?= site_url('Guru/getData') ?>",
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
            "<?= site_url('Guru/insert_data') ?>" :
            "<?= site_url('Guru/update_data') ?>";

        const fields = [{
                id: "nama_lengkap",
                required: true
            },
            {
                id: "gelar_belakang",
                required: true
            },
            {
                id: "nik",
                required: true
            },
            {
                id: "nuptk",
                required: true
            },
            {
                id: "email",
                required: true
            },
            {
                id: "telepon",
                required: true
            },
            {
                id: "jenis_kelamin",
                required: true
            },
            {
                id: "alamat",
                required: false
            },
            {
                id: "status",
                required: true
            },
            {
                id: "jabatan",
                required: true
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
                        toastr.error(`NUPTK: <b>${$("#nuptk").val()}</b> sudah ada, silakan coba yang lain`);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data');
                }
            });
        }
    }

    function _btnEdit(id, nuptk) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('Guru/get_edit') ?>",
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
                $('[name=nama_lengkap]').val(data.nama_lengkap);
                $('[name=gelar_belakang]').val(data.gelar_belakang);
                $('[name=nik]').val(data.nik);
                $('[name=nuptk]').val(data.nuptk);
                $('[name=email]').val(data.email);
                $('[name=telepon]').val(data.telepon);
                $('[name=jenis_kelamin]').val(data.jenis_kelamin);
                $('[name=alamat]').val(data.alamat);
                $('[name=status]').val(data.status);
                $('[name=jabatan]').val(data.jabatan);
                $('.select2').select2();
                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }

    function _btnDelete(id, nuptk) {
        if (confirm(`Apakah Anda Yakin Hapus Data ${nuptk} ?`)) {
            $.ajax({
                url: "<?= site_url('Guru/del_data') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.sukses) {
                        toastr.error(`anda telah menghapus <b>${nuptk}</b>`);
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