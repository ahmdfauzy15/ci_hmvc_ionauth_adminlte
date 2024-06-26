<?php
if ( $all ) {

	$no   = 1;
	$data = array();

	foreach ( $all as $value ) {

		$row = array();

		$id     = $value['id'];
		$status = $value['active'] == '1' ? "<strong style='color: #00bc1e; text-transform: uppercase;'>Active</strong>" : "<strong style='color: #ff5c29; text-transform: uppercase;'>In active</strong>";

		$url   = base_url( $value['file_path'] );

		$row[] = "<tr><td>" . $no ++ . "</td>";
		$row[] = "<td>" . $value['username'] . "</td>";
		$row[] = "<td>" . $value['email'] . "</td>";
		$row[] = "<td>" . $value['group_name'] . "</td>";
		$row[] = "<td>" . $status . "</td>";
        $row[] = "<td style='text-align:center;'><a data-toggle='tooltip' class='btn btn-primary btn-xs edit'  id='" . $id . "' title='Edit'> <i class='fa fa-pencil-square-o'></i> </a>
				  <a data-toggle='tooltip' class='btn btn-danger btn-xs  delete'  id='" . $id . "' title='Delete'> <i class='fa fa-trash-o'></i> </a></td></tr>";

        $data[] = $row;
	}

} else {
	$data = "";
}
//output to json format
$output = array(
	"data" => $data,
);
echo json_encode( $output );

// if ($all) {
//     $no = 1;
//     foreach ($all as $value) {
//         echo "<tr>";
//         echo "<td>" . $no++ . "</td>";
//         echo "<td>" . htmlspecialchars($value['nama_penyedia']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['nama_bank']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['kode_kegiatan']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['no_pesanan']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['kode_rekening']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['jumlah_pengajuan']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['potongan_pph']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['biaya_kirim_uang']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['jumlah_diterima']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['keterangan']) . "</td>";
//         echo "<td>" . htmlspecialchars($value['jenis_spj']) . "</td>";
//         echo "</tr>";
//     }
// } else {
//     echo "<tr><td colspan='13' class='text-center'>No records found</td></tr>";
// }