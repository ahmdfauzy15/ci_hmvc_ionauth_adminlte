<form action='<?php echo base_url('admin/add_data/create')?>' id='create' action="" enctype="multipart/form-data" method="post"accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="nama_penyedia">Nama Penyedia</label>
            <input type="text" class="form-control" id="nama_penyedia" name="nama_penyedia" value="" placeholder="" required>
            <span id="error_nama_penyedia" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nama Bank & NPWP</label>
            <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="" placeholder="BRI(0000)" required>
            <span id="error_nama_bank" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Kode Kegiatan </label>
            <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" value="" placeholder="" required>
            <span id="error_kode_kegiatan" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> No Pesanan </label>
            <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" value="" placeholder="" required>
            <span id="error_no_pesanan" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Kode Rekening </label>
            <input type="text" class="form-control" id="kode_rekening" name="kode_rekening" value="" placeholder="" required>
            <span id="error_kode_rekening" class="has-error"></span>
        </div>

        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jumlah Pengajuan </label>
            <input type="text" class="form-control" id="jumlah_pengajuan" name="jumlah_pengajuan" value="" placeholder="" required>
            <span id="error_jumlah_pengajuan" class="has-error"></span>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Potongan PPH </label>
            <select class="form-control" id="potongan_pph" name="potongan_pph" required>
                <option value="21%">21%</option>
                <option value="22%">22%</option>
                <option value="33%">33%</option>
            </select>
            <span id="error_potongan_pph" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Biaya Kirim Uang </label>
            <input type="text" class="form-control" id="biaya_kirim_uang" name="biaya_kirim_uang" value="" placeholder="" required>
            <span id="error_biaya_kirim_uang" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jumlah Diterima </label>
            <input type="text" class="form-control" id="jumlah_diterima" name="jumlah_diterima" value="" placeholder="" required>
            <span id="error_jumlah_diterima" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <label for=""> Keterangan </label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
            <span id="error_keterangan" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jenis SPJ </label>
            <select class="form-control" id="jenis_spj" name="jenis_spj" required>
                <option value="SPJ-LSG">SPJ-LSG</option>
                <option value="SPJ-LS BARANG JASA KIRIM">SPJ-LS BARANG JASA KIRIM</option>
                <option value="SPJ-UP/UG/TU">SPJ-UP/UG/TU</option>
            </select>
            <span id="error_jenis_spj" class="has-error"></span>
        </div>
        <div class="form-group col-md-12">
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <!-- <small><img id="loader" src="<?php echo site_url( 'assets/images/loadingg.gif' ); ?>"/></small> -->

      </div>
    </div>
    <!-- /.box-body -->
</form>

<script>
        // Ambil elemen-elemen yang diperlukan
    var potonganPPH = document.getElementById('potongan_pph');
    var biayaKirimUang = document.getElementById('biaya_kirim_uang');
    var jumlahPengajuan = document.getElementById('jumlah_pengajuan');
    var jumlahDiterima = document.getElementById('jumlah_diterima');

    // Tambahkan event listener untuk menghitung jumlah yang harus diterima saat nilai input berubah
    potonganPPH.addEventListener('change', hitungJumlahDiterima);
    biayaKirimUang.addEventListener('input', hitungJumlahDiterima);
    jumlahPengajuan.addEventListener('input', hitungJumlahDiterima);

    // Fungsi untuk menghitung jumlah yang harus diterima
    function hitungJumlahDiterima() {
        var potongan = parseFloat(potonganPPH.value) / 100 * parseFloat(jumlahPengajuan.value);
        var biayaKirim = parseFloat(biayaKirimUang.value);
        var total = parseFloat(jumlahPengajuan.value) - biayaKirim - potongan;
        
        // Jika hasilnya adalah bilangan negatif, atur jumlah diterima menjadi 0
        if (total < 0) {
            jumlahDiterima.value = 0;
        } else {
            jumlahDiterima.value = total;
        }
    }

    // Panggil fungsi pertama kali untuk menginisialisasi nilai jumlah diterima
    hitungJumlahDiterima();
//     $(document).ready(function () {
//     $('#create').validate({
//         rules: {
//             nama_penyedia: {
//                 required: true
//             },
//             nama_bank: {
//                 required: true
//             },
//             kode_kegiatan: {
//                 required: true
//             },
//             no_pesanan: {
//                 required: true
//             },
//             kode_rekening: {
//                 required: true
//             },
//             jumlah_pengajuan: {
//                 required: true,
//                 number: true // Ensure it's a valid number
//             },
//             potongan_pph: {
//                 required: true
//             },
//             biaya_kirim_uang: { // Add validation for biaya_kirim_uang
//                 required: true,
//                 number: true
//             },
//             jumlah_diterima: {
//                 required: true,
//                 number: true
//             },
//             keterangan: {
//                 required: true
//             },
//             jenis_spj: {
//                 required: true
//             }
//         },
//         messages: {
//             nama_penyedia: {
//                 required: 'Please enter Nama Penyedia'
//             }
//         },
//         submitHandler: function (form) {
//         var myData = new FormData($("#create")[0]);
//         console.log("Data yang dikirim:", myData); // Tambahkan console log di sini

//         $.ajax({
//             url: '<?php echo base_url('admin/add_data/create'); ?>',
//             type: 'POST',
//             data: myData,
//             dataType: 'json',
//             cache: false,
//             processData: false,
//             contentType: false,
//             beforeSend: function () {
//                 $('#loader').show();
//                 $("#submit").prop('disabled', true); // disable button
//             },
//             success: function (data) {
//                 if (data.status === 'success') {
//                     reload_table();
//                     notify_view(data.status, data.message);
//                     $('#loader').hide();
//                     $("#submit").prop('disabled', false); // enable button
//                     $("html, body").animate({scrollTop: 0}, "slow");
//                     $('#modalUser').modal('hide'); // hide bootstrap modal
//                 } else if (data.status === 'error') {
//                     if (data.errors) {
//                         $.each(data.errors, function (key, val) {
//                             $('#error_' + key).html(val);
//                         });
//                     }
//                     $("#status").html(data.message); // Change '#status' to '#status'
//                     $('#loader').hide();
//                     $("#submit").prop('disabled', false); // enable button
//                     $("html, body").animate({scrollTop: 0}, "slow");
//                 }
//             }
//         });
//     }
//     });
// });
</script>

