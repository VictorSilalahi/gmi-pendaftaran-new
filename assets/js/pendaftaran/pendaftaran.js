import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

let fileSize = 0;

$(document).ready(function() {

});

$(document).on("click", ".btn-daftar", function() {

    let nama_resort = '';
    let email_resort = '';
    let distrik = '';

    if ($("#txtNamaResort").val()=='') {

        pesan_error("Masukkan nama Resort!");
        return false;

    }

    if ($("#txtEmailResort").val()=='') {

        pesan_error("Masukkan email resmi Resort!");
        return false;

    }

    email_resort = $('#txtEmailResort').val();

    if (isEmail(email_resort)==false) {
        alert("Format email salah!");
        return false;
    }


    if ($("#txtAlamatResort").val()=='') {

        pesan_error("Masukkan alamat resort!");
        return false;

    }

    if ($("#txtNamaOperator").val()=='') {

        pesan_error("Masukkan nama staff operator!");
        return false;

    }

    if ($("#fileSK").val()=='') {

        pesan_error("Masukkan file SK!");
        return false;

    }

    if ($("#txtMobilePhone").val()=='') {

        pesan_error("Masukkan nomor Mobile Phone (WA)!");
        return false;

    }

    let nama_file = $("#fileSK").val();
    let cek_is_jpg = nama_extension(nama_file);
    
    if (cek_is_jpg!="jpg") {
        pesan_error("Format file SK salah!");
        return false;
    }

    if (fileSize>0.25) {
        pesan_error("Ukuran file terlalu besar!");
        return false;
    }

    let cek_ada_email;

    cek_ada_email = cek_keberadaan_email(email_resort);
    
    if (cek_ada_email==true) {
        alert("Email sudah digunakan oleh Resort lain!");
        return false;
    }

    nama_resort = $("#txtNamaResort").val();
    distrik = $("#slcDistrik").val();

    let sudah_ada_nama_resort = cek_keberadaan_resort(nama_resort, distrik);

    if (sudah_ada_nama_resort==true) {
        pesan_error("Nama Resort sudah terdaftar pada distrik "+distrik+". Gunakan nama resort lain!");
        return false;
    }

    
    $("#formDaftar").submit();


});


$(document).on("change", "#fileSK", function() {

    if (this.files && this.files[0]) {
        let fileSizeInBytes = this.files[0].size;
        let fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
        fileSize = fileSizeInMB;
    }    

});


function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function nama_extension(nama_file) {

    const file = nama_file;
    if (file) {
        const extension = file.split('.').pop().toLowerCase();
        return extension;
    }    

}

function cek_keberadaan_email(email) {

    let email_temp = email;

    let temp = ajax_post("cek_email", {"email": email_temp});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }

}

function cek_keberadaan_resort(nama_resort, distrik) {
    
    let resort = nama_resort;
    let dist = distrik;

    let temp = ajax_post("cek_resort", {"resort": resort, "distrik": dist});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }


}

