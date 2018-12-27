//Variables initialisation
const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
const btnRemoveList = document.getElementById('removeAll');
const extraText = document.getElementById('extraText');
const btnSave = document.getElementById('btnSave');
const filesInput = document.getElementById('filesUpload');
const form = document.getElementById('uploadForm');
const process = document.getElementById('progressBar');
const successT = document.getElementById('successT');
const errorT = document.getElementById('errorT');
const btnAbort = document.getElementById('btnAbort');
const videoPath = document.getElementById('videoPath');
var xhr = new XMLHttpRequest();
var abortPossible = false;

//Upload
form.onsubmit = function (event) {
    event.preventDefault();
    btnSave.disabled = true;
    process.disabled = false;
    //Change button abort
    btnAbort.innerHTML = 'Abbrechen';
    abortPossible = true;

    var videos = filesInput.files;
    var fd = new FormData();
    var tags = $('#videotags').tagsinput('items');
    fd.append("files[0]", videos[0]);
    fd.append('tags', tags);
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

    var fullPath = filesInput.value;
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        videoPath.value = filename;
    }

    //enable remove every row in table button
    btnRemoveList.disabled = false;

    //show extra info text
    extraText.style.display = 'block';

    //Enable save button
    btnSave.disabled = false;
}


function removeList() {

    //enable remove every row in table button
    btnRemoveList.disabled = true;

    //show extra info text
    extraText.style.display = 'none';

    //disable save button
    btnSave.disabled = true;

    //Remove success message
    successT.innerHTML = '';
    errorT.innerHTML = '';

    //reset form
    form.reset();
    $("#videotags").tagsinput('removeAll');
}

function abort() {
    if (abortPossible) {

        //Abort uploading
        xhr.abort();
        abortPossible = false;
        btnAbort.innerHTML = 'Fertig';
        errorT.innerHTML = 'Hochladen wurde abgebrochen';

        //Reset page
        removeList();
    } else {
        window.location.href = '/sportClips/videolist.php';
    }
}