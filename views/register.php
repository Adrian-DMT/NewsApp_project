<?php

require_once '../components/header.php';

$username = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = crypt($_POST['password'], 'qy2');

  if ($name != null && $username != null && $email != null && $password != null) {
    $userFromDb = $pdo->prepare("SELECT email, username FROM  users WHERE email = '$email' OR username='$username'");
    $userFromDb->execute();
    $currentUser = $userFromDb->fetchAll(PDO::FETCH_ASSOC);


    if ($currentUser == []) {
      $addUser = $pdo->prepare("INSERT INTO users ( name, username , email, password )
        VALUES( :name, :username, :email, :password)
");
      $addUser->bindValue(':name', $name);
      $addUser->bindValue(':username', $username);
      $addUser->bindValue(':email', $email);
      $addUser->bindValue(':password', $password);

      $addUser->execute();
      header("Location: /views/index.php?username=$username");
    } else {
      $err = "Username or email are not available";
    }
  } else {
    $err = "Username or email are not available";
  }
}


function checkSubmit(string $var)
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo ($_POST[$var]) ? $_POST[$var] : null;
  }
}

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="container w-3/5 mx-auto ">

  <div class="flex flex-col ">
    <label for="name" class="w-full text-base">Name</label>
    <input type="text" class="name px-3 py-2 grow text-base border-2 rounded" id="name" name="name" value="<?php checkSubmit('name') ?>">

    <div class="text-xs text-red-500">
      <?php if (isset($_POST['submit'])) {
        echo (!$_POST['name']) ? "Name is required" : null;
      } ?>
    </div>
  </div>

  <div class="flex flex-col mt-10">
    <label for="username" class="w-full text-base">Username</label>
    <input type="text" class="username px-3 py-2 grow text-base border-2 rounded" id="username" name="username" value="<?php checkSubmit('username') ?>">

    <div class="text-xs text-red-500">
      <?php if (isset($_POST['submit'])) {
        echo (!$_POST['username']) ? "Username is required" : null;
        if ($err != null && $_POST['username']) {
          echo $err;
        }
      } ?>
    </div>
  </div>

  <div class="flex flex-col mt-10">
    <label for="email" class="w-full text-base">Email address</label>
    <input type="email" class="email px-3 py-2 grow text-base border-2 rounded" id="email" name="email" value="<?php checkSubmit('email') ?>">
    <div class="text-xs text-red-500">
      <?php if (isset($_POST['submit'])) {
        echo (!$_POST['email']) ? "Email is required" : null;
        if ($err != null && $_POST['email']) {
          echo $err;
        }
      }
      ?>
    </div>
  </div>

  <div class="flex flex-col mt-10">
    <label for="password" class="w-full text-base">Password</label>
    <input type="password" class="password px-3 py-2 grow text-base border-2 rounded" id="password" name="password">
    <div class="text-xs text-red-500">
      <?php if (isset($_POST['submit'])) {
        echo (!$_POST['password']) ? "Password is required" : null;
      } ?>
    </div>
  </div>

  <div class="flex flex-col mt-10">
    <label for="password_confirmation" class="w-full text-base">Password</label>
    <input type="password" class="px-3 py-2 grow text-base border-2 rounded" id="password_confirmation" name="password_confirmation">
    <div class="text-xs text-red-500">
      <?php if (isset($_POST['password_confirmation'])) {

        if ($_POST['password'] == $_POST['password_confirmation']) {
          null;
        } else {
          echo "Passwords don't match!";
        }
      } ?>
    </div>
  </div>

  <div class="">
    <input type="checkbox" class="mt-5" id="check1">
    <label class="" for="check1">Remember me</label>
  </div>
  <button class="border rounded my-10 ml-16 px-10 py-1  bg-slate-200 hover:bg-slate-300"><input type="submit" name="submit" value="Submit"></button>

</form>

<footer class="">
  <div class="flex flex-row p-3 bg-green-500 ">
    <p class=" text-sm mx-auto px-3">&copy; 2023</p>
  </div>
</footer>

</body>

</html>