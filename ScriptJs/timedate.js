
gettheDate = () =>
{
    Todays = new Date();
    TheDate = "" + (Todays.getMonth()+1) + " / " + Todays.getDate() + " / " + (Todays.getYear()-100);
    document.getElementById("data").innerHTML = TheDate;

}

let timerID=null;
let timerRunning = false;

stopclock = () =>
{
    if(timerRunning)
    {
        clearTimeout(timerID);
    }
    timerRunning = false;
}


showtime = () =>
{
    
    let now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let timeValue = ""+((hours>12)?hours-12:hours);
    timeValue+= ((minutes<10) ? ":0":":") + minutes;
    timeValue+= ((seconds<10) ? ":0":":") + seconds;
    timeValue+= ((hours>=12) ? " P.M.":" A.M.");
    
    document.getElementById("zegarek").innerHTML=timeValue;
    timerID = setTimeout("showtime()",1000);
    timerRunning = true;
    console.log("showtime ")
}
startclock = () =>
{
    stopclock();
    gettheDate();
    showtime();
}
