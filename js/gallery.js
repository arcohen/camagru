var comment = document.getElementsByClassName("comment-button");
var del = document.getElementsByClassName("delete-image");
var form = document.getElementsByClassName("delete-form");
var like = document.getElementsByClassName("like-button");
var swap = 1;

for (var i = 0; i < comment.length; i++)
{
    comment[i].addEventListener('click', function() {
        if (swap) {
            this.parentNode.parentNode.nextSibling.style.visibility = "visible";
            swap = 0;
        } else {
            this.parentNode.parentNode.nextSibling.style.visibility = "hidden";
            swap = 1;
        }
    });

    del[i].addEventListener("click", function(e) {
        if (confirm("Delete photo?") == true)
            e.target.nextSibling.submit();
    });

    like[i].addEventListener("click", function(e) {
            e.target.nextSibling.submit();
    });

}

