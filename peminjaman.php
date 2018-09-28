<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "peminjaman";
$con = mysqli_connect($server, $username, $password) or
die("<h1>Koneksi Mysqli Error : </h1>" . mysqli_connect_error());
mysqli_select_db($con, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($con));
@$operasi = $_GET['operasi'];
Switch ($operasi) {
case "view":
$query_tampil_data_peminjaman = mysqli_query($con,"SELECT * FROM t_peminjaman") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($query_tampil_data_peminjaman)) {
$data_array[]=$data;
}

echo json_encode($data_array);
break;
case "insert":
@$nama = $_GET['nama'];
@$nama_barang = $_GET['nama_barang'];
@$alamat_peminjam = $_GET['alamat_peminjam'];
@$banyak_hari = $_GET['banyak_hari'];
$query_insert_data = mysqli_query($con, "INSERT INTO t_peminjaman (nama,nama_barang,alamat_peminjam,banyak_hari) VALUES('$nama','$nama_barang','$alamat_peminjam','$banyak_hari')");
if ($query_insert_data) {
echo "Data Berhasil Disimpan";
}
else {
echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
}
break;

case "get_data_peminjam_by_id":
@$id = $_GET['id'];
$query_tampil_data_peminjaman = mysqli_query($con, "SELECT * FROM t_peminjaman WHERE id='$id'") or die (mysqli_error($con));
$data_array = array();
$data_array = mysqli_fetch_assoc($query_tampil_data_peminjaman);
echo "[" . json_encode ($data_array) . "]";
break;

case "update":
@$nama = $_GET['nama'];
@$nama_barang = $_GET['nama_barang'];
@$alamat_peminjam = $_GET['alamat_peminjam'];
@$banyak_hari = $_GET['banyak_hari'];
@$id = $_GET['id'];
$query_update_data_peminjam = mysqli_query($con, "UPDATE t_peminjaman SET nama='$nama', nama_barang='$nama_barang', alamat_peminjam='$alamat_peminjam', banyak_hari='$banyak_hari' WHERE id='$id'");
if ($query_update_data_peminjam) {
echo "Update Data Berhasil";
}
else {
echo mysqli_error($con);
}
break;

case "delete":
@$id = $_GET['id'];
$query_delete_data_peminjam = mysqli_query($con, "DELETE FROM t_peminjaman WHERE id='$id'");
if ($query_delete_data_peminjam) {
echo "Data Berhasil Dihapus";
}
else {
echo mysqli_error($con);
}
break;
default:
break;
}
?>