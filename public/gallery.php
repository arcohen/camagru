<?php
include "./templates/header.php";
?>

<body>


    <div id="gallery-container" class="container">
            <?php
                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == 'yes')
                        $message = 'Photo Deleted';
                    else
                        $message = 'You can only delete your own photo';

                    echo '<div class="section is-size-3 has-text-centered">' . $message . '</div>';
                }

            ?>
        <div class="section">
            <div class="grid">
                <?php
                    include "../config/connection.php";
                    $stmt = $conn->query("SELECT * FROM images");
                    $total = $stmt->rowCount();
                    
                    $limit = 9;
                    if (isset($_GET['scroll']))
                        $limit = 5000;
                    
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
                    
                    if ($page > 1)
                        $goback = '<a href="/public/gallery.php?page=' . ($page - 1) . '" class="pagination-previous pag-buttons">Previous</a>';
                    else
                        $goback = '<a disabled class="pagination-previous pag-buttons">Previous</a>';

                    if ($page < $pages)
                        $goforward = '<a href="/public/gallery.php?page=' . ($page + 1) . '" class="pagination-next pag-buttons">Next page</a>';
                    else
                        $goforward = '<a disabled class="pagination-next pag-buttons">Next</a>';         
                    
                    
                    $stmt = $conn->prepare("SELECT * FROM images ORDER BY id DESC LIMIT :offset, :limit");
                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $stmt->fetch()) {
                        
                        echo '<div class="cell">';
                        echo    '<header class=" pic">';
                        echo    '<div class="image_div">';
                        echo        '<img class="image" src="' . $row['img'] . '">';
                        echo        '<div class="image-username">' . $row['username'] . '</div>';
                        echo        '<div class="comment-button"><i class="fas fa-comment"></i></div>';
                        echo        '<i class="fas fa-trash delete-image"></i>';
                        echo        '<form class="delete-form" action="/php/delete_image.php" method="POST"';
                        echo            '<input type="submit" name="submit">';
                        echo            '<input type="hidden" name="id" value=' . $row['id'] . '>';
                        echo            '<input type="hidden" name="username" value=' . $row['username'] . '>';
                        echo        '</form>';
                        echo        '<i class="fas fa-thumbs-up like-button"></i>';
                        echo        '<form class="like-form" action="/php/likes.php" method="POST"';
                        echo            '<input type="submit" name="submit">';
                        echo            '<input type="hidden" name="id" value=' . $row['id'] . '>';
                        echo            '<input type="hidden" name="username" value=' . $row['username'] . '>';
                        echo        '</form>';
                        $like_stmt = $conn->prepare("SELECT * FROM likes WHERE img_id = ?");
                        $like_stmt->execute([$row['id']]);
                        $likes_amount = $like_stmt->rowCount();
                        if ($likes_amount == 1)
                            echo        '<div class="image-likes">' . $likes_amount . ' like</div>';
                        else
                            echo        '<div class="image-likes">' . $likes_amount . ' likes</div>';
                        echo    '</div>';
                        echo    '</header>';
                        echo    '<figcaption class="gallery_comm">';
                        $img_id = $row['id'];
                        $sql = $conn->query("SELECT * FROM comments WHERE img_id = $img_id ORDER BY id DESC");
                        $sql->setFetchMode(PDO::FETCH_ASSOC);

                        while ($com = $sql->fetch()) {
                            echo $com['username'] . ": " . $com['comment'] . "<br>";
                        }


                        echo    '<form class="comment_input" action="/php/comment.php" method="POST">';
                        echo        '<input class="comment_box" type="text" name="comment" maxlength="100">';
                        echo        '<input type="hidden" name="img_id" value=' . $row["id"] . '>';  
                        echo        '<input id="comment-submit-button" type="submit" name="submit" value="Comment">';
                        echo    '</form>';

                        echo    '</figcaption>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="section">
        <nav class="pagination is-centered" role="navigation">
            <?php 
                
                if (isset($_GET['scroll'])) {
                   echo '<ul class="pagination-list">';
                   echo '<li><a href="/public/gallery.php" id="inifinite" class="pagination-link pag-buttons">Finite Scroll</a></li>';
                   echo '</ul>';
                } else {
                   echo $goback;
                   echo $goforward;
                   echo '<ul class="pagination-list">';
                   echo     '<li><a href="/public/gallery.php/?scroll=infinite" id="inifinite" class="pagination-link pag-buttons">Infinite Scroll</a></li>';
                   echo '</ul>';
                }

            ?>

        </nav>
    </div>

    </body>

<?php include "templates/footer.php"; ?>
<script type="text/javascript" src="/js/gallery.js"></script>
