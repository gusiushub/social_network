
             jQuery(document).ready(function($){
              $("#commentBut").on("click",function () {
                  $.ajax({
                      type: 'POST',
                      url: 'comment.php',
                      data: "urname=SDSDSSD",
                      success: function (data) {
                          alert(data);
                      }
                  });
              });
          });
