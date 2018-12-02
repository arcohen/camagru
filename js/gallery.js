var comment = document.getElementsByClassName("comment-button");
var del = document.getElementsByClassName("delete-image");
var form = document.getElementsByClassName("delete-form");
var like = document.getElementsByClassName("like-button");
var swap = 1;

for (var i = 0; i < comment.length; i++)
{
    comment[i].addEventListener('click', function(e) {
        if (swap) {
            e.path[4].childNodes[1].childNodes[0].style.display = "block";
            e.path[4].childNodes[1].childNodes[0].childNodes[0].focus();
            swap = 0;
        } else {
            e.path[4].childNodes[1].childNodes[0].style.display = "none";
            swap = 1;
        }
    });

    del[i].addEventListener("click", function(e) {
        e.target.nextSibling.submit();
    });

    like[i].addEventListener("click", function(e) {
        e.target.nextSibling.submit();
    });

}
