// Set the date we're counting down to
var countDownDate = new Date("Sep 31, 2017 10:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id of days, minutes, hours, seconds

    /*document.getElementById("timer-days").innerHTML = days;*/
    document.getElementById("timer-hrs").innerHTML = hours;
    document.getElementById("timer-min").innerHTML = minutes;
    document.getElementById("timer-sec").innerHTML = seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        /*document.getElementById("timer-days").innerHTML = "0";*/
        document.getElementById("timer-hrs").innerHTML = "0";
        document.getElementById("timer-min").innerHTML = "0";
        document.getElementById("timer-sec").innerHTML = "0";
    }
}, 1000);