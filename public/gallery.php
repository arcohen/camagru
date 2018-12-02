<?php
include "./templates/header.php";
?>

<body>


    <div id="gallery_con" class="columns is-multiline">
        <?php
            include "../config/connection.php";
            $stmt = $conn->query("SELECT * FROM images ORDER BY id DESC");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);    
            while ($row = $stmt->fetch()) {
                
                echo '<div class="column">';
                echo    '<header class="pic">';
                echo    '<div class="image_div">';
                echo        '<img class="image" src="' . $row['img'] . '">';
                echo        '<div class="comment-button"><i class="fas fa-comment"></i></div>';
                echo        '<i class="fas fa-trash delete-image"></i>';
                echo        '<form class="delete-form" action="/php/delete_image.php" method="POST"';
                echo            '<input type="submit" name="submit">';
                echo        '</form>';
                echo    '</div>';
                echo    '</header>';
                echo    '<figcaption classd="gallery_comm">';
                echo    '<form class="comment_input" action="/php/comment.php" method="POST">';
                echo        '<input class="comment_box" type="text" name="comment" maxlength="100">';
                echo        '<input type="hidden" name="img_id" value=' . $row["id"] . '>';  
                echo        '<input type="submit" name="submit" value="Comment">';
                echo    '</form>';
                $img_id = $row['id'];
                $sql = $conn->query("SELECT * FROM comments WHERE img_id = $img_id ORDER BY id DESC");
                $sql->setFetchMode(PDO::FETCH_ASSOC);

                while ($com = $sql->fetch()) {
                    echo $com['username'] . ": " . $com['comment'] . "<br>";
                }

                echo    '</figcaption>';
                echo '</div>';

            }
        ?>
    </div>
        
    </body>

<?php include "templates/footer.php"; ?>
<script type="text/javascript" src="/js/gallery.js"></script>
