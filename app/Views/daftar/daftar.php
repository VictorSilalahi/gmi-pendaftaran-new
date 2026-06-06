<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran | GMI Wil-I</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col">

                <nav class="navbar bg-body-tertiary">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="assets/images/logo-gmi.png" alt="Bootstrap" width="40" height="54"  class="d-inline-block align-text-top">
                                <h4>Pendaftaran Resort GMI Wil-I</h4>
                        </a>
                    </div>
                </nav>
            
            </div>

            <div class="row">
                <div class="col-2"></div>

                <div class="col-8" id="div_form">
                    <form id="formDaftar" action="<?php echo(base_url()); ?>tambah_resort" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="txtNamaResort" class="col-sm-8 col-form-label">Nama Resort</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtNamaResort" id="txtNamaResort">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtNamaResort" class="col-sm-8 col-form-label">Distrik</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="slcDistrik" id="slcDistrik">
                                    <option value="D-I">D-I</option>
                                    <option value="D-II">D-II</option>
                                    <option value="D-III">D-III</option>
                                    <option value="D-IV">D-IV</option>
                                    <option value="D-V">D-V</option>
                                    <option value="D-VI">D-VI</option>
                                    <option value="D-VII">D-VII</option>
                                    <option value="D-VIII">D-VIII</option>
                                    <option value="D-IX">D-IX</option>
                                    <option value="D-X">D-X</option>
                                    <option value="D-XI">D-XI</option>
                                    <option value="D-XII">D-XII</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtEmailResort" class="col-sm-8 col-form-label">Email Resmi Resort</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="txtEmailResort" id="txtEmailResort">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtAlamatResort" class="col-sm-8 col-form-label">Alamat Resort</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtAlamatResort" id="txtAlamatResort">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtNamaOperator" class="col-sm-8 col-form-label">Nama Operator</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtNamaOperator" id="txtNamaOperator">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fileSK" class="col-sm-8 col-form-label">SK Penunjukan Tenaga Operator/Staff Administrasi Resort (file:jpeg/max:256kb)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="fileSK" id="fileSK">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtMobilePhone" class="col-sm-8 col-form-label">Mobile Phone (WA)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtMobilePhone" id="txtMobilePhone">
                            </div>
                        </div>

                        <br>

                        <div>
                            <button type="button" class="btn btn-primary btn-daftar">Daftar</button>
                        </div>
                    
                    </form>
                </div>

                <div class="col-2"></div>

            </div>
        
        </div>

    </div>
    
</body>
    <script src="assets/js/pendaftaran/pendaftaran.js" type="module"></script>

</html>