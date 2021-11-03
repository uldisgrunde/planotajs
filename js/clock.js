window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
              window.setTimeout(callback, 1000 / 60);
          };
})();
 
// inicializēt pulksteni pašizsaukšanas funkcijā
(function clock(){
    var hour = document.getElementById("hour"),
        min = document.getElementById("min"),
        sec = document.getElementById("sec");
    // iestatīt cilpu
    (function loop(){
        requestAnimFrame(loop);
        draw();
    })();
 
    function draw(){
        var now = new Date(),//tagad
            then = new Date(now.getFullYear(),now.getMonth(),now.getDate(),0,0,0),//pusnakts
            diffInMil = (now.getTime() - then.getTime()),// starpība milisekundēs
            h = (diffInMil/(1000*60*60)),//stundas
            m = (h*60),//minūtes
            s = (m*60);//sekundes
 
        sec.style.webkitTransform = "rotate(" + (s * 6) + "deg)";
        hour.style.webkitTransform = "rotate(" + (h * 30 + (h / 2)) + "deg)";
        min.style.webkitTransform = "rotate(" + (m * 6) + "deg)";
    }
})();
