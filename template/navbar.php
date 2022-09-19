 <?php
  $username = $_SESSION['userinfo']['username'];
  $idkaryawan = $_SESSION['userinfo']['idkaryawan'];
  $user = selectSingleData("SELECT * FROM tb_login WHERE idkaryawan=$idkaryawan");
  $query = select("SELECT * FROM tb_karyawan INNER JOIN tb_login USING(idkaryawan)");
  $userDetail = getUserDetails($query, $user);
  $leveluser = getLevelUser($user['leveluser']);
  ?>
 <nav>
   <!-- Awal Navbar Menu -->
   <div class="name-role">
     <h3><?= $username; ?></h3>
     <p><?= $leveluser; ?></p>
   </div>
   <div class="profile">
     <img src="https://api.multiavatar.com/<?= $idkaryawan; ?>.svg" alt="avatars">
   </div>
   <!-- Akhir Navbar Menu -->

   <!-- Awal Dropdown Button -->
   <div class="arrow-down">
     <i class="fa-solid fa-angle-down"></i>
   </div>
   <!-- Akhir Dropdown Button -->

   <!-- Awal Dropdown Menu -->
   <div class="dropdown">
     <h4><?= $userDetail['namakaryawan']; ?></h4>
     <p><?= $user['idkaryawan']; ?></p>
     <hr>
     <div class="action-button">
       <a href="../logout.php">
         <i class="fa-solid fa-arrow-right-from-bracket"></i>
       </a>
     </div>
   </div>
   <!-- Akhir Dropdown Menu -->
 </nav>