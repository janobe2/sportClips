var set = true;

function checkAll ()
{
    var table = document.getElementById ('list');
    var val = set;
    for (var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].cells[0].children[0].checked = val;
    }
    set = !set;
}