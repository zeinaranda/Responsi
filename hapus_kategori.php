<?php

require 'functions.php';

$id = $_GET["id"];

if (hapus_kategori($id) > 0) {
	echo "
				<script>
					alert('data berhasil dihapus!');
					document.location.href = 'kelola_kategori.php';
				</script>
		";
} else {
	echo "
			<script>
					alert('data gagal dihapus!');
					document.location.href = 'kelola_kategori.php';
				</script>
		";
}
