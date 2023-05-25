<?php

require_once "../components/header.php";

$username = $_GET['username'] ?? '';

$search = $_GET['search'] ?? '';
if ($search) {
    $searchNews = $pdo->prepare("SELECT * FROM news WHERE title LIKE '%$search%'");
    $searchNews->execute();
    $allNews = $searchNews->fetchAll(PDO::FETCH_ASSOC);
}

?>


<main class="container w-3/5 mx-auto">
    <form action="" method="get" class="py-2">
        <input style="background-color:lightgray; border:1px solid gray;" class="w-full p-1 mt-2  rounded-md" type="search" name="search" value="Search">
    </form>

    <ul>
        <?php foreach ($allNews as $item) : ?>

            <li>
                <div class="flex flex-row">
                    <img style="width:128px; height:96px;" class=" float-left p-2  object-cover" src=<?php echo $item['urlToImage'] ?> alt="image">
                    <h2 class="font-bold"><?php echo $item['title'] ?></h2>
                </div>

                <a href="
                    <?php
                    if ($username) {
                        echo '/views/details.php?id=' . $item['id'] . '&username=' . $username;
                    } else {
                        echo  '/views/details.php?id=' . $item['id'];
                    }
                    ?>">Details ...</a>

            </li>
            <br>
        <?php endforeach; ?>

    </ul>

</main>

<?php require_once "../components/footer.php"; ?>