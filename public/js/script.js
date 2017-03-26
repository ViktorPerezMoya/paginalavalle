$(window).ready(function () {

    var total = $("#cabecera").height() + $("#div_menu").height() + $("#main").height() + 300;
    $("footer").css({position: 'absolute',top: total+"px"});

    if ($(window).width() <= 480) {
        cargarSliderMobilesServicios();
        activarFunciones();
    } else {
        cargarSliderNormalServicios();
        activarFunciones();
    }
    
    ////
    
});

function activarFunciones() {
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: false,
        spaceBetween: 30,
        loop: true
    });
}


function cargarSliderMobilesServicios() {
    $("#slider_servicios").html('<div class="swiper-wrapper">' +
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/telefonos"><i class="fa fa-phone a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-envelope-o a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '</div>' +
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-calendar a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-bus a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '</div>' +
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-hospital-o a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-camera-retro a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '</div>' +
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-graduation-cap a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="#"><i class="fa fa-paperclip a-servicos" aria-hidden="true"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>');
}

function cargarSliderNormalServicios() {
    $("#slider_servicios").html('<div class="swiper-wrapper"><div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/telefonos"><i class="fa fa-phone a-servicos" aria-hidden="true"></i></a><p class="data-serv">Telefonos de utlididad</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/tramites-web/reclamos-y-sugerencias"><i class="fa fa-envelope-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Contacto</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/turismo/agenda-cultural"><i class="fa fa-calendar a-servicos" aria-hidden="true"></i></a><p class="data-serv">Agenda</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/colectivos"><i class="fa fa-bus a-servicos" aria-hidden="true"></i></a><p class="data-serv">Horario de colectivos</p>' +
            '</div>' +
            '</div>' +
            
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/hospital"><i class="fa fa-hospital-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Hospital</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/familia"><i class="fa fa-users a-servicos" aria-hidden="true"></i></a><p class="data-serv">Familia</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/educacion"><i class="fa fa-graduation-cap a-servicos" aria-hidden="true"></i></a><p class="data-serv">Educacion</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/tramites-web/guia"><i class="fa fa-paperclip a-servicos" aria-hidden="true"></i></a><p class="data-serv">Tramites</p>' +
            '</div>' +
            '</div>'+
            
            '<div class="swiper-slide swiper-slide-servicio">' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/vivienda"><i class="fa fa-home a-servicos" aria-hidden="true"></i></a><p class="data-serv">Vivienda</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/cic"><i class="fa fa-building-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">C.I.C.</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/cultura"><i class="fa fa-paint-brush a-servicos" aria-hidden="true"></i></a><p class="data-serv">Cultura</p>' +
            '</div>' +
            '<div class="icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/desarrollo-humano"><i class="fa fa-handshake-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Desarrollo Humano</p>' +
            '</div>' +
            '</div>'+
            
            '</div>' +
            '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>');
}
