//add time blocks, in one hour increments, each block has a edit button on the right hand side that saves the info entered to local storage

//add current day at the top of the planner (moment)
var currentTime = moment().format("MMMM Do YYYY");
$("#currentDay").text(currentTime);

//variables for now (as a baseline time, use moment) and HTML time block (to change color relative to now)
var timeBlock = $(".hour");
var now = parseInt(moment().format("Hmm"));

//function to check each hour block to see if it is past (gray #B0C4DE), present (red #ff6961), or future (blue #87CEFA).
$.each(timeBlock, function (i, hour) {
  var hourId = parseInt($(this).attr("id"));
  if (hourId < now) {
    $(this).next().addClass("past"); //highlights past time
  } else if (hourId > now) {
    $(this).next().addClass("future"); //highlights future time
  } else {
    $(this).next().addClass("present"); //highlights current time
  }
});

//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

//button on press scrolls to the top of the document (shows up after scrolling down 20px)
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

//button on press scrolls to current time  (later add script to only show up on current date)
function ScrollCurrentTime() {
  var elmnt = document.getElementById(now);
  elmnt.scrollIntoView();
}


//adding events automatically from database  ---   check date on top -> chack database for that days events -> add events to specific times of the day
//adding data to new event window  ---  after pressing edit, check edit button's id(h:mm -> hmm) -> convert id to data to place in their respective fields(add events name to placeholder)
