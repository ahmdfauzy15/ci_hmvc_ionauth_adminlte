<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">manage data
                    <button class="btn btn-success" onclick="create()"><i class="glyphicon glyphicon-plus"></i>
                        Add New data
                    </button>
                </p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <table id="manage_all" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama Penyedia</th>
                                <th>Nama Bank</th>
                                <th>Kode Kegiatan</th>
                                <th>No Pesanan</th>
                                <th>Kode Rekening</th>
                                <th>Jumlah Pengajuan</th>
                                <th>Potongan PPH</th>
                                <th>Biaya Kirim Uang</th>
                                <th>Jumlah Diterima</th>
                                <th>Keterangan</th>
                                <th>Jenis SPJ</th>
                                <th>#</th>

                            </tr>
                            </thead>

                            <tbody> <!-- Mulai tbody -->
                            <?php if(isset($query) && !empty($query)): ?>
                                <?php foreach($query as $row): ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo $row->nama_penyedia; ?></td>
                                        <td><?php echo $row->nama_bank; ?></td>
                                        <td><?php echo $row->kode_kegiatan; ?></td>
                                        <td><?php echo $row->no_pesanan; ?></td>
                                        <td><?php echo $row->kode_rekening; ?></td>
                                        <td><?php echo $row->jumlah_pengajuan; ?></td>
                                        <td><?php echo $row->potongan_pph; ?></td>
                                        <td><?php echo $row->biaya_kirim_uang; ?></td>
                                        <td><?php echo $row->jumlah_diterima; ?></td>
                                        <td><?php echo $row->keterangan; ?></td>
                                        <td><?php echo $row->jenis_spj; ?></td>
                                        <td style='text-align:center;'><a data-toggle='tooltip' class='btn btn-primary btn-xs edit'  id='" . $id . "' title='Edit'> <i class='fa fa-pencil-square-o'></i> </a>
				                        <a data-toggle='tooltip' class='btn btn-danger btn-xs  delete'  id='" . $id . "' title='Delete'> <i class='fa fa-trash-o'></i> </a></td>
                                    </tr>

                                    
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">No data available</td>
                                </tr>
                            <?php endif; ?>

                            </tbody> <!-- Selesai tbody -->

                            <!-- Tabel footer di sini diluar loop foreach -->
                            <tfoot>
                                <!-- Isi footer jika diperlukan -->
                            </tfoot>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--========================  User Modal  section =================-->
<div class="modal fade" id="modalUser" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="modal-title" id="myModalLabel"></p>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<div id="modal_data"></div>
			</div>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default"
				        data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>


<style>
	@media screen and (min-width: 768px) {
		#modalUser .modal-dialog {
			width: 75%;
			border-radius: 5px;
		}
	}
    /* Mengatur lebar minimum dari tombol agar tidak terlalu rapat */
/* Mengatur ukuran tombol */
.btn-group .btn {
    min-width: 70px; /* Sesuaikan dengan kebutuhan */
}

</style>

<!-- <script>
    // Fungsi untuk menampilkan form edit
    function edit(id) {
        // Mengirimkan permintaan AJAX untuk mendapatkan data yang akan diedit
        $.ajax({
            url: BASE_URL + 'admin/add_data/edit_form',
            type: 'POST',
            data: {id: id},
            success: function (response) {
                // Menampilkan data edit dalam modal
                $('#modal_data').html(response);
                $('.modal-title').text('Edit Data');
                $('#modalUser').modal('show');
            },
            error: function () {
                alert('Failed to load edit form');
            }
        });
    }

    // Fungsi untuk menyimpan pembaruan data
    function update() {
        // Mendapatkan data dari form edit
        var formData = $('#editForm').serialize();

        // Mengirimkan permintaan AJAX untuk menyimpan data yang telah diperbarui
        $.ajax({
            url: BASE_URL + 'admin/add_data/update',
            type: 'POST',
            data: formData,
            success: function (response) {
                // Memeriksa jika pembaruan berhasil
                if (response.status === 'success') {
                    // Menampilkan pesan sukses dan melakukan reload tabel
                    alert('Data updated successfully');
                    reload_table(); // Anda perlu mendefinisikan fungsi reload_table() sesuai dengan kebutuhan Anda
                } else {
                    // Menampilkan pesan gagal jika pembaruan gagal
                    alert('Failed to update data');
                }
            },
            error: function () {
                alert('Failed to update data');
            }
        });
    }
</script> -->

<script>

	function create() {

		$("#modal_data").empty();
		$('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title

		$.ajax({
			type: 'POST',
			url: BASE_URL + 'admin/add_data/create_form',
			success: function (msg) {
				$("#modal_data").html(msg);
				$('#modalUser').modal('show'); // show bootstrap modal
			},
			error: function (result) {
				$("#modal_data").html("Sorry Cannot Load Data");
			}
		});

	}

</script>

<script type="text/javascript">
	$(document).ready(function () {
		$("#manage_all").on("click", ".edit", function () {

			$("#modal_data").empty();
			$('.modal-title').text('Edit User'); // Set Title to Bootstrap modal title

			var id = $(this).attr('id');

			$.ajax({
				url: BASE_URL + 'admin/add_data/edit_form',
				type: 'POST',
				data: 'id=' + id,
				success: function (msg) {
					$("#modal_data").html(msg);
					$('#modalUser').modal('show'); // show bootstrap modal
				},
				error: function (result) {
					$("#modal_data").html("Sorry Cannot Load Data");
				}
			});
		});
	});
</script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $("#manage_all").on("click", ".edit", function () {
            var id = $(this).closest('tr').find('td:first').text(); // Mendapatkan id dari kolom pertama di baris tabel

            $("#modal_data").empty();
            $('.modal-title').text('Edit Data'); // Mengatur judul modal Bootstrap

            $.ajax({
                url: BASE_URL + 'admin/add_data/edit',
                type: 'POST',
                data: {id: id}, // Kirim id sebagai data ke controller
                success: function (msg) {
                    $("#modal_data").html(msg);
                    $('#modalUser').modal('show'); // Tampilkan modal Bootstrap
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });
    });
</script> -->