<?php include "menu.php";?>
<h2>Посты</h2>
<?php foreach ($posts as $post): ?>
    <a href="/post/<?=$post['id']?>"><?=$post['title']?></a><br>
<?php endforeach; ?>
