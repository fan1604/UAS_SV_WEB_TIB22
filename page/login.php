<?php
  if(!empty($user)) {
    ?>
    <script type="text/javascript">
      window.location.href="?p=home";
    </script>
  <?php
  }

?>

<!--ini bagian html-->
<form action="" method="post" class="form-signin">
        <h2 class="form-signin-heading">Silahkan Login</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="texT" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus >
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword"  name="password"  class="form-control" placeholder="Password" required>
        <button name="masuk" class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
      </form>

<!--ini bagian php-->
<?php
  if(isset($_POST['masuk'])){
   @$username = $_POST['username'];
   @$password = $_POST['password'];

    $sql = " SELECT * FROM user WHERE namauser = '$username'";
    $query = mysqli_query($koneksi, $sql);
    $cek = mysqli_num_rows($query);
   

    if($cek > 0){
      $data = mysqli_fetch_array($query);
      $password = md5($password);
      //echo $password;
      $pass_db = $data['password'];

      if($password == $pass_db){
        $_SESSION ['username'] = $username;
        $_SESSION ['level'] = $data['level'];
        $_SESSION ['iduser'] =$data['iduser'];

        ?>
        <script type="text/javascript">
          window.location.href ="?p=home";
          
        </script>
        <?php

      }else{
        ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Gagal!</strong> Password anda salah!.
        </div>
      </div>
    
      <?php
      }

    }else{
      ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Gagal!</strong> Username tidak ditemukan.
        </div>
      </div>
    
      <?php
    }
  }
?>

<!--ini bagian css-->
<style type="text/css">
  body {
  padding-top: 150px;
  padding-bottom: 40px;
  text-align: center;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
 
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>