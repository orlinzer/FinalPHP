"use strict";
// TODO: delete
let imagePickers = document.querySelectorAll('.image-picker');
let imagePickersLength = imagePickers.length;
for (let i = 0; i < imagePickersLength; i++) {
  let input = imagePickers[i].querySelector('input');
  let image = imagePickers[i].querySelector('img');

  input.addEventListener('change', () => {
    console.log("bla");
    image.src = input.value;
  });
}
