function viewImg() { 
    const preview = document.querySelector('.imgPreview');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
      }, false);
    
      if (file) {
        reader.readAsDataURL(file);
      }
}
