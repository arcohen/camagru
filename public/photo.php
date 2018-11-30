<?php include "./templates/header.php"; ?>

<body>
    <div class="columns photo-col">
        <div class="column">
            <video id="video" width="320" height="240" autoplay></video>
            <form id="photo_form" action="/php/photo_merge.php" method="POST">
                <select name="frame" id="options">
                    <option id="none" value="none">None</option>
                    <option id="fool" value="fool">Fool</option>
                    <option id="psy" value="psy">Psychedelic</option>
                </select>
                <input type="hidden" name="image" id="img_tag">
                <input type="button" name="Submit" id="snap" value="Take Photo">
                <input type="submit" name="Save">
            </form>
            <canvas id="canvas" width="320" height="240"></canvas>
        </div>
        <div class="column">
            <?php
                
            ?>
        </div>
    </div>
</body>

<?php include "templates/footer.php"; ?>