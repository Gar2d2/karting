
let timerID=null;
let timerRunning = false;
stopclock = () =>
{
    
    timerRunning = !timerRunning;
}


showtime = () =>
{
    if(timerRunning)
    {
        let time = document.getElementById("zegarek").innerHTML;
        document.getElementById("zegarek").innerHTML = ++time;
        timerID = setTimeout("showtime()",1000);
        if(time>59)
        {
            document.getElementById("Zakoncz").click();
            timerRunning = false;
            window.alert("zakańczanie przejazdu");
            document.getElementById("usun").click();
        }

    }
}
startclock = () =>
{
    stopclock();
    showtime();
}
restart = () =>
{
    timerRunning = false;
    document.getElementById("zegarek").innerHTML = 0;
}