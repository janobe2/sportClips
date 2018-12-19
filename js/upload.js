//Variables initialisation
const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
const errorRow = document.getElementById('noFiles');
const btnRemoveList = document.getElementById('removeList');
const extraText = document.getElementById('extraText');
const table = document.getElementById('filesTable').getElementsByTagName('tbody')[0];
const btnSave = document.getElementById('btnSave');

function upload() {
    //var videos = document.getElementById();
}


/*
* <tr>
            <th scope="row">1</th>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>@twitter</td>
        </tr>
*
*
* */

function refreshTable() {
    var filesInput = document.getElementById('filesUpload');


    //Remove info
    if(filesInput.files.length > 0) {
        //"es wurde kein Video ausgewählt" row will be deleted
        errorRow.style.display = 'none';

        //enable remove every row in table button
        btnRemoveList.disabled = false;

        //show extra info text
        extraText.style.display = 'block';

        //Enable save button
        btnSave.disabled = false;
    }

    //Add information rows
    for (var i = 0; i < filesInput.files.length; i++) {

        //Create row
        var row = table.insertRow(table.rows.length);

        //in each row create two cells
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        //calcualte size into correct format
        var size = calculateSize(filesInput.files[i].size);

        //for every cell create one node
        var text1 = document.createTextNode(filesInput.files[i].name);
        var text2 = document.createTextNode(String(size));

        cell1.appendChild(text1);
        cell2.appendChild(text2);

    }

}


function calculateSize(x){

    let l = 0, n = parseInt(x, 10) || 0;
    while(n >= 1024 && ++l)
        n = n/1024;

    //include a decimal point and a tenths-place digit if presenting
    //less than ten of KB or greater units
    return(n.toFixed(n < 10 && l > 0 ? 1 : 0) + ' ' + units[l]);
}


function removeList(){
    //Remove all rows
    var tableHeaderRowCount = 2;
    var table = document.getElementById('filesTable');
    var rowCount = table.rows.length;
    for (var i = tableHeaderRowCount; i < rowCount; i++) {
        table.deleteRow(tableHeaderRowCount);
    }

    //show "es wurde kein Video ausgewählt" row
    errorRow.style.display = '';

    //enable remove every row in table button
    btnRemoveList.disabled = true;

    //show extra info text
    extraText.style.display = 'none';

    //disable save button
    btnSave.disabled = true;

}
