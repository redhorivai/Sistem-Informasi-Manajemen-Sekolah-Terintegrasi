<script type="text/javascript">
    var method;
    const BASE_URL = "<?= base_url() ?>";
    $('#modal-form').on('hidden.bs.modal', function() {
        $('#formInput')[0].reset();
        $('#preview-thumbnail').attr('src', BASE_URL + 'assets-admin/uploads/400x300.png');
        $('#preview-banner').attr('src', BASE_URL + 'assets-admin/uploads/800x600.png');
        $('.select2').val(null).trigger('change');
    });

    $(function() {
        _getBeritaArtikel();
    });

    function _getBeritaArtikel() {
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
                "targets": [0, 2, 3, 4, 5, 6],
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
                    "data": "col6"
                },
                {
                    "data": "action"
                },
            ],
            "ajax": "<?= site_url('BeritaArtikel/getData') ?>",
        });
    }

    function _tambahData() {
        method = 'save';
        $('.select2').select2();
        $('#modal-form').modal('show');
        $('#modal-title').text('Tambah Data');
    }

    function previewImage(input, targetId) {
        const file = input.files[0];
        if (file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                toastr.error("File harus berupa gambar (JPG, PNG).");
                input.value = ''; // Reset input
                document.getElementById(targetId).src = ''; // Kosongkan preview
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(targetId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function _simpanData() {
        const url = method === "save" ?
            "<?= site_url('BeritaArtikel/insert_data') ?>" :
            "<?= site_url('BeritaArtikel/update_data') ?>";

        const fields = [{
                id: "tipe",
                required: true
            },
            {
                id: "judul",
                required: true
            },
            {
                id: "deskripsi",
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
                        toastr.success(`Data berhasil disimpan`);
                        $('#modal-form').modal('hide');
                        $('.form-data')[0].reset();
                        $('#viewTable').DataTable().ajax.reload();
                    } else if (data.gagal) {
                        if (data.message) {
                            toastr.error(data.message);
                        } else {
                            toastr.error("Terjadi kesalahan saat menyimpan data.");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Gagal memproses permintaan.");
                }
            });
        }
    }

    function _btnEdit(id, tipe, judul) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('BeritaArtikel/get_edit') ?>",
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
                $('[name=tipe]').val(data.tipe).trigger('change');
                $('[name=judul]').val(data.judul);
                $('[name=deskripsi]').val(data.deskripsi);

                // Perbaikan path base
                const baseUrl = "<?= base_url('assets-admin/uploads') ?>/"; // tambahkan trailing slash

                const thumbSrc = data.thumbnail ? baseUrl + data.thumbnail : baseUrl + '400x300.png';
                const bannerSrc = data.banner ? baseUrl + data.banner : baseUrl + '800x600.png';

                $('#preview-thumbnail').attr('src', thumbSrc);
                $('#preview-banner').attr('src', bannerSrc);

                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }



    function _btnDelete(id, tipe, judul) {
        if (confirm(`Apakah Anda Yakin Hapus Data ${judul} ?`)) {
            $.ajax({
                url: "<?= site_url('BeritaArtikel/del_data') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.sukses) {
                        toastr.error(`anda telah menghapus <b>${judul}</b>`);
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