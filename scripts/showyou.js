
var slideIndex = 1;
var timer = null;
showSlides(slideIndex);

function plusDivs(n) {
  clearTimeout(timer);
  showSlides(slideIndex += n);
}

 
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n==undefined){n = ++slideIndex}
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }

  slides[slideIndex-1].style.display = "block";
  timer = setTimeout(showSlides, 5000);
} 