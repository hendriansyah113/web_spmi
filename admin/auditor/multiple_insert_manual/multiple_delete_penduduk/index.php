<html>
<head>
   <title>Multiple Delete</title>
   <!-- Load librari/plugin jquery nya -->
   <script src="js/jquery.min.js"></script>
</head>
<body>
   <h1>Multiple Delete</h1>

   <form method="post" action="delete.php" id="form-delete">
      <table border="1" cellpadding="6">
         <tr>
            <th><input type="checkbox" id="check-all"></th>
         <th>NO</th>
         <th>NIK</th>
         <th>NAMA</th>
         <th>TANGGAL LAHIR</th>
         <th>JENIS KELAMIN</th>
         <th>TELP</th>
         <th>ALAMAT</th>
         <th>AGAMA</th>
         <th>PEKERJAAN</th>
         </tr>
         <?php 
        include "koneksi.php";

        $sql = $pdo->prepare("SELECT * FROM ilkomfitria4");
        $sql->execute();

        $no = 1;
        while($data = $sql->fetch()){
         echo "<tr>";
         echo "<td><input type='checkbox' class='check-item' name='id[]' value='".$data['id']."'></td>";
         echo "<td>".$data['id']."</td>";
         echo "<td>".$data['nik']."</td>";
         echo "<td>".$data['nama']."</td>";
         echo "<td>".$data['tanggal_lahir']."</td>";
         echo "<td>".$data['jenis_kelamin']."</td>";
         echo "<td>".$data['telp']."</td>";
         echo "<td>".$data['alamat']."</td>";
         echo "<td>".$data['agama']."</td>";
         echo "<td>".$data['pekerjaan']."</td>";
         echo "</tr>";

         $no++;
        }
         ?>
      </table>
      <hr>
      <button type="delete" id="btn-delete">HAPUS</button>
   <a href="http://localhost/coba_kelurahan/login_php/penduduk/multiple_insert_penduduk" class="btn btn-search">Kembali</a>
   </form>

<script>
   $(document).ready(function(){
      $("#check-all").click(function(){
         if($(this).is(":checked"))
            $(".check-item").prop("checked", true);
         else
           $(".check-item").prop("checked", false);
    });
    
    $("#btn-delete").click(function(){
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?");

      if(confirm)
         $("#form-delete").submit();
    });
});
</script>
</body>
</html>