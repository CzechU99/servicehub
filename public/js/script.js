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


const input = document.getElementById('wyszukiwanie_form_lokalizacja');
const suggestions = document.getElementById('suggestions');

input.addEventListener('input', function () {
  const query = input.value.trim();
  if (query.length > 2) { 
      fetch(`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=20&countrycodes=PL&q=${query}`)
        .then(response => response.json())
        .then(data => {
            suggestions.innerHTML = '';

            data.filter(item => {
                    
                    const { address } = item;
                    if (!address) return false;

                    const city = address.city || address.town || address.village || address.hamlet;
                    return city && city.toLowerCase().includes(query.toLowerCase());
                })
                .forEach(item => {
                    const { address } = item;

                    const city = address.city || address.town || address.village || address.hamlet || 'Nieznane miasto';
                    const state = address.state || 'Nieznane województwo';
                    const postcode = address.postcode || '';

                    if(postcode == ""){
                      formattedAddress = `${city}, ${state}`;
                    }else{
                      formattedAddress = `${city}, ${state}, ${postcode}`;
                    }

                    const span = document.createElement('p');
                    span.textContent = formattedAddress;
                    span.onclick = () => {
                        input.value = formattedAddress; 
                        suggestions.innerHTML = ''; 
                    };
                    suggestions.appendChild(span);
                });
        })
        .catch(error => console.error('Błąd pobierania danych:', error));
  } else {
      suggestions.innerHTML = ''; 
  }
});

document.addEventListener("DOMContentLoaded", function() {
  const inputField = document.querySelector(".lokalizacja2");
  const suggestionsContainer = document.getElementById("suggestions");

  function toggleSuggestions() {
    if (inputField === document.activeElement) {
      suggestionsContainer.style.display = "block";
    } else {
      suggestionsContainer.style.display = "none"; 
    }
  }

  inputField.addEventListener("focus", function() {
    toggleSuggestions();
  });

  document.addEventListener("click", function(event) {
    if (!inputField.contains(event.target) && !suggestionsContainer.contains(event.target)) {
      suggestionsContainer.style.display = "none"; 
    }
  });

});



document.addEventListener("DOMContentLoaded", function() {
  const lokalizacjaInput = document.querySelector(".lokalizacja2");
  const kmDiv = document.getElementById("km");
  const kmInput = document.querySelector(".km");

  function toggleKmVisibility() {
    if (lokalizacjaInput.value.trim() !== "") {
      kmDiv.style.display = "block";
      kmInput.style.display = "block";
    } else {
      kmDiv.style.display = "none";
      kmInput.style.display = "none";
    }
  }

  lokalizacjaInput.addEventListener("input", toggleKmVisibility);
  toggleKmVisibility();
});




// let slideIndex = 1;
// showSlides(slideIndex);

// function myFunction(n) {
//   // slideIndex += n;
//   console.log("Działa!");
//   console.log(slideIndex);
// }


// function plusSlides(n) {
//   slideIndex += n;
//   showSlides(slideIndex);
// }

// function currentSlide(n) {
//   showSlides(slideIndex = n);
// }

// function showSlides(n) {
//   let i;
//   let slides = document.getElementsByClassName("mySlides");
//   let dots = document.getElementsByClassName("dot");
//   if (n > slides.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = slides.length}
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].className += " active";
// }


