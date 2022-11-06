const gallery = document.querySelector('.gallery');
const popup = document.querySelector('.popup');
const selectedImage = document.querySelector('.selectedImage');

    image.addEventListener('dblclick',() =>{
        //popup stuff
        popup.style.transform = `translateY(0)`;
        selectedImage.src = "temp/<?php $file['image']?>";
        
    });

