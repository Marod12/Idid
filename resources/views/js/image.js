// ----- input imagem -----
$('#input__img').on('click', function(e) {
    console.log('clicked')
    $('#mediaFile').click();
});
window.addEventListener("dragover", function(e) {
    e = e || event;
    e.preventDefault();
}, false);
window.addEventListener("drop", function(e) {
    e = e || event;
    e.preventDefault();
}, false);