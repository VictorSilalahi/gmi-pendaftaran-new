<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Ramsey\Uuid\Uuid;

use App\Models\ResortModel;


class Daftar extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('daftar/daftar');
    }

    public function cek_email()
    {

        $db = \Config\Database::connect();

        $email = $this->request->getPost("email");
        
        $query = $db->query("select count(*) as jumlah from tresort where email='".$email."'");
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan email", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan email", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }

    }

    public function cek_resort()
    {

        $db = \Config\Database::connect();

        $resort = $this->request->getPost("resort");
        $distrik = $this->request->getPost("distrik");

        
        $query = $db->query("select count(*) as jumlah from tresort where nama_resort='".$resort."' and distrik='".$distrik."'");
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan resort", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan resort", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }

    
    }    

    public function tambah_resort()
    {

        $db = \Config\Database::connect();

        $now = Time::now(); 

        $uuid = Uuid::uuid4();

        $resort_id = $uuid->toString();
        $resort = $this->request->getPost("txtNamaResort");
        $distrik = $this->request->getPost("slcDistrik");
        $email_resort = $this->request->getPost("txtEmailResort");
        $alamat = $this->request->getPost("txtAlamatResort");
        $operator = $this->request->getPost("txtNamaOperator");
        
        helper('text');

        $pwd = random_string('alnum', 8);

        $img_sk = $this->request->getFile("fileSK");
        $new_img_sk = $img_sk->getRandomName();

        $mobile_phone = $this->request->getPost("txtMobilePhone");
        $tanggal_daftar = $now->toDateString();
        $created_at = $now->toDateString();
        $updated_at = $now->toDateString();

        $new_resort = new ResortModel();

        $new_data = [
            'resort_id'=> $resort_id,
            'nama_resort'=> $resort, 
            'alamat'=> $alamat,
            'distrik'=>$distrik,
            'email'=>$email_resort,            
            'password'=>$pwd, 
            'nama_operator'=>$operator, 
            'mobile_phone'=>$mobile_phone, 
            'path_sk'=>$new_img_sk, 
            'tanggal_daftar'=>$tanggal_daftar, 
            'created_at'=>$created_at, 
            'updated_at'=>$updated_at
        ];

        // pindahkan file ke folder
        $img_sk->move(ROOTPATH . 'public/uploads', $new_img_sk);
        // path penyimpanan image SK
        $path_img_sk = 'public/uploads/'.$new_img_sk;
        
        // simpan ke db 
        $sql = "insert into tresort (resort_id, nama_resort, alamat, distrik, email, password, nama_operator, mobile_phone, path_sk, tanggal_daftar, created_at, updated_at)";
        $sql = $sql . " values ('".$resort_id."','".$resort."','".$alamat."','".$distrik."','".$email_resort."','".$pwd."','".$operator."','".$mobile_phone."','".$path_img_sk."',";
        $sql = $sql . "'".$tanggal_daftar."','".$created_at."','".$updated_at."')";

        // $new_resort->save($new_data);
        $db->query($sql);

        try {

            $this->kirim_email($email_resort, $pwd);
            return redirect()->to('terima_kasih');

        } catch (\Exception $e) {
            
            // Standard exceptions
            log_message('error', $e->getMessage());
        
        } catch (\Throwable $t) {

            // Critical system errors
            // echo $t->getMessage();
            return view('errors/html/error_exception', ['message' => $t->getMessage()]);
    
        }        

    }

    public function terima_kasih() 
    {

        return view('daftar/terima_kasih');        

    }

    public function kirim_email($penerima, $pwd)
    {

        $email = \Config\Services::email();

        $email_pengirim = getenv("email.SMTPUser");
        $pihak_pengirim = getenv('email.SMTPFrom');
        $email->setFrom($email_pengirim, $pihak_pengirim);
        $email->setTo($penerima);
        $email->setSubject('Status Pendaftaran Resort GMI Wil-I');
        // // $email->setCC('another@another-example.com');
        // // $email->setBCC('them@their-example.com');

        $message = '<!DOCTYPE html>';
        $message = $message . '<html lang="en">';
        $message = $message . '<head>';
        $message = $message . '<meta charset="UTF-8">';
        $message = $message . '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $message = $message . '<title>Research and Development GMI Wil-I</title>';
        $message = $message . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">';
        $message = $message . '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">';
        $message = $message . '</head>';
        $message = $message . '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>';
        $message = $message . '<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>';
        $message = $message . '<body>';
        $message = $message . '<div class="container-fluid">';
        $message = $message . '     <div class="row">';
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '         <div class="col-4">';
        $message = $message . '             <p><h2>Proses Pendaftaran telah selesai.</h2></p>';
        $message = $message . '             <p>Anda dapat melakukan login ke aplikasi dengan menggunakan keterangan di bawah ini:</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Link: https://app.gmiwilayah1.org</p>';
        $message = $message . '             <p>Login: ' .$penerima. '</p>';
        $message = $message . '             <p>Password: ' .$pwd. '</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Catatan: password dapat di ubah di dalam aplikasi melalui menu Seting > Password</p>';
        $message = $message . '         </div>';    
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '     </div>';
        $message = $message . '</div>';
        $message = $message . '</body>';
        $message = $message . '</html>';

        $email->setMessage($message);
        $email->setMailType('html');  


        if ($email->send()) {

            // return view('terima_kasih');    
            return redirect()->to('terima_kasih');

        } else {

            error_log($this->email->print_debugger());
            echo $email->printDebugger(['headers', 'subject', 'body']);
    
        }


    }


}
