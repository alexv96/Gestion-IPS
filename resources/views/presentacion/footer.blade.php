<!--address-->
<div class="address">
    <div class="container">
        <div class=" address-more">
            <h3>Dirección</h3>
            <div class="col-md-4 address-grid">
                <i class="glyphicon glyphicon-map-marker"></i>
                <div class="address1">
                    <p>Av. Marathon 1000</p>
                    <p>Ñuñoa, RM</p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 address-grid ">
                <i class="glyphicon glyphicon-phone"></i>
                <div class="address1">
                    <p>+(2) 2575 5601</p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 address-grid ">
                <i class="glyphicon glyphicon-envelope"></i>
                <div class="address1">
                    <p><a href="mailto:@example.com"> @example.com</a></p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--//address-->
</div>
<!--footer-->
<div class="footer">
    <div class="container">
        <div class="col-md-4 footer-top">
            <h3><a href="index.html">I<small>nstituto de</small> S<small>alud</small> P<small>ública</small></a></h3>
        </div>
        <div class="col-md-4 footer-top1">
            <ul class="social">
                <li><a href="#"><i> </i></a></li>
                <li><a href="#"><i class="dribble"> </i></a></li>
                <li><a href="#"><i class="facebook"> </i></a></li>
                <li><a href="#"><i class="fab fa-github"></i></a></li>
            </ul>
        </div>
        <div class="col-md-4 footer-top2">
            <p>© 2020 IPS. Todos los derechos reservados | Creado pot <a href="http://w3layouts.com/"
                    target="_blank">Alexis Valenzuela</a> </p>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@notify_js
  @notify_render
<script src="{{ asset('/front/js/jquery.min.js') }}"></script>
  
<script src="{{ asset('/front/js/frontRegistro.js')}} "></script>
<script src="{{ asset('/front/js/validarRut.js')}} "></script>
<script src="{{ asset('slick-1.8.1/slick.js')}}"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script>
$(document).ready(function(){
    $('.post-wrapper').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 8000,
        nextArrow: $('.next'),
        prevArrow: $('.prev')
    });
});
</script>
<script>
   (function () {
    'use strict';
        //INICIO MAPA [INDEX]
    var map = L.map('mapa').setView([-33.462758, -70.6175319], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([-33.462758, -70.6175319]).addTo(map)
        .bindPopup('<strong>Instituto de Salud Pública</strong>')
        .openPopup();
    })();
</script>
</body>

</html>