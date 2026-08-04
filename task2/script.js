const btn = document.getElementById('changeText');
const textparagraph = document.getElementById('lead');
btn.addEventListener('click', function () {
  textparagraph.innerText ="you can order now and eat the delicious dessert";
});
const btn2 = document.getElementById('changeLayout');
const featurette1 = document.getElementById('featurette1');
btn2.addEventListener('click', function () {
  featurette1.classList.toggle('flex-row-reverse');
});
const darkModeToggle = document.getElementById('darkModeToggle');
darkModeToggle.addEventListener('click', function () {
  document.body.classList.toggle('dark-mode');
  if (document.body.classList.contains('dark-mode')) {
    darkModeToggle.innerText = 'Light Mode';
  } else {
    darkModeToggle.innerText = 'Dark Mode';
  }
});
const donutimage = document.getElementById('donutimage');
donutimage.addEventListener('click', function () {
  donutimage.classList.toggle('rounded-circle');
});
