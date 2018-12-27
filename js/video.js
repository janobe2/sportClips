//set up video settings
const players = Array.from(document.querySelectorAll('.js-player', {
    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'],
    settings: ['speed']
})).map(p => new Plyr(p));

function search(input) {
//video search
    var divs = document.getElementsByClassName('tagTitle');
    var showAll = false;
    var i = 0;

    if (input === '')
        showAll = true;

    if (!showAll) {
        for (i = 0; i < divs.length; i++) {
            if (divs[i].textContent.search(input) === -1) {
                divs[i].style.display = 'none';
            }
        }
    }else{
        for (i = 0; i < divs.length; i++) {
                divs[i].style.display = 'block';
        }
    }
}