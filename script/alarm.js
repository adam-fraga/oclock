// Alarm list
let alarmList = document.querySelector('#alarm-list');


// Display time alarm
let spanHourAlarm = document.querySelector('#displayHoursAlarm');
let spanMinutesAlarm = document.querySelector('#displayMinutesAlarm');
let spanSecondsAlarm = document.querySelector('#displaySecondsAlarm');
// Error message selector
let errorBoxAlarm = document.querySelector('#errorBoxAlarm');


// Update hour in real time each one second
setInterval(function () {
    let date2 = new Date();
    let secAlarm = date2.getSeconds();
    let minAlarm = date2.getMinutes();
    let hourAlarm = date2.getHours();

    // Fix display of the zero if h/m/s less than 10
    secAlarm < 10 ? secAlarm = `0${secAlarm}` : secAlarm = `${secAlarm}`;
    minAlarm < 10 ? minAlarm = `0${minAlarm}` : minAlarm = `${minAlarm}`;
    hourAlarm < 10 ? hourAlarm = `0${hourAlarm}` : hourAlarm = `${hourAlarm}`;

    //Insert into the dom the hour
    spanHourAlarm.innerHTML = `${hourAlarm}:`;
    spanMinutesAlarm.innerHTML = `${minAlarm}:`;
    spanSecondsAlarm.innerHTML = `${secAlarm}`;

}, 1000);


// Fetch prends en paramettre l'url du fichier encodé json du contenu de ma BDD et retourne une promesse
// Then est une methode de promesse permetant de capter la partie résolut d'une promesse'
// le resultat retourné doit être typé dans ce cas la json
//Il est possible de chainé then pour plusieurs traitements
fetch('alarmJson.php').then(res => res.json()).then(data => {
    for (let alarm of data) {
        // Create alarm to display
        // Applique un interval en vu de simuler l'heure
        let intervall = setInterval(() => {
            // Récup l'heure dans le dom
            let hourAlarm = spanHourAlarm.innerHTML
            let minAlarm = spanMinutesAlarm.innerHTML
            let secAlarm = spanSecondsAlarm.innerHTML


            //Format pour obtenir une string de l'heure et des alarmes en DB
            let alarmUser = `${alarm['heures']}:${alarm['minutes']}:00`;
            let currentHour = hourAlarm + minAlarm + secAlarm;

            // Affiche le message si l'heure concorde avec l'alarme
            if (alarmUser === currentHour) {
                alert(alarm['message']);
            }
        }, 1000);
    }
});
