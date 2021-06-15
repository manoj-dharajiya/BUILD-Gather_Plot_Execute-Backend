var business_logo = "";
(function ($) {
    function isValidEmail(email) {
        var pattern = new RegExp(
            /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
        );
        return pattern.test(email);
    }

    var editCategoryHtml = $("#edit_parent_category").html();

    $(".show-comment-action").on("click", function () {
        var id = $(this).data("id");

        var listData = requestList[id];
        var name = `${listData.fname} ${listData.lname}`;

        console.log("Name :", requestList, name);

        $("#show-comments .modal-title span").html(name);
        $("#show-comments .commnets-wrapper").html(listData.additional_info);

        $("#show-comments").modal("show");
        return false;
    });

    $(".remove-action").on("click", function () {
        var result = confirm("Are you sure you want to delete?");
        if (!result) {
            return false;
        }
    });

    tinymce.init({
        selector: "textarea.tinymceEditor",
        height: 300,
        menubar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste code help wordcount",
        ],
        toolbar:
            "undo redo | " +
            "bold italic backcolor | alignleft aligncenter " +
            "alignright alignjustify | fontselect fontsizeselect formatselect |  bullist numlist outdent indent | " +
            "removeformat | help",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
    });
})(jQuery);
