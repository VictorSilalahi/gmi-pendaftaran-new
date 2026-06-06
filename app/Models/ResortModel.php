<?php

namespace App\Models;

use CodeIgniter\Model;

class ResortModel extends Model
{

    protected $table = 'tresort';
    protected $primaryKey = 'resort_id';
    protected $allowedFields = [
                                    'resort_id',
                                    'nama_resort', 'alamat','distrik','email', 
                                    'password', 'nama_operator', 'mobile_phone', 
                                    'path_surat_keputusan', 'tanggal_daftar', 
                                    'created_at', 'updated_at'
                                ];
                                

}