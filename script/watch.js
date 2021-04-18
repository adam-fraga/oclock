// HOUR
let horloge = document.querySelector('#displayHorloge')

// Update hour in real time each one second
setInterval(function () {
    let date = new Date();
    let sec = date.getSeconds();
    let min = date.getMinutes();
    let hour = date.getHours();

    // Fix display of the zero if h/m/s less than 10
    sec < 10 ? sec = `0${sec}` : sec = `${sec}`;
    min <  10 ? min = `0${min}` : min = `${min}`;
    hour < 10 ? hour = `0${hour}` : hour = `${hour}`;

    //Insert into the dom the hour
    horloge.innerHTML = `${hour}:${min}:${sec}`;
}, 1000);