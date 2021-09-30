//add time blocks, in one hour increments from 9am to 5pm, each block has a save button on the right hand side that saves the info entered to local storage

//add current day at the top of the planner (moment)
var currentTime = moment().format("MMMM Do YYYY");
$("#currentDay").text(currentTime);

//variables for now (as a baseline time, use moment) and HTML time block (to change color relative to now)
var timeBlock = $(".hour");
var now = parseInt(moment().format("Hmm"));

//function to check each hour block to see if it is past (gray), present (red), or future (green).
$.each(timeBlock, function (i, hour) {
  var hourId = parseInt($(this).attr("id"));
  if (hourId < now-10) {
    $(this).next().addClass("past"); //highlights past time
  } else if (hourId > now) {
    $(this).next().addClass("future"); //highlights future time
  } else {
    $(this).next().addClass("present"); //highlights current time (by 10 minutes)
  }
});

