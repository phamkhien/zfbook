$(document).ready(function () {
    $(".delete-record").click(function (event) {
        var name = $(this).attr("data-name");
        if (!confirm("Bạn có thực sự muốn xóa bản ghi: " + name + " ?")) {
            event.preventDefault();
        }

    });
});



