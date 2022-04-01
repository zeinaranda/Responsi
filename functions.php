<?php

$db = mysqli_connect("localhost", "root", "", "responsiweb");


function query($query)
{
	global $db;
	$result = mysqli_query($db, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_berita($data)
{
	global $db;
	// ambil data dari tiap elemen dalam form
	$gambar = $_FILES['gambar']['name'];
	$file_tmp = $_FILES['gambar']['tmp_name'];
	move_uploaded_file($file_tmp, "../img/$gambar");
	$hariini = date('Y-m-d');
	$judul = htmlspecialchars($data["judul"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$isi = $data["isi"];
	// query insert data
	mysqli_query($db, "INSERT INTO berita (judul,id_kategori,tanggal,isi,gambar)
	VALUES ('$judul','$kategori','$hariini','$isi','$gambar')");

	return mysqli_affected_rows($db);
}


function hapus_berita($id)
{
	global $db;
	mysqli_query($db, "DELETE FROM berita where id_berita=$id");
	return mysqli_affected_rows($db);
}

function ubah_berita($data)
{
	global $db;
	$id = $data["id_berita"];
	$judul = htmlspecialchars($data["judul"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$isi = $data["isi"];
	$gambar = $_FILES['gambar']['name'];
	$gambar_tmp = $_FILES['gambar']['tmp_name'];
	if ($gambar_tmp != "") {
		move_uploaded_file($gambar_tmp, "../img/$gambar");
		// query insert data
		mysqli_query($db, "UPDATE berita SET judul='$judul', id_kategori='$kategori',
		isi='$isi',gambar='$gambar' WHERE id_berita=$id");
	} else {
		mysqli_query($db, "UPDATE berita SET judul='$judul', id_kategori='$kategori',
		isi='$isi' WHERE id_berita=$id");
	}

	return mysqli_affected_rows($db);
}

function tambah_kategori($data)
{
	global $db;
	// ambil data dari tiap elemen dalam form
	$kategori = htmlspecialchars($data["kategori"]);
	// query insert data
	mysqli_query($db, "INSERT INTO kategori (kategori) VALUES ('$kategori')");

	return mysqli_affected_rows($db);
}


function hapus_kategori($id)
{
	global $db;
	mysqli_query($db, "DELETE FROM kategori where id_kategori=$id");
	return mysqli_affected_rows($db);
}

function ubah_kategori($data)
{
	global $db;
	// ambil data dari tiap elemen dalam form
	$id = $data["id_kategori"];
	$kategori = htmlspecialchars($data["kategori"]);
	// query insert data
	mysqli_query($db, "UPDATE kategori SET kategori='$kategori' WHERE id_kategori=$id");

	return mysqli_affected_rows($db);
}
