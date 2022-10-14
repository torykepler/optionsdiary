// noinspection JSUnresolvedFunction,JSUnresolvedVariable

$(document).ready(function (){
    $("#add-sale").on("click", function()
    {
        $("#add-modal").addClass('d-flex');
    });

    $("#add-sale-form").on("submit", function(e)
    {
        e.preventDefault();
        console.log($(this).serializeArray());

        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serializeArray(),
            success: function () {
                location.reload();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $("#diary-group-btn").on("click", function()
    {
        let status = $(this).data('status');

        if(status === "hidden")
        {
            $('#diary-table-grouped-by-ticker').show();
            $('#diary-table').hide();
            $(this).data('status', 'shown');
            $(this).text('Ungroup');
        }
        else
        {
            $('#diary-table-grouped-by-ticker').hide();
            $('#diary-table').show();
            $(this).data('status', 'hidden');
            $(this).text('Group');
        }
    });
});

function removeSellOption(id, route, csrf)
{
    console.log("removeSellOption called for id: ", id);

    const data = {
        'id' : id,
        '_token' : csrf
    }

    $.ajax({
        url : route,
        type: "POST",
        data: data,
        success: function (data) {
            console.log(data);
            location.reload();
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
