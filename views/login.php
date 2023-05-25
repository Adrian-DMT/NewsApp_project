<?php
require '../components/header.php';

// check if user is logged in
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  if ($email != null) {

    $username = $_SESSION['username'];
    die();
  }
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = crypt($_POST['password'], 'qy2') ?? '';
    if ($email != null) {
      $userFromDb = $pdo->prepare("SELECT email, password, username FROM  users WHERE email = '$email'");
      $userFromDb->execute();
      $currentUser = $userFromDb->fetchAll(PDO::FETCH_ASSOC);

      if (!$currentUser) {
        $errMsg = "Incorect Credentials";
      } else {
        $username = $currentUser[0]['username'];
        if ($email == $currentUser[0]['email'] && $password == $currentUser[0]['password']) {
          $_SESSION = $currentUser[0];
          var_dump($_SESSION);
          header("Location: /views/index.php?username=$username");
        } else if ($email != $currentUser[0]['email'] || $password != $currentUser[0]['password']) {
          $errMsg = "Incorrect Credentials";
        }
      }
    } else {
      $errMsg =  "Email is required";
    }
  }
}

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="container w-3/5 mx-auto ">

  <div class="flex flex-col ">
    <label for="email" class="w-full text-base">Email address</label>
    <input type="email" class="px-3 py-2 grow text-base border-2 rounded" id="email" name="email" value="<?php if (isset($_POST['submit'])) {
                                                                                                            echo ($_POST['email']) ? $_POST['email'] : null;
                                                                                                          }  ?>">
    <div class="text-xs text-red-500">
      <?php if (isset($_POST['submit'])) {
        echo (!$_POST['email']) ? $errMsg : null;
        if (isset($errMsg)) {
          if ($errMsg != null && $_POST['email']) {
            echo $errMsg;
          }
        }
      } ?>
    </div>
  </div>


  <div class="flex flex-col mt-10">
    <label for="password" class="w-full text-base">Password</label>
    <input type="password" class="px-3 py-2 grow text-base border-2 rounded" id="password" name="password">
  </div>


  <div class="">
    <input type="checkbox" class="mt-5" id="exampleCheck1">
    <label class="" for="exampleCheck1">Remember me</label>
  </div>
  <button type="submit" class="border rounded mt-10 ml-16 px-10 py-1  bg-slate-200 hover:bg-slate-300"><input type="submit" name="submit" value="Submit"></button>
</form>
<footer class="">
  <div class="flex flex-row p-3 bg-green-500 ">
    <p class=" text-sm mx-auto px-3">&copy; 2023</p>
  </div>
</footer>
</body>

</html>