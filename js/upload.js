//Variables initialisation
const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
const errorRow = document.getElementById('noFiles');
const btnRemoveList = document.getElementById('removeAll');
const extraText = document.getElementById('extraText');
const table = document.getElementById('filesTable').getElementsByTagName('tbody')[0];
const btnSave = document.getElementById('btnSave');
const filesInput = document.getElementById('filesUpload');
const form = document.getElementById('uploadForm');
const process = document.getElementById('progressBar');
const successT = document.getElementById('successT');
const errorT = document.getElementById('errorT');
const btnAbort = document.getElementById('btnAbort');
var xhr = new XMLHttpRequest();
var abortPossible = false;

//Upload
form.onsubmit = function(event) {
    event.preventDefault();
    btnSave.disabled = true;
    process.disabled = false;
    //Change button abort
    btnAbort.innerHTML = 'Abbrechen';
    abortPossible = true;

    var videos = filesInput.files;
    var fd = new FormData();

    for (var i = 0; i < videos.length; i++) {
        fd.append("files[" + i + "]", videos[i]);
    }

    xhr.open('POST', '/sportClips/php/videoUpload.php', true);

    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            process.value = percentComplete;
        }
    };
    xhr.onload = function () {
        if (this.status == 200) {

            //Reset everything
            process.disabled = true;
            process.value = 0;
            btnSave.disabled = false;
            removeList();
            btnAbort.innerHTML = 'Fertig';
            abortPossible = false;
            //Show message
            successT.innerHTML = this.responseText;
        }
    };
    xhr.send(fd);
};

function refreshTable() {

    //Remove info
    if (filesInput.files.length > 0) {

        //clear list
        removeList();

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


function calculateSize(x) {

    let l = 0, n = parseInt(x, 10) || 0;
    while (n >= 1024 && ++l)
        n = n / 1024;

    //include a decimal point and a tenths-place digit if presenting
    //less than ten of KB or greater units
    return (n.toFixed(n < 10 && l > 0 ? 1 : 0) + ' ' + units[l]);
}


function removeList() {
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

    //Remove success message
    successT.innerHTML = '';

}

function abort(){
    if(abortPossible){

        //Abort uploading
        xhr.abort();
        abortPossible = false;
        btnAbort.innerHTML = 'Fertig';
        errorT.innerHTML = 'Hochladen wurde abgebrochen';

        //Reset page
        removeList();
    }else{
        window.location.href = '/sportClips/videolist.php';
    }
}