<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <style> 
        body {
            background-image: url("https://img.freepik.com/free-photo/anime-style-galaxy-background_23-2151133974.jpg?semt=ais_hybrid");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
        

    </style>
  
  </head>
  <body>

  <nav class="navbar navbar-expand-sm sticky-top navbar-dark" style="background-image: url(https://img.freepik.com/free-photo/anime-style-galaxy-background_23-2151133974.jpg?semt=ais_hybrid);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: scroll;">
        <div class="container-fluid">
          <span class="navbar-brand">Daily Journal</span>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" nav>Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Home</a></li>
                  <li><a class="dropdown-item" href="#">Article</a></li>
                  <li><a class="dropdown-item" href="#">Gallery</a></li>
                  <li><hr class="dropdown-divider"></li>
                </ul>
              </li>
            </ul>
            </form>
          </div>
        </div>
      </nav>  

  <div class="d-flex justify-content-center">
    <div class="row">
      <div class="container-md mt-5"
      
      style="background-image: url(https://img.freepik.com/free-photo/anime-style-galaxy-background_23-2151133974.jpg?semt=ais_hybrid);
              background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
      border-radius: 30px; border: 2px solid black; padding: 25px;">

      <?php 
      $username = "Devanda Feyza Alditya Ramadhani";
      $Password = "15485";
      ?>

      <div class="card" style="width: 30rem;">
  <h3 class="card-header text-center" style="background-color: rgba(13, 110, 253, 0.5)">
    Login
      </h3>
  <div class="container-md">
    <div class="row-md"><form action="tugasboostrap.html" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="type" class="form-control" id="username" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" required>
    <div id="emailHelp" class="form-text">Silahkan isi format dengan benar!</div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Login</button>
</form>
</div>
  </div>
</div>
      </div>
    </div>
  </div>

  <?php 
  if ($_REQUEST) {
    if ($_POST['username'] == "Devanda Feyza Alditya Ramadhani" and $_POST['password'] == "15485") {
      echo "benar";
    } else {echo "salah";}
  }
  ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<?php
}
?>