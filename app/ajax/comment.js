$(document).ready(function() {
    $(".commentButtonForm").submit(function () {
        var text = $('#commentText').val();
        var post_id = $(this).attr("id");
        comment($(this).attr("id"),text);
    });
});

function comment(id,comment) {
    var uri = id.slice(-1);
    $.ajax({
        url: "/comment/"+uri,
        type: "POST",
        data: {
            'post_id': id,
            'text': comment
        },
        dataType: "json",
        success: function(data) {
            if(data.result == 'success'){
                var count = parseInt($("#comText"+uri).html());
                $("#comText"+uri).html(count+1);
            }else{
                alert("Error");
            }
        }
    });
}