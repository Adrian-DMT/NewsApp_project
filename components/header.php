<?php

require_once "../components/data-api.php";
require_once "../components/data-db.php";

$username = "";
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $userFromDb = $pdo->prepare("SELECT email, password, username FROM  users WHERE email = '$email'");
  $userFromDb->execute();
  $currentUser = $userFromDb->fetchAll(PDO::FETCH_ASSOC);
  // echo '<pre>';
  // var_dump($currentUser);
  // echo '</pre>';
  $_SESSION = $currentUser[0];
  $username = $_SESSION['username'];
}

$activePage = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
  <link rel="stylesheet" href="../main.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style>
    .dropdown-content {
      display: none;
    }

    .pages:hover .dropdown-content {
      display: block;
    }
  </style>

  <title>News Detailes</title>
</head>

<body class="min-h-screen flex flex-col justify-between">

  <!-- HEADING -->
  <div style="margin-top:0;" class=" p-3 bg-green-500 flex flex-row justify-between">
    <h1 class="px-3"><a href="../views/index.php?username=<?= $username ?>" class="">LOGO<span class="font-bold text-red-500">NEWS</span></a>
    </h1>

    <div class="flex flex-row">
      <div class="<?php echo ($username) ? 'pages' : '' ?> ">
        <a href="<?php echo ($username) ? '#' : '../views/login.php' ?>" class="font-bold px-2 ">
          <?php echo ($username || $activePage == '/views/login.php') ?  $username : 'Log in' ?>
        </a>

        <div class="dropdown-content absolute none right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg">
          <a href="../views/profile.php?username=<?php echo $username; ?>" class="text-gray-700 block px-4 py-2 text-sm">Profile</a>

          <a href="../components/signout.php" class="text-gray-700 block w-full px-4 py-2 text-left text-sm">Sign out</a>

        </div>
      </div>

      <a href="<?php echo ($username) ? '#' : '../views/register.php' ?>" class="font-bold px-2">
        <?php echo ($username || $activePage == '/views/register.php') ?  '' : 'Register' ?>
      </a>

    </div>
  </div>