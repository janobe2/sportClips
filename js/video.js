const divs = document.getElementsByClassName('tagTitle');
const title = document.getElementsByClassName('title');
const searchPref = document.getElementById('searchPreference');

//set up video settings
const players = Array.from(document.querySelectorAll('.js-player', {
    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'],
    settings: ['speed']
})).map(p => new Plyr(p));



function search(input) {
    //video search

    var showAll = false;
    var i = 0;

    //If nothing is typed into the search bar, show all
    if (input === '')
        showAll = true;

    if (!showAll) {

        //get type of search
        switch (searchPref.value) {
            //Search in tags
            case 'tag':
                for (i = 0; i < divs.length; i++) {
                    if (content[i].search(input) === -1) {
                        divs[i].style.display = 'none';
                    }else{
                        divs[i].style.display = 'block';
                    }
                }
                break;
                //Search in titles
            case 'title':
                for (i = 0; i < divs.length; i++) {
                    if (title[i].textContent.search(input) === -1) {
                        divs[i].style.display = 'none';
                    }else{
                        divs[i].style.display = 'block';
                    }
                }
                break;
                //Search in titles and tags
            case 'both':
                for (i = 0; i < divs.length; i++) {
                    if (title[i].textContent.search(input) === -1 && content[i].search(input) === -1) {
                        divs[i].style.display = 'none';
                    }else{
                        divs[i].style.display = 'block';
                    }
                }
                break;

        }


    }else{
        for (i = 0; i < divs.length; i++) {
                divs[i].style.display = 'block';
        }
    }
}