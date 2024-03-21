<form action='<?php echo base_url('admin/add_data/update')?>' id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        <input type="hidden" name="id" value="<?php echo isset($query) && !empty($query) ? $query->id : 'id'; ?>"> <!-- Perbaikan: Periksa apakah $query tidak null -->
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nama Penyedia </label>
            <input type="text" class="form-control" id="nama_penyedia"value="<?php echo isset($query) && !empty($query) ? $query->nama_penyedia : 'nama_penyedia'; ?>" placeholder="" required>
            <span id="error_nama_penyedia" class="has-error"></span>
        </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for=""> Nama Bank NPWP </label>
                <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="<?php echo $query->nama_bank; ?>" placeholder="" required>
                <span id="error_nama_bank" class="has-error"></span>
            </div>
            <div class="form-group col-md-4 col-sm-12">
            <label for=""> Kode Kegiatan </label>
            <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" value="<?php echo $query->kode_kegiatan; ?>" placeholder="" required>
            <span id="error_kode_kegiatan" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> No Pesanan </label>
            <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" value="<?php echo $query->no_pesanan; ?>" placeholder="" required>
            <span id="error_no_pesanan" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Kode Rekening </label>
            <input type="text" class="form-control" id="kode_rekening" name="kode_rekening" value="<?php echo $query->kode_rekening; ?>" placeholder="" required>
            <span id="error_kode_rekening" class="has-error"></span>
        </div>

        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jumlah Pengajuan </label>
            <input type="text" class="form-control" id="jumlah_pengajuan" name="jumlah_pengajuan" value="<?php echo $query->jumlah_pengajuan; ?>" placeholder="" required>
            <span id="error_jumlah_pengajuan" class="has-error"></span>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Potongan PPH </label>
            <select class="form-control" id="potongan_pph" name="potongan_pph" required>
                <option value="<?php echo base_url('21%'); ?>">21%</option>
                <option value="<?php echo base_url('22%'); ?>">22%</option>
                <option value="<?php echo base_url('33%'); ?>">33%</option>
            
            <span id="error_potongan_pph" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Biaya Kirim Uang </label>
            <input type="text" class="form-control" id="biaya_kirim_uang" name="biaya_kirim_uang" value="<?php echo $query->biaya_kirim_uang; ?>" placeholder="" required>
            <span id="error_biaya_kirim_uang" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jumlah Diterima </label>
            <input type="text" class="form-control" id="jumlah_diterima" name="jumlah_diterima" value="<?php echo $query->jumlah_diterima; ?>" placeholder="" required>
            <span id="error_jumlah_diterima" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <label for=""> Keterangan </label>
            <textarea value="<?php echo $query->keterangan; ?>" class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
            <span id="error_keterangan" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Jenis SPJ </label>
            <select class="form-control" id="jenis_spj" name="jenis_spj" required>
                <option value="<?php echo base_url('spj-lsg'); ?>">SPJ-LSG</option>
                <option value="<?php echo base_url('spj-ls-barang-jasa-kirim'); ?>">SPJ-LS BARANG JASA KIRIM</option>
                <option value="<?php echo base_url('spj-up-ug-tu'); ?>">SPJ-UP/UG/TU</option>
            </select>
            <span id="error_jenis_spj" class="has-error"></span>
        </div>
            <!-- Tambahkan bagian lain dari form yang perlu di-edit disini sesuai dengan data yang ada -->
        <div class="form-group col-md-12">
                <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <small><img id="loader" src="<?php echo site_url('assets/images/loadingg.gif'); ?>"/></small>
         </div>
        
        <!-- Tambahkan bagian lain dari form yang perlu di-edit disini sesuai dengan data yang ada -->
        <p>Data not found</p> <!-- Tampilkan pesan jika data tidak ditemukan -->
    </div>
    <!-- Lanjutan form -->
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
</script>
<script>
	$(document).ready(function () {
		$('#loader').hide();
		$('#edit').validate({// <- attach '.validate()' to your form
			
			submitHandler: function (form) {

				var myData = new FormData($("#edit")[0]);

				$.ajax({
					url: BASE_URL + 'admin/add_data/update',
					type: 'POST',
					data: myData,
					dataType: 'json',
					cache: false,
					processData: false,
					contentType: false,
					beforeSend: function () {
						$('#loader').show();
						$("#submit").prop('disabled', true); // disable button
					},
					success: function (data) {

						if (data.type === 'success') {
							reload_table();
							notify_view(data.type, data.message);
							$('#loader').hide();
							$("#submit").prop('disabled', false); // disable button
							$("html, body").animate({scrollTop: 0}, "slow");
							$('#modalUser').modal('hide'); // hide bootstrap modal

						} else if (data.type === 'danger') {
							if (data.errors) {
								$.each(data.errors, function (key, val) {
									$('#error_' + key).html(val);
								});
							}
							$("#status").html(data.message);
							$('#loader').hide();
							$("#submit").prop('disabled', false); // disable button
							$("html, body").animate({scrollTop: 0}, "slow");

						}
					}
				});
			}
			// <- end 'submitHandler' callback
		});                    // <- end '.validate()'

	});
</script>