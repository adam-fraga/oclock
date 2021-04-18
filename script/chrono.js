// -----------------------------------------------------CRONOMETRE-----------------------------------------------------
// Display selector
let spanMinChrono = document.querySelector('#displayMinChrono');
let spanSecChrono = document.querySelector('#displaySecChrono');
let spanMsChrono = document.querySelector('#displayMillisecChrono');
let listChrono = document.querySelector('#listChrono');


// Button
let addToList = document.querySelector('#addTime')
let startTime = document.querySelector('#startTime');
let stopTime = document.querySelector('#stopTime');
let resetTime = document.querySelector('#resetTime');


// Stock intervall fucntion to stop it with clearintervall method
let intervall = null;

// Set the time value to zero
let ms = 0;
let sec = 0;
let min = 0;

// Listenner on button start
startTime.addEventListener('click', function (e) {
    e.preventDefault();
    // Remove the display off button start and show the stop button
    startTime.classList.add('none');
    stopTime.classList.remove('none')
    stopTime.classList.add('block');

    //for eache 10ms do this function
    intervall = setInterval(function () {
        ms++;
        // Ternair fix the display of a value when that value is lower than 10
        ms < 10 ? spanMsChrono.innerHTML = `0${ms}` : spanMsChrono.innerHTML = `${ms}`
        if (ms === 100) {
            sec++;
            ms = 0;
            ms < 10 ? spanMsChrono.innerHTML = `0${ms}` : spanMsChrono.innerHTML = `${ms}`
            sec < 10 ? spanSecChrono.innerHTML = `0${sec}` : spanSecChrono.innerHTML = `${sec}`

            if (sec === 59) {
                min++
                sec = 0;
                ms = 0;
                ms < 10 ? spanMsChrono.innerHTML = `0${ms}` : spanMsChrono.innerHTML = `${ms}`
                sec < 10 ? spanSecChrono.innerHTML = `0${sec}` : spanSecChrono.innerHTML = `${sec}`
                min < 10 ? spanMinChrono.innerHTML = `0${min}` : spanMinChrono.innerHTML = `${min}`
            }
        }
    }, 10)
    // Activ the once true param to say execute this action one time and only one
},)

// Event on stop button
stopTime.addEventListener('click', function (e) {
    e.preventDefault();
    stopTime.classList.remove('block');
    stopTime.classList.add('none');
    resetTime.classList.remove('none');
    addToList.classList.remove('none');
    clearInterval(intervall);
})

// Event on reset button
resetTime.addEventListener('click', function (e) {
    e.preventDefault();
    // reset var chrono
    min = 0;
    sec = 0;
    ms = 0;
// Reset dom chrono
    spanMinChrono.innerHTML = '00';
    spanSecChrono.innerHTML = `00`;
    spanMsChrono.innerHTML = "00";

    resetTime.classList.add('none');
    addToList.classList.add('none');
    startTime.classList.remove('none')
})

// Event on + (add time) button
addToList.addEventListener('click', function (e) {
    let yourtime = document.createElement('li');
    yourtime.classList.add('text-center', 'text-green-500', 'text-lg');
    yourtime.innerHTML = spanMinChrono.innerHTML + ':' + spanSecChrono.innerHTML + ':' + spanMsChrono.innerHTML;
    listChrono.appendChild(yourtime);
},)