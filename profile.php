<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>SteamBot</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<body style="background-color:#212529;">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .btn-group{
      position: absolute;
      bottom: 1%;
      }

      .btn-primary {
    color: #fff;
    background-color: #5865F2;
    border-color: #0d6efd;
    }
    </style>
  </head>
  <body>
<?php 
include_once("cfg.php");
?>

<header>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">SteamBot</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Cases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Knives</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Weaponskins</a>
        </li>
      </ul>
      <form class="d-flex">
      <?php          
            require __DIR__ . "/functions.php";
            require __DIR__ . "/discord.php";
          
            $auth_url = url($client_id, $redirect_url, $scopes);
            if (isset($_SESSION['user'])) {
              echo '<a href="profile.php"><button type="button" class="btn btn-success">Webhooks</button></a>&nbsp';
              echo '<a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>';
            } else {
              echo '<a href="' . $auth_url . '">' . '<button type="button" class="btn btn-primary">Login with Discord</button></a>';
            }
      ?>
      </form>
    </div>
  </div>
</nav>
</header>

<main>
  <section class="album py-4 bg-dark">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light text-muted">Your Discord connections</h1>
        <p class="lead text-muted">Below you can see all your discord connections.</p>
      </div>
  </section>

  <div class="album py-5 bg-dark">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-3">
      <?php
      $username = $_SESSION['user_id'];
    //   echo 'Hello ' . $username . '<br>';
      $get_cases = mysqli_query($con,"SELECT * FROM bots WHERE username = $username");
      while($row = mysqli_fetch_array($get_cases))
					{
                    if(!$row['id'] == ''){
                      $id = $row['id'];
                      echo '<div class="col "><div class="card h-100 shadow-sm bg-dark">';
					  echo '<img src="' . $row['img'] .'" class="card-img-top" alt="...">';
                      echo '<div class="card-body">';
                      echo '<p class="card-text text-muted">' . $row['name'] . '</p><br>';
                      if(!$row['custom_name'] == ''){
                        echo '<p class="card-text text-muted"><b>Note: </b><br>' . $row['custom_name'] . '</p><br>';
                      }
                      echo '<div class="d-flex justify-content-between align-items-center">';
                      echo '<div class="btn-group ">';
                      if (isset($_SESSION['user'])) {
                        $_SESSION['r_id'] = $row['id'];
                        echo '<form action="remove.php" method="post">
                        <button type="submit" name="remove" class="btn btn-danger">Remove</button>';
                        echo '</form>';
                      } else {
                        echo '<a href="add.php?id=' . $row['id'] . '"><button type="button" class="btn btn-success">Login to add</button></a>';
                        
                      }
                      echo '</div></div></div></div></div>';
					}
                }
                    ?>
      </div>
    </div>
  </div>
</main>
<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Made with love by <a href="https://github.com/crilleaz/">Crilleaz</a></p>
  </div>
</footer>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
