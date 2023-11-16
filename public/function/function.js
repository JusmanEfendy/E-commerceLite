// Menghilangkan pesan sukses setelah 5 detik
setTimeout(function () {
    let successAlert = document.getElementById("success-alert");
    if (successAlert) {
        successAlert.style.display = "none";
    }
}, 3000); // 3000 milidetik atau 3 detik

// meload gambar sebelum ditambahkan
function viewGambar() {
    const gambar = document.querySelector('#Gambar')
    const view = document.querySelector('.img-view')

    view.style.display = 'block'

    const oFReader = new FileReader()
    oFReader.readAsDataURL(gambar.files[0])

    oFReader.onload = function (oFREvent) {
        view.src = oFREvent.target.result
    }
}