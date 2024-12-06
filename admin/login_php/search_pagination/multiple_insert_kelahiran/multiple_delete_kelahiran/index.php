<html>
<head>
   <title>Multiple Delete Kelahiran</title>
   <!-- Load librari/plugin jquery nya -->
   <script src="js/jquery.min.js"></script>
</head>
<body>
   <h1>Multiple Delete Kelahiran</h1>

   <form method="post" action="delete.php" id="form-delete">
      <table border="1" cellpadding="6">
         <tr>
            <th><input type="checkbox" id="check-all"></th>
            <th>ID</th>
            <th>Tanggal Lahir</th>
            <th>Jumlah Kelahiran</th>
         </tr>
         <?php 
        include "koneksi.php";

        $sql = $pdo->prepare("SELECT * FROM ilkomfitria3");
        $sql->execute();

        $no = 1;
        while($data = $sql->fetch()){
         echo "<tr>";
         echo "<td><input type='checkbox' class='check-item' name='id[]' value='".$data['id']."'></td>";
         echo "<td>".$data['id']."</td>";
         echo "<td>".$data['tanggal_lahir']."</td>";
         echo "<td>".$data['jumlah_kelahiran']."</td>";
         echo "</tr>";

         $no++;
        }
         ?>
      </table>
      <hr>
      <button type="delete" id="btn-delete">HAPUS</button>
      <a href= "http://localhost/coba_kelurahan/login_php/search_pagination/multiple_insert_kelahiran" class="btn btn-search">Kembali</a>
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