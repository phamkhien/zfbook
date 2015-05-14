$(document).ready(function () {
    $(".delete-record").click(function (event) {
        var name = $(this).attr("data-name");
        if (!confirm("Bạn có thực sự muốn xóa bản ghi: " + name + " ?")) {
            event.preventDefault();
        }

    });

    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        yearRange: "-100:+0",
        monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
        monthNamesShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
        beforeShow:function(input) {
        $(input).css({
            "position": "relative",
            "z-index": 999
        });
    }
    });

    $("#submit-register").click(function (event) {
        var mat_khau = $('#mat_khau').val();
        var repeat_mat_khau = $('#repeat_mat_khau').val();
        if (mat_khau !== repeat_mat_khau) {
            alert('Mật khẩu không trùng khớp!');
            return false;
        }

    });
});



