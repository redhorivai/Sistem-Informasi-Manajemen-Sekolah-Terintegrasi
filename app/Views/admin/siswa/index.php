<?= $this->extend('admin/layout/main_layout'); ?>
<!-- MAIN CONTENT -->
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-auto">
                                    <button type="button" class="btn bg-gradient-primary" onclick="_tambahData()">
                                        <i class="nav-icon fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                                <div class="col-3">
                                    <select id="kelas_id" class="form-control select2 select2-primary"
                                        data-dropdown-css-class="select2-primary">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= form_open() ?>
                            <table id="viewTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>NUPTK</th>
                                        <th>Wali Kelas</th>
                                        <th>Kelas</th>
                                        <th style="width: 167px;">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            <?= form_close() ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- awal modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id='formInput' class="form-data">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Guru: <span class='text-danger'>*</span></label>
                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                id="id_guru" name="id_guru" data-allow-clear="true" style="width:100%">
                                <option disabled selected>-- Pilih Wali Kelas --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Kelas: <span class='text-danger'>*</span></label>
                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                id="id_kelas" name="id_kelas" data-allow-clear="true" style="width:100%">
                                <option disabled selected>-- Pilih Kelas --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Jurusan: <span class='text-danger'>*</span></label>
                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                id="id_jurusan" name="id_jurusan" data-allow-clear="true" style="width:100%">
                                <option disabled selected>-- Pilih Jurusan --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap: <span class='text-danger'>*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama lengkap"
                                onchange="remove(id)">
                        </div>
                        <div class="form-group">
                            <label>NIS: <span class='text-danger'>*</span></label>
                            <input type="int" class="form-control" id="nis" name="nis" placeholder="masukan nis"
                                onchange="remove(id)">
                        </div>
                        <div class="form-group">
                            <label>NIK: <span class='text-danger'>*</span></label>
                            <input type="int" class="form-control" id="nik" name="nik"
                                placeholder="masukan nik" onchange="remove(id)">
                        </div>
                        <div class="form-group">
                            <label>Email: <span class='text-danger'>*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="masukan email" onchange="remove(id)">
                        </div>
                        <div class="form-group">
                            <label>Telepon: <span class='text-danger'>*</span></label>
                            <input type="int" class="form-control" id="telepon" name="telepon"
                                placeholder="masukan telepon" onchange="remove(id)">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin: <span class='text-danger'>*</span></label>
                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                id="jenis_kelamin" name="jenis_kelamin" data-allow-clear="true" style="width:100%">
                                <option disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat: </label>
                            <textarea rows="3" id="alamat" name="alamat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk: <span class='text-danger'>*</span></label>
                            <input type="date" class="form-control" id="waktu_masuk" name="waktu_masuk" onchange="remove(id)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="_simpanData()">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir moda -->
<?= $this->endSection() ?>