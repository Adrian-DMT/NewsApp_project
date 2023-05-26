<?php

require_once "../components/header.php";


$errors = [];
$username = $_GET['username'] ?? [];

if ($username === []) {
   header('Location: ../views/login.php');
}


$dataUsers = $pdo->prepare("SELECT * FROM comments  JOIN news ON  news.id = comments.id_news  JOIN  users ON users.id  = comments.id_user  WHERE users.username = '$username'");
$dataUsers->execute();
$users = $dataUsers->fetchAll(PDO::FETCH_ASSOC);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if ($users[0]['profile_image'] != '../images/no-image.jpg') {
      unlink($users[0]['profile_image']);
   }
   $image = $_FILES['image'];
   var_dump($image);
   if ($image['name'] == '') {
      $imagePath =  '../images/no-image.jpg';
   } else {
      $imagePath =  '../images/' . uniqid() . '-' . $image['name'];
   }

   move_uploaded_file($image['tmp_name'], $imagePath);

   $query = $pdo->prepare("UPDATE users SET profile_image = :image WHERE username = :username");
   $query->bindValue(':image', $imagePath);
   $query->bindValue(':username', $username);
   $query->execute();

   header('Location:../views/profile.php?username=' . $username);
}

?>

<main class="container grow w-3/5 mx-auto">

   <!-- PROFILE INAGE -->
   <img src="<?php echo ($users[0]['profile_image']) ? $users[0]['profile_image'] : '../images/no-image.jpg'  ?>" class="rounded-full object-cover w-60 h-60 mx-auto p-5" alt="image">

   <form action="" method="POST" enctype="multipart/form-data">
      <!--  -->
      <div class="">
         <input type="file" name="image" class="mx-auto" accept="image/png, image/jpg, image/jpeg">

      </div>
      <button class="border rounded w-48 px-6 py-2 my-3 mx-auto bg-slate-200 hover:bg-slate-300" type="submit">Change image</button>
   </form>
   <!-- USERNAME -->
   <p class="text-3xl font-bold mx-auto text-center pb-5"><?php echo $username; ?></p>

   <!-- POSTED COMMENTS -->
   <h2 class="text-xl">My comments</h2>
   <?php foreach ($users as $user) : ?>
      <div style="padding-bottom:1rem;">
         <?php if ($username == $user['username']) : ?>
            <p class="indent-4 pt-6 pb-2"><?php echo $user['comment'] ?></p>
            <a class="font-bold hover:text-green-500" href="<?php echo '/views/details.php?id=' . $user['id_news'] . '&username=' . $user['username'] ?>">See comment in details page ...</a>
            <hr>
      </div>

   <?php endif ?>

<?php endforeach ?>

</main>

<?php require_once "../components/footer.php"; ?>
