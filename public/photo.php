<?php include "./templates/header.php"; ?>

<body>
    <div class="columns photo-col">
        <div class="column">
            <video id="video" width="320" height="240" autoplay></video>
            <form action="/php/photo_merge.php">
                <input type="hidden" name="image" class="img-tag">
                <select id="options">
                    <option id="none" value="none">None</option>
                    <option id="fool" value="fool">Fool</option>
                    <option id="psy" value="psy">Psychedelic</option>
                </select>
                <input type="submit" name="submit" id="snap" value="Take Photo">
            </form>
            <canvas id="canvas" width="320" height="240"></canvas>
        </div>
        <div class="column">
            Second column
        </div>
    </div>
</body>

<?php include "templates/footer.php"; ?>