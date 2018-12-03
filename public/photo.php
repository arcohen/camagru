<?php 
include "./templates/header.php";
if (isset($_SESSION['username']) == NULL)
    header('Location: /public/login.php/?access=no');
?>

<body>
    <div class="columns photo-col">
        <div class="column">
            <div class="photo-div">
                <video id="video" width="320" height="240" autoplay></video>
                <form id="photo_form" action="/php/photo_merge.php" method="POST">
                    <select name="frame" id="options">
                        <option id="none" value="none">None</option>
                        <option id="fool" value="fool">Fool</option>
                        <option id="psy" value="psy">Psychedelic</option>
                        <option id="psy" value="flowers">Flowers</option>
                    </select>
                    <input type="hidden" name="image" id="img_tag">
                    <input type="button" name="Submit" id="snap" value="Take Photo">
                    <input type="submit" name="Save" id="submit">
                </form>
                <canvas id="canvas" width="320" height="240"></canvas>
            </div>
        </div>
        <div class="column">
            <?php
                include "../config/connection.php";
                $stmt = $conn->prepare("SELECT * FROM images WHERE username = ? ORDER BY id DESC");
                $stmt->execute([$_SESSION['username']]);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);    
                while ($row = $stmt->fetch()) {
                    echo '<div class="other-gallery">';
                        echo '<img src="' . $row['img'] . '">';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>

<?php include "templates/footer.php"; ?>
<script type="text/javascript" src="/js/script.js"></script>