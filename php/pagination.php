<?php

include "/config/connection.php";
$stmt = $conn->query("SELECT * FROM images");
$total = $stmt->rowCount();

$limit = 12;

$pages = ceil($total / $limit);

if (isset($_GET['page'])) {
    $page = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    $offset = ($page - 1) * $limit;
}
else {
    $page = 1;
    $offset = 0;
}

$start = $offset + 1;
$end = min(($offset + $limit), $total);

if ($page > 0)
    $goback = '<a href="?page=1"><i class="fas fa-angle-double-left"></i></a> <a href="?page=' . ($page + 1) . '"><i class="fas fa-angle-left"></i></a>';
else
    $goback = '<span class="disabled">i class="fas fa-angle-double-left"></i></span> <span class="disabled"><i class="fas fa-angle-left"></i></span>';

if ($page < $pages)
    $goforward = '<a href="?page=' . ($page + 1) . '"><i class="fas fa-angle-right"></i></a> <a href="?page=' . $pages . '"><i class="fas fa-angle-double-right"></i></a>';
else
    $goforward = '<a class="disabled"><i class="fas fa-angle-right"></i></a> <a class="disabled"><i class="fas fa-angle-double-right"></i></a>';

$stmt = $conn->prepare("SELECT * FROM images ORDER BY id DESC LIMIT ?, ?");
$stmt->execute([$offset, $limit]);


?>