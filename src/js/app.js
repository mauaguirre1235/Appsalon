let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // cambiar la seccion cuando se presione los tabs
}

function mostrarSeccion() {

    // ocultar las seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // seleccionar la seccion con el paso..
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnteriror = document.querySelector('.actual');
    if (tabAnteriror) {
        tabAnteriror.classList.remove('actual');
    }

    // Resalta el tab actual 
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}


function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();
        });
    })
}