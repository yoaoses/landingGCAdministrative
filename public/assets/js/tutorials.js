window.addEventListener('DOMContentLoaded', function() {
    // Obtener el texto del primer accordion-header
    var primerHeader = document.querySelector('.accordion-header button').textContent;

    // Imprimir el texto en la consola
    document.getElementById("sectionName").innerHTML=primerHeader;

    // Enviar un clic al primer botón dentro del accordion abierto
    var primerBoton = document.querySelector('.btn.btn-sm.btn-outline-primary.rounded.w-100');
    if (primerBoton) {
        primerBoton.click();
    }else{
        console.log("clickfallo")
    }
});


window.setText=(text,target)=>{
    document.getElementById(target).innerHTML=text;
}

function showMeTheVideo(video) {
    var url = 'https://www.youtube.com/embed/' + video;
    console.log(url);
    var iframe = '<iframe width="100%" height="100%" src="' + url + '" frameborder="0" allowfullscreen></iframe>';
    document.getElementById('insertIframeHere').innerHTML = iframe;
    var labelForRadio = document.querySelector('label[for="' + video + '"]'); // Obtener la etiqueta asociada al input radio
    setText(labelForRadio.textContent,"tutorialName"); // Obtener el texto del label
}
function displayCat(catButton){
    setText(catButton.innerHTML,"sectionName");
}