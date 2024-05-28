function changeServices(){
  x = document.getElementsByClassName("uslugilewo");
  y = document.getElementsByClassName("uslugiprawo");
  
  for(i=0; i<x.length; i++){
    x[i].classList.remove("animate__backInLeft");
    x[i].classList.add("animate__backOutLeft");
    y[i].classList.remove("animate__backInRight");
    y[i].classList.add("animate__backOutRight");
  }

  setTimeout(function(){
    for(i=0; i<x.length; i++){
      x[i].classList.remove("animate__backOutLeft");
      x[i].classList.add("animate__backInLeft");
      y[i].classList.remove("animate__backOutRight");
      y[i].classList.add("animate__backInRight");
    }
  }, 500);
  
}

function handShake(){
  z = document.getElementsByClassName('hand');
  z[0].classList.remove("animate__tada");
  setTimeout(function(){
    z[0].classList.add("animate__tada");
  }, 2000);
}

setInterval(changeServices, 7000);
setInterval(handShake, 10000);