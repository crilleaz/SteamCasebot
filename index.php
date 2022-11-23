<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track prices of your favorite steam market items!">
    <meta name="author" content="Crille#6623">
    <meta name="generator" content="Hugo 0.84.0">
    <title>SteamBot</title>
    <!-- Bootstrap core CSS -->
<link href="./css/bootstrap.min.css" rel="stylesheet">

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
    .card {
      border: 1px solid rgba(0,0,0,.125);
}

    /* @media (prefers-color-scheme: dark) {
    body {
        background-color: var(--bs-dark);
        color: var(--bs-light);
    }
} */
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
          <a class="nav-link" href="javascript:void(0)">Cases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Knives</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Weaponskins</a>
        </li>
      </ul>
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        <font color="white">
        <?php
          $query = mysqli_query($con, "SELECT * FROM bots");
          $numrows=mysqli_num_rows($query);
          echo "We've added a total of " . '<b>' . $numrows . '</b>' . " cases to Discord servers.";
          $query -> close();
        ?>
        </font>
        </a>
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
        <h1 class="fw-dark text-muted">SteamBot</h1>
        <p class="lead text-muted">
          Keep a hourly track on case prices directly on your discord server!<br>
        Find your cases below and add them to your discord-server.</p>

      </div>
  </section>
  <div class="album py-5 bg-dark">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-3">
      <?php
      $username = $_SESSION['user_id'];
      $get_cases = mysqli_query($con,"SELECT * FROM items");
      while($row = mysqli_fetch_array($get_cases))
					{
                      echo '<div class="col "><div class="card h-100 shadow-sm bg-dark">';
					            echo '<img src="' . $row['img'] .'" class="card-img-top" alt="...">';
                      echo '<div class="card-body">';
                      echo '<p class="card-text text-muted">' . $row['name'] . '</p><br>';
                      echo '<div class="d-flex justify-content-between align-items-center">';
                      echo '<div class="btn-group ">';
                      if (isset($_SESSION['user'])) {
                        echo '<a href="add.php?id=' . $row['id'] . '"><button type="button" class="btn btn-primary">Add to Discord</button></a>';
                      } else {
                        echo '<a href="' . $auth_url . '">' . '<button type="button" class="btn btn-primary">Add to discord</button></a>';
                      }
                      echo '</div></div></div></div></div>';
					} 
          ?>
      </div>
    </div>
  </div>
</main>
<footer class="text-muted py-5 bg-dark">
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
