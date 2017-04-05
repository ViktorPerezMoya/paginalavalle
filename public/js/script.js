$(document).ready(function () {


    if ($(window).width() <= 800) {
        cargarSliderMobilesServicios();

        cambiarFooter();

        $("#cabecera").html("");
        $("#cabecera").html('<div style="margin-left: 20px;"><img class="img-responsive" src="http://localhost/paginamuni/public/img/header/logo.png"/></div>');
        $(".descripcion_notp").hide();
        $(".titul-noticia").css({"font-size": "18px"});
        $("#list_indicadores").hide();

        /*ubicacion*/
        $("#portada_seccion").removeClass("carousel-caption").css({"text-align": "justify", "margin": "1px 50px"});

        /*intendencia*/
        $("#descripcion-intendente").removeClass("descripcion-intendente");
        $("#descripcion-asesoria").removeClass("descripcion-asesoria");
        $("#descripcion-asesoria").css({"margin-top":" 50px"});
        /*menu */
         var total = $("#cabecera").height()  + $("#main").height() + 300;
         $("footer").css({position: 'absolute',top: total+"px"});
    } else {

        var total = $("#cabecera").height() + $("#div_menu").height() + $("#main").height() + 300;
        $("footer").css({position: 'absolute', top: total + "px"});
    }

});

$(window).resize(function () {
    if ($(window).width() <= 800) {
        location.reload();
    }
});

function cambiarFooter() {
    var position = $("#footer").position();
    var position2 = $(".redes_sociales").position();
    var tamanio = position2.bottom - position.top;
    $("#footer").css("height", tamanio + "px !important");
}

function cargarSliderMobilesServicios() {
    $("#slider_servicios").html('' +
            '<div class="item active">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/telefonos"><i class="fa fa-phone a-servicos" aria-hidden="true"></i></a><p class="data-serv">Telefonos de utlididad</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/tramites-web/reclamos-y-sugerencias"><i class="fa fa-envelope-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Contacto</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/turismo/agenda-cultural"><i class="fa fa-calendar a-servicos" aria-hidden="true"></i></a><p class="data-serv">Agenda</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/colectivos"><i class="fa fa-bus a-servicos" aria-hidden="true"></i></a><p class="data-serv">Horario de colectivos</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/hospital"><i class="fa fa-hospital-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Hospital</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/familia"><i class="fa fa-users a-servicos" aria-hidden="true"></i></a><p class="data-serv">Familia</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/educacion"><i class="fa fa-graduation-cap a-servicos" aria-hidden="true"></i></a><p class="data-serv">Educacion</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/tramites-web/guia"><i class="fa fa-paperclip a-servicos" aria-hidden="true"></i></a><p class="data-serv">Tramites</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/vivienda"><i class="fa fa-home a-servicos" aria-hidden="true"></i></a><p class="data-serv">Vivienda</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/cic"><i class="fa fa-building-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">C.I.C.</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/cultura"><i class="fa fa-paint-brush a-servicos" aria-hidden="true"></i></a><p class="data-serv">Cultura</p>' +
            '</div>' +
            '</div>' +
            '<div class="item">' +
            '<div class="col-md-6 icono-servicio">' +
            '<a href="http://localhost/paginamuni/public/servicios/desarrollo-humano"><i class="fa fa-handshake-o a-servicos" aria-hidden="true"></i></a><p class="data-serv">Desarrollo Humano</p>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<a class="left carousel-control" href="#carousel-servicios" role="button" data-slide="prev" style="background: white;width: 10%;">' +
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: orange;"></span>' +
            '<span class="sr-only">Previous</span>' +
            '</a>' +
            '<a class="right carousel-control" href="#carousel-servicios" role="button" data-slide="next" style="background: white;width: 10%;">' +
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: orange;"></span>' +
            '<span class="sr-only">Next</span>' +
            '</a>');
}