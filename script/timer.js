// Display selector
let spanHourTimer = document.querySelector('#displayHoursTimer');
let spanMinTimer = document.querySelector('#displayMinutesTimer');
let spanSecTimer = document.querySelector('#displaySecondsTimer');
// Error box
let errorTimer = document.querySelector('#errorTimer');
// button
let upBtn = document.querySelector('#upTimer');
let downBtn = document.querySelector('#downTimer');
let startBtn = document.querySelector('#playTimer')


// Event on form submit
document.forms["setTimer"].addEventListener('submit', function (e) {
    e.preventDefault();
    //Capture input
    let input = this;
    //Conver entry to int
    let h = parseInt(input["hours"].value);
    let m = parseInt(input["minutes"].value);
    let s = parseInt(input["seconds"].value);
    // Limit entry to 60
    if (h > 24 || h < 0 || m > 59 || m < 0 || s < 0 || s > 59) {
        errorTimer.innerHTML = "the hour cannot be greater than 24, minutes and seconds must be less than 60 ";
        return false;
    }
    // Check if entry isint
    else if (Number.isInteger(m) === false || Number.isInteger(s) === false || Number.isInteger(h) === false) {
        errorTimer.innerHTML = "Please enter an integer between 1 and 60..";
        return false;
    } else {
        // Fix display of one occurence
        h < 10 ? h = `0${h}` : '';
        m < 10 ? m = `0${m}` : '';
        s < 10 ? s = `0${s}` : '';

        // Insert values in  DOM
        spanHourTimer.innerHTML = `${h}`
        spanMinTimer.innerHTML = `${m}`
        spanSecTimer.innerHTML = `${s}`
    }
})

// COUNTDOWN PART
let start = null;

function timer() {
    // recup int val from node
    let s = parseInt(spanSecTimer.innerHTML);
    let m = parseInt(spanMinTimer.innerHTML);
    let h = parseInt(spanHourTimer.innerHTML);
    // Tant qu'il y a des secondes on les décrementes
    if (s !== 0) {
        s--;
        s < 10 ? spanSecTimer.innerHTML = `0${s}` : spanSecTimer.innerHTML = `${s}`

    }
        // sinon si les secondes arrivent a 0 et que les minutes sont différentes de 0 on décremente une minute et on rétablit les seconde a 59;
    //sinon si les secondes arrivents à 0 et que les heure arrivent a 0 mais qu'il reste des minutes  on applique la même règle
    else if (s === 0 && m !== 0 || s === 0 && h === 0 && m !== 0) {
        m--;
        s = 59;
        s < 10 ? spanSecTimer.innerHTML = `0${s}` : spanSecTimer.innerHTML = `${s}`
        m < 10 ? spanMinTimer.innerHTML = `0${m}` : spanMinTimer.innerHTML = `${m}`

    } else if (h !== 0) {
        h--;
        m = 59;
        s = 59;
        s < 10 ? spanSecTimer.innerHTML = `0${s}` : spanSecTimer.innerHTML = `${s}`
        m < 10 ? spanMinTimer.innerHTML = `0${m}` : spanMinTimer.innerHTML = `${m}`
        h < 10 ? spanHourTimer.innerHTML = `0${h}` : spanHourTimer.innerHTML = `${h}`

    } else if (h === 0 && m === 0 && s === 0) {
        alert('Time is up');
        clearInterval(start);
        return true;
    }
}

// Event listenner sur boutton play
startBtn.addEventListener('click', function (e) {
    // Execute fonction timer toute les 1seconde
    function startIntevall() {
        start = setInterval(function () {
            timer();
        }, 1000);
    }

    startIntevall();
})

upBtn.addEventListener('click', function (e) {
    e.preventDefault();
    let ho = spanHourTimer.innerHTML;
    ho = parseInt(ho);
    ho++;
    ho < 10 ? spanHourTimer.innerHTML = `0${ho}` : spanHourTimer.innerHTML = ho;
})

downBtn.addEventListener('click', function (e) {
    e.preventDefault();
    let ho = spanHourTimer.innerHTML;
    ho = parseInt(ho);
    if (ho > 0) {
        ho--;
        ho < 10 ? spanHourTimer.innerHTML = `0${ho}` : spanHourTimer.innerHTML = ho;
    }
})