$(function() {
    $(".form-comment").hide();

    $(document).on("click", ".btn-showComment", function() {
        const postId = $(this).attr("post-id");
        $(`form[form-comment=${postId}]`).show();
        $(this).hide();
    });

    $("#btn-submit").on("click", function() {
        event.preventDefault;
        const content = $("#content").val();
        const title = $("#title").val();
        const showPost = $("#show-post");
        const error = $("#error");
        error.html("");
        if (title == "" || content == "") {
            error.html("Please fill in the title and content!");
            return false;
        }

        $.ajax({
                url: "../add-post/" + $(this).attr("user-id"),
                method: "post",
                data: {
                    title: title,
                    content: content,
                },
            })
            .then((response) => {
                showPost.before(function() {
                    return `<div>
                    <a href="../post-detail/ ${response.data.id}" class="post-title" >${response.data.title}</a>  
                    <p class="post-content" id="show-content">${response.data.content}</p>
                    <button class="btn-submit btn-showComment" type="button" post-id="${response.data.id}">Comment</button>
                    
                    <form action="/add-comment/${response.userId}/${response.data.id}" form-comment="${response.data.id}"
                    method="post" form-comment d-none" style="display:none">
                    <div class="form-group">
                        <input class="comment" type="text" name="comment" placeholder="comment ....">
                    </div>
                    <br>
                    <div class="row">
                        <button type="submit" class="btn-submit">Post Comment</button>
                    </div>
                    </form>
                    <hr>
                    `;
                });
            })
            .catch((error) => {
                return error;
            });
    });
});