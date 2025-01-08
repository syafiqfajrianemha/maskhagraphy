function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    const fileImage = new FileReader();
    fileImage.readAsDataURL(image.files[0]);

    fileImage.onload = function (e) {
        imgPreview.src = e.target.result;
    }
}
