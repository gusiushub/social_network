function funcBefore () {
    $("#information").text("Ожидание данных...");
}

function funcSuccess () {
    $("#information").text(data);
}

$(document).ready(function () {
    $("#checkLogin").bind("click", function () {
        $.ajax({
            url:  "check.php",
            type: "POST",
            data: ({name: $("#login").val()}),
            dataType: "html",
            beforeSend: funcBefore ,
            success: funcSuccess
        });
    });

    $("#checkLogin").bind("click", function () {
        $.ajax({
            url:  "../../../app/views/main/register.php",
            type: "POST",
            data: ({name: $("#login").val()}),
            dataType: "html",
            beforeSend: function () {
                $("#information").text("Ожидание данных...");
            },
            success: function (data) {
                if (data == "Fail")
                    alert("Логин занят");
                else
                    $("#information").text(data);
            }
        });
    });
});
