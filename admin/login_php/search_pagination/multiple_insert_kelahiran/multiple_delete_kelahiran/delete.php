<?php 
include "koneksi.php";

$id = $_POST['id'];
$query = "DELETE FROM ilkomfitria3 WHERE id IN(".implode(",", $id).")";

$sql = $pdo->prepare($query);
$sql->execute();

header("location: index.php");
?>