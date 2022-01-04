$(function() {
    $(document).ready(function(e) {
        $("#form-upload").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#uploadStatus").html("");

            $.ajax({
                    url: "../update-user/" + $(this).attr("user-id"),
                    type: "post",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .then((response) => {
                    console.log(response);
                    var attr = $("#image").attr('src');
                    if (typeof attr !== typeof undefined && attr !== false) {
                        $("#image").attr("src", response.image_url);
                    }
                })
                .catch((err) => {
                    $("#uploadStatus").html(err.responseJSON.errors);
                });
        });
    });
});