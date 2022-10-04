$(document).ready(function (){
    $("#add-sale").on("click", function()
    {
        $("#add-modal").show();
    });

    $("#add-sale-form").on("submit", function(e)
    {
        e.preventDefault();
        console.log($(this).serializeArray());

        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serializeArray(),
            success: function (data) {
                console.log(data);
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
});
