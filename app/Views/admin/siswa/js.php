<script type="text/javascript">
    var method;
    var table;
    let cachedOptions = null;
    let debounceTimer;


    $(document).ready(function() {
        // Inisialisasi select2
        $('.select2').select2();

        // Load select option kelas
        $.ajax({
            url: "<?= site_url('Siswa/get_kelas') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let html = '<option value="">-- semua data siswa --</option>';
                data.forEach(function(item) {
                    html += `<option value="${item.id}">Kelas: ${item.nama_kelas}</option>`;
                });
                $("#kelas_id").html(html);
            },
            error: function() {
                toastr.error('Gagal memuat data kelas.');
            }
        });

        // Inisialisasi DataTable
        table = $('#viewTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            deferRender: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "<?= site_url('Siswa/getData') ?>",
                type: "POST",
                data: function(d) {
                    d.kelas_id = $('#kelas_id').val(); // kirim filter kelas ke server
                }
            },
            columnDefs: [{
                targets: [0, 3, 4],
                orderable: false
            }, ],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'nis'
                },
                {
                    data: 'wali_kelas'
                },
                {
                    data: 'nama_kelas'
                },
                {
                    data: 'aksi',
                    orderable: false
                }
            ]
        });

        // Trigger reload saat select kelas berubah
        $('#kelas_id').on('change', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                table.ajax.reload();
            }, 300); // delay 300ms
        });
    });

    function _tambahData() {
        method = 'save';
        $('#formInput')[0].reset();
        $('#modal-form').modal('show');
        $('#modal-title').text('Tambah Data Siswa');

        // Kosongkan select terlebih dahulu
        $('#id_guru').html('<option value="">-- Pilih Guru --</option>');
        $('#id_kelas').html('<option value="">-- Pilih Kelas --</option>');
        $('#id_jurusan').html('<option value="">-- Pilih Jurusan --</option>');

        if (cachedOptions) {
            populateSelects(cachedOptions);
        } else {
            $.ajax({
                url: "<?= site_url('siswa/getOptions') ?>",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    cachedOptions = data;
                    populateSelects(data);
                },
                error: function(xhr, status, error) {
                    alert('Gagal memuat data select!');
                }
            });
        }
    }

    function populateSelects(data) {
        // Guru
        $.each(data.guru, function(i, v) {
            $('#id_guru').append(`<option value="${v.id}">${v.nama_lengkap}</option>`);
        });

        // Kelas
        $.each(data.kelas, function(i, v) {
            $('#id_kelas').append(`<option value="${v.id}">${v.nama_kelas}</option>`);
        });

        // Jurusan
        $.each(data.jurusan, function(i, v) {
            $('#id_jurusan').append(`<option value="${v.id}">${v.nama_jurusan}</option>`);
        });
    }

    function _simpanData() {
        const url = method === "save" ?
            "<?= site_url('Siswa/insert_data') ?>" :
            "<?= site_url('Siswa/update_data') ?>";

        const fields = [{
                id: "id_guru",
                required: true
            },
            {
                id: "id_kelas",
                required: true
            },
            {
                id: "id_jurusan",
                required: true
            },
            {
                id: "nama_lengkap",
                required: true
            },
            {
                id: "nis",
                required: true
            },
            {
                id: "nik",
                required: true
            },
            {
                id: "email",
                required: true
            }, ,
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
                id: "waktu_masuk",
                required: true
            },
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
                        toastr.error(`NIS Siswa: <b>${$("#nis").val()}</b> sudah ada, silakan coba yang lain`);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data');
                }
            });
        }
    }

    function _btnEdit(id, nama_lengkap, nama_kelas) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('Siswa/get_edit') ?>",
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
                $('[name=id_guru]').html(`<option value="${data.id_guru}" selected>${data.nama_guru}</option>`).trigger('change');
                $('[name=id_kelas]').html(`<option value="${data.id_kelas}" selected>${data.nama_kelas}</option>`).trigger('change');
                $('[name=id_jurusan]').html(`<option value="${data.id_jurusan}" selected>${data.nama_jurusan}</option>`).trigger('change');

                $('[name=nama_lengkap]').val(data.nama_lengkap);
                $('[name=nis]').val(data.nis);
                $('[name=nik]').val(data.nik);
                $('[name=email]').val(data.email);
                $('[name=telepon]').val(data.telepon);
                $('[name=jenis_kelamin]').val(data.jenis_kelamin);
                $('[name=alamat]').val(data.alamat);
                $('[name=waktu_masuk]').val(data.waktu_masuk);
                $('.select2').select2();
                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }

    function _btnDelete(id, nama_lengkap, nama_kelas) {
        if (confirm(`Apakah Anda Yakin Hapus Data ${nama_lengkap} ?`)) {
            $.ajax({
                url: "<?= site_url('Siswa/del_data') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.sukses) {
                        toastr.error(`anda telah menghapus data <b>${nama_lengkap}</b>`);
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