<?php
require_once 'Models/Tools.php';
//    PDO instance
$Tool = new Tools();
//display alarms
$alarms = $Tool->displayAlarms();
//Error Box
$error = null;
//    Insertion des alarmes en BDD
if (isset($_POST['addAlarm'])):
    if (isset($_POST['minutes']) && isset($_POST['hours']) && isset($_POST['msg'])) {
        $min = $Tool->securePost($_POST['minutes']);
        $min = intval($min);
        $hour = $Tool->securePost($_POST['hours']);
        $hour = intval($hour);
        $msg = $Tool->securePost($_POST['msg']);
        if (is_int($min) && $min <= 59 && $min >= 0 && is_int($hour) && $hour <= 23 && $hour >= 0) {
            $Tool->insertAlarms($hour, $min, $msg);
        } else {
            $error = "<span class='text-red-500 text-center'>L'heure doit être comprise entre 0 et 23, les minutes doivent êtres comprises entre 0 et 59.</span>";
        }
    } else {
        $error = "<span class='text-red-500 text-center'>Vous devez saisir un nombre entier et remplir tout les champs.</span>";
    }
endif;
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--TW CSS-->
    <link rel="stylesheet" href="dist/tailwindComp.css">
    <link rel="stylesheet" href="css/style.css">
    <!--FAS-->
    <script src="https://kit.fontawesome.com/a95f1c7873.js" crossorigin="anonymous"></script>
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
    <!--Myscript-->
    <script type="text/javascript" src="script/timer.js" defer></script>
    <script type="text/javascript" src="script/watch.js" defer></script>
    <script type="text/javascript" src="script/chrono.js" defer></script>
    <script type="text/javascript" src="script/alarm.js" defer></script>
    <title>Oclock</title>
</head>
<body class="bg-black">
<header id="header" class="mt-20">
    <div>
        <nav id="nav" class="flex h-16">
            <ul class="w-10/12 flex justify-evenly content-center border-bronze  shadow-lg mx-auto">
                <li class="my-auto m border-r w-3/12  text-center border-gray-400">
                    <a href="#1" id="timer" class="text-gray-300 text-lg"><i
                                class="mx-1.5 text-lg text-gray-300 far fa-clock"></i>Timer
                    </a>
                </li>
                <li class="my-auto border-r w-3/12 text-center border-gray-400">
                    <a href="#2" id="chrono" class="text-gray-300 text-lg"><i
                                class="mx-1.5 text-lg text-gray-300 fas fa-stopwatch-20"></i>Chrono
                    </a>
                </li>
                <li class="my-auto border-r w-3/12 text-center border-gray-400">
                    <a href="#3" id="alarm" class="text-gray-300 text-lg"><i
                                class="mx-1.5 text-lg text-gray-300 far fa-bell"></i>Alarm
                    </a>
                </li>
                <li class="my-auto border-l w-3/12 text-center border-gray-400">
                    <a href="#4" id="watch" class="text-gray-300 text-lg"><i
                                class="mx-1.5 text-lg text-gray-300 far fa-clock"></i>Watch
                    </a>
                </li>
            </ul>
        </nav>
</header>
<main id="main">
    <section id="time-section" class="shadow-lg h-96 w-10/12 mx-auto rounded-b-lg border-bronze border-gray-500"
             style="background: no-repeat center url('https://i.pinimg.com/originals/6c/1f/28/6c1f288b4e3c5cedefc04690bc8ae429.jpg');background-size: cover">
        <h1 id="main-title" class="ml-10 font-bold text-2xl  text-white w-6/12 opacity-70 italic p-6">“Le Temps nous
            égare, le Temps nous étreint, le Temps nous est gare, le Temps nous est train.”</h1>
        <small class="ml-20 p-3 text-white font-bold opacity-70">Jacques Prévert</small>
    </section>
    <div id="main-content">
        <!--TIMER-->
        <div id="1"
             class="my-32 p-6 rounded-lg border-bronze mx-auto flex flex-col mt-16 bg-black bg-opacity-60 shadow-lg p-8 w-6/12 flex flex-col  justify-evenly content-center">
            <h2 class="text-white text-3xl text-yellow-300 mx-auto font-bold font-serif mb-10">Timer</h2>
            <h3 class="text-white text-5xl mx-auto font-bold"><span id="displayHoursTimer">00</span>:<span
                        id="displayMinutesTimer">00</span>:<span id="displaySecondsTimer">00</span></h3>
            <div class="mt-6 ">
                <div class="w-full ">
                    <div id="controller" class="mx-auto  w-3/12 mb-6">
                        <button id="downTimer"><i class="text-white text-3xl fas fa-arrow-circle-left"></i><
                        </button>
                        <button id="playTimer"><i class="text-white text-3xl fas fa-play-circle"></i><</button>
                        <button id="upTimer"><i class="text-white text-3xl fas fa-arrow-circle-right"></i></button>
                    </div>
                </div>
                <form id="setTimer" method="get" class="flex mx-auto flex-col">
                    <div class="flex w-10/12">
                        <div class="mx-auto">
                            <label class="text-white" for="setHourTimer">Hours</label>
                            <input required class="mx-auto w-8" name="hours" type="text" id="setHourTimer">
                        </div>
                        <div class="mx-auto">
                            <label class="text-white" for="setMinTimer">Minutes</label>
                            <input required class="mx-auto w-8" name="minutes" type="text" id="setMinTimer">
                        </div>
                        <div class="mx-auto">
                            <label class="text-white" for="setSecTimer">Seconds</label>
                            <input required class="mx-auto w-8" name="seconds" type="text" id="setSecTimer">
                        </div>
                        <div class="mx-auto">
                            <input required class="focus:outline-none text-white text-sm py-1 px-5 rounded-full bg-yellow-400 hover:bg-yellow-300 hover:shadow-lg"
                                   type="submit" value="Set">
                        </div>
                    </div>
                    <div id="errorTimer" class="text-red-500 text-center mx-auto">
                    </div>
                </form>
            </div>
        </div>
        <!--            Chrono-->
        <div id="2"
             class="my-32 p-6 rounded-lg border-bronze mx-auto flex flex-col mt-8 bg-black bg-opacity-60 shadow-lg p-8 w-6/12 flex flex-col  justify-evenly content-center">
            <h2 class="text-white text-3xl text-yellow-300 mx-auto font-bold font-serif mb-10">Stopwatch</h2>
            <h3 class="text-white text-5xl mx-auto font-bold"><span id="displayMinChrono">00</span>:<span
                        id="displaySecChrono">00</span>:<span id="displayMillisecChrono">00</span></h3>
            <div class="mt-6 ">
                <div class="w-full ">
                    <div id="controller" class="mx-auto flex justify-evenly  w-3/12 mb-6">
                        <button id="startTime"><i class="text-white text-3xl fas fa-play-circle"></i></button>
                        <button id="stopTime" class="none"><i class="text-white text-3xl fas fa-stop-circle"></i>
                        </button>
                        <button id="resetTime" class="none"><i class="text-white text-3xl fas fa-undo"></i></button>
                        <button id="addTime" class="none"><i class="text-white  text-3xl fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
                <div class="border flex flex-col w-3/6 mx-auto">
                    <h2 class="text-lg mx-auto text-white">Click on + to add your time</h2>
                    <hr>
                    <ul id="listChrono">
                    </ul>
                </div>
            </div>
        </div>
        <!--                WATCH-->
        <div id="4"
             class="my-32 p-6 rounded-lg border-bronze mx-auto flex flex-col mt-8 bg-black bg-opacity-60 shadow-lg p-8 w-6/12 flex flex-col  justify-evenly content-center">
            <h2 class="text-white text-3xl text-yellow-300 mx-auto font-bold font-serif mb-10">Watch</h2>
            <h3 class="text-white text-5xl mx-auto font-bold">
                <span id="displayHorloge">00:00:00</span>
        </div>
        <!--            Alarm-->
        <div class="my-32 p-6 rounded-lg border-bronze bg-black bg-opacity-60 mt-16 w-10/12 mx-auto">
            <div class="flex  justify-evenly ">
                <div class="w-1/2 text-center self-center">
                    <h2 class="text-white text-3xl text-yellow-300 mx-auto font-bold font-serif mb-10">Alarm</h2>
                    <h2 class="text-white text-5xl mx-auto font-bold"><span id="displayHoursAlarm">00:</span><span
                                id="displayMinutesAlarm">00:</span><span id="displaySecondsAlarm">00</span></h2>
                </div>
                <!-- Liste des alarmes -->
                <div class="w-2 p-6">
                    <h2 class="text-green-500 text-lg text-center bg-opacity-70 rounded-lg bg-black w-2/4 mx-auto">
                        My alarms</h2>
                    <ul id="alarm-list" class="text-center">
                        <?php foreach ($alarms as $alarm): ?>
                            <li class="text-green-500"><?= $alarm['heures'] . ':' . $alarm['minutes'] ?></li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
            <div class="w-full flex flex-col">
                <form method="POST" class="flex w-full" id="setAlarm">
                    <fieldset class="flex w-full justify-evenly">
                        <legend class="text-white ml-7 text-lg font-bold mb-5">Set your alarm</legend>
                        <div class="self-center">
                            <label class="text-white text-lg" for="hour">Heure</label>
                            <input required class="w-10 " name="hours" type="text" id="hour">
                        </div>
                        <div class="self-center">
                            <label class="text-white text-lg" for="minute">Minute</label>
                            <input required class="w-10" name="minutes" type="text" id="minute">
                        </div>
                        <div class="self-center">
                            <label class="text-white text-lg" for="msg">Message</label>
                            <textarea required name="msg" id="msg" cols="20" rows="1"></textarea>
                        </div>
                        <div class="self-center">
                            <button id="addAlarm" name="addAlarm" type="submit" value="submit"
                                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                Add
                            </button>
                        </div>
                    </fieldset>
                </form>
                <div id="errorBoxAlarm" class="text-center"><?= $error ?></div>
            </div>
        </div>
</main>
<footer class="text-yellow-300 text-center italic mt-16">
  <small>Oclock</small>
</footer>
</body>

</html>