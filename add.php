<?php
session_start();
            if (!isset($_SESSION['user'])) {
                header('Location: ./index.php');
              }
?>

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
    .fill {
    min-height: 100vh;
    height: 100%;
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
        <!-- <h1 class="fw-light">CaseBot</h1> -->
        <!-- <p class="lead text-muted">Find your cases below and add them to your discord-server.</p> -->
        <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                if (strpos($url,'status=complete') !== false) {
                                    echo '<font color="green"><p class="lead text-muted">Successfully added to Discord!</p></font>';
                                }else if (strpos($url,'status=fail') !== false) {
                                    echo '<font color="red">Webhook must contain full URL-adress and minimum price must have comma. <br>Example Webhook: "https://discord.com/api/webhooks/988416001181900810/Cw7StbjnujfohQgXtCN3G1_8vzxSSsvseZkuXzjRXVwzxOF_xz-omz"</font>';
                                }
        ?>
        <?php 
        // echo 'User: ' . $_SESSION['username'] . '<br>';
        // echo 'Discrim: ' . $_SESSION['discrim'] . '<br>';
        // echo 'UserID: ' . $_SESSION['user_id'] . '<br>';

        if (isset(($_GET['id'])) && $_GET['id'] > 0) {
            if (!empty($_SESSION['user'])){
                session_start();
                $id = $_GET['id'];
                $_SESSION['g_id'] = $_GET['id'];
                
            }else{
                header('Location: ./index.php');
            }
        }else{
            header('Location: ./index.php');
        }
        
        ?>
      </div>
  </section>

  <div class="album py-5 bg-dark">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-3">
      <?php
       $get_cases = mysqli_query($con,"SELECT * FROM items WHERE id = $id");
       while($row = mysqli_fetch_array($get_cases))
	 				{
            session_start();
                       $items_img[] = $row['img'];
                       $items_name[] = $row['name'];
                       $items_url[] = $row['url'];
                       echo '<div class="col "><div class="card h-100 shadow-sm bg-dark">';
	 				             echo '<img src="' . $row['img'] .'" class="card-img-top" alt="...">';
                       echo '<div class="card-body">';
                       echo '<p class="card-text text-muted">' . $row['name'] . '</p><br>';
                       echo '<div class="d-flex justify-content-between align-items-center">';
                       echo '<div class="btn-group ">';
                       echo '</div></div></div></div></div>';
                       $_SESSION['g_item'] = implode($items_name);
                       $_SESSION['g_img'] = implode($items_img);
                       $_SESSION['g_url'] = implode($items_url);
                    }
        ?>
            <form action="add_case.php" method="post">
            <div class="mb-3">
                <label for="dcwebhook" class="form-label text-muted">Discord Webhook (Full URL)</label>
                <input type="text" class="form-control" name="dcwebhook" id="dcwebhook" aria-describedby="webhookHelp" required autofocus>
                <div id="webhookHelp" class="form-text"><a href="https://www.youtube.com/watch?v=K8vgRWZnSZw" target="_blank">Click here if you are having trouble finding your webhook.</a></div>
            </div>
            <div class="mb-3">
                <label for="steamvalue" class="form-label text-muted">Minimum price</label>
                <input type="text" class="form-control" name="steamvalue" id="steamvalue" placeholder="0,08" required>
                <div id="priceHelp" class="form-text">Enter minimum price to trigger notification messages.</div>
            </div>
            <div class="mb-3">
                <label for="custom_text" class="form-label text-muted">Note (50 characters)</label>
                <input type="text" class="form-control" name="custom_text" id="custom_text" placeholder="In #case-channel">
            </div>
            <button type="submit" name="add_case" class="btn btn-success">Add to Discord</button>
            </form>
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
