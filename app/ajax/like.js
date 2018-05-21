$(document).ready(function() {
    $(".like").click(function () {
        var post_id = $(this).attr("id");
        like($(this).attr("id"));
    });
});

function like(id) {
    var uri = id.slice(-2);
    $.ajax({
        url: "/like/"+uri,
        type: "POST",
        data: {'post_id': id},
        dataType: "json",
        success: function(data) {
            if(data.result == 'success'){
                var count = parseInt($("#likes"+uri).html());
                $("#likes"+uri).html(count+1);
            }else{
                alert("Error");
            }
        }
    });
}