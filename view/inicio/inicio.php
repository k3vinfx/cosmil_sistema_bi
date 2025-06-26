<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="indexInterface.css" />
  </head>
        <style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: "Poppins", sans-serif;
}
section {
  padding: 3.5rem 0rem;
}
img {
  max-width: 100%;
}
.height-100 {
  height: 100%;
}
.width-auto {
  width: auto;
}
.object-fit-contain {
  object-fit: contain;
}
.container {
  width: 100%;
  max-width: 90%;
  margin: 0 auto;
}
.content {
  height: 100%;
  background: #f5f5f7;
  width: 100%;
  display: block;
}
.d-flex {
  display: flex;
  align-items: end;
}
.title {
  font-size: 2.5rem;
  font-weight: 600;
  flex-grow: 1;
  h3 {
    line-height: 3.2rem;
  }
}
.mb-2 {
  margin-bottom: 2rem;
}
.showcase {
  position: relative;
  .showcase-container {
    width: 100%;
    max-width: 90%;
    margin: 0 auto;
    display: flex;
  }
  .showcase-left {
    width: 60%;
    padding: 0 1rem;
  }
  .showcase-right {
    width: 60%;
    padding: 0 1rem;
  }
}

.carousel-indicator {
  display: flex;
  .carousel-indicator__button {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin: 0rem 0.5rem;
    cursor: pointer;
  }
  .carousel-indicator--active {
    //pointer-events: none;
    outline: 1px solid #d2d2d7;
    outline-offset: 0.25rem;
  }
  .pink {
    background: #e4544d;
  }
  .grey {
    background-color: #3c3d3a;
  }
  .blue {
    background: #2f506c;
  }
  .silver {
    background: #f5f4f0;
  }
  .green {
    background: #e7ece3;
  }
}
.carousel {
  display: flex;
  flex-wrap: nowrap;
  overflow: hidden;
  //width: 100%;
  .carousel-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    z-index: 1;
    display: flex;
    transition-property: transform;
    box-sizing: content-box;
    // transition-duration: 0.3s;
    transition: transform 1s cubic-bezier(0.645, 0.045, 0.355, 1) 0s;
  }
  .carousel-item {
    flex-shrink: 0;
    width: 100%;
    height: 100%;
    position: relative;
    transition-property: transform;
    display: block;
  }
}

.preview-image {
  height: 100%;
  display: grid;
  .preview-image__items {
    grid-area: 1/1/ 2/-1;
    opacity: 0;
    transition: opacity 1s cubic-bezier(0.645, 0.045, 0.355, 1) 0s;

    &.preview-image--active {
      opacity: 1;
      z-index: 1;
    }
  }
}


        </style>
  <body>
    <div class="landingpage">
      <div class="navbar">
        <a class="navlogo"><img src="assets/img/logo-negativo.png" alt="" /></a>
        <button class="hamburger">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="feather feather-menu"
          >
            <path d="M3 12h18M3 6h18M3 18h18" />
          </svg>
        </button>
        <div class="navlinkwrap">
          <span class="navlink selectedlink">Casa</span>
          <span class="navlink"><a href="inicio/login.php">Ingresar</a></span>
        </div>
        <div class="buttonwrap">
            <label id="switch" class="switch">
                <input class="botonTheme" type="checkbox" onchange="toggleTheme()" id="slider">
                <span class="slider round"></span>
            </label>
            <button class="createbtn navlink"><a href="?c=proveedor&a=Nuevo">LOGIN</a> </button>
          <button class="createbtn selectedlink selectedbtn"><a class="linkaa" href="assets/apk/vinetas.apk"> DESCARGAR APP</a></button>

        </div>
      </div>
      <div class="box">
        <div class="infobox">
          <p class="infobox-boldtext">
          Descubre lo Inexplorado: Viaja con Etreva Travel en La Paz
          </p>
          <p class="infobox-slimtext">
            
          </p>
          <div class="infobox-btnwrapper">
            <button class="infobox-explorebtn selected"><a class="linkaaa" href="?c=inicio&a=Registrate">Registrate</a> </button>
            <button class="infobox-createbtn"><a class="linkaa" href="?c=inicio&a=Login">Iniciar Sesion</a> </button>
          </div>
        </div>
        <div class="display">
          <img
            class="display-nft"
            src="assets/img/etreva_travel.jpg"
            alt="unsplash-OG44d93i-NJk"
            border="0"
          />
          <div class="infowrapper">
            <div class="info2">
            </div>
          </div>
        </div>
      </div>
      <section>
  <div class="showcase">
    <div class="container">
      <div class="d-flex mb-2">
        <div class="title">
        <p class="started-boldtext">Descubre<br> </p>
           <p class="started-slimtext">
            Explora ,Postea <br>
            Nuevas Alternativas Turisticas en La Paz.</p>
        
        </div>
        <div class="carousel-indicator">
          <div class="carousel-indicator__button silver"></div>
          <div class="carousel-indicator__button grey"></div>
          <div class="carousel-indicator__button blue"></div>
          <div class="carousel-indicator__button grey"></div>
          <div class="carousel-indicator__button green"></div>
        </div>
      </div>
    </div>

    <section>
  

    <div class="showcase-container">

      <div class="showcase-left">
        <div class="content">
          <div class="carousel height-100">
            <iv class="carousel-wrapper">
              <div class="carousel-item">
                <img src="assets/img/izq1.png" class="height-100 width-auto object-fit-contain" alt="">
              </div>
              <div class="carousel-item">
                <img src="assets/img/izq2.png" class="height-100 width-auto object-fit-contain" alt="">
              </div>
              <div class="carousel-item">
                <img src="https://www.apple.com/v/airpods-max/e/images/overview/design_colors_gray_front__bgkzj4cnbafm_medium.jpg" class="height-100 width-auto object-fit-contain" alt="">
              </div>
              <div class="carousel-item">
                <img src="https://www.apple.com/v/airpods-max/e/images/overview/design_colors_blue_front__ddfias5frxqq_medium.jpg" class="height-100 width-auto object-fit-contain" alt="">
              </div>
              <div class="carousel-item">
                <img src="https://www.apple.com/v/airpods-max/e/images/overview/design_colors_green_front__cqpeugza9as2_medium.jpg" class="height-100 width-auto object-fit-contain" alt="">
              </div>
          </div>
        </div>
      </div>

    <div class="showcase-right">
        <iv class="content">
          <div class="preview-image">
            <div class="preview-image__items">
            <p>Texto 1</p>   
           </div>
            <div class="preview-image__items">
            <p>Texto 2</p>
             </div>
            <div class="preview-image__items">
            <p>Texto 3</p>
                 </div>
            <div class="preview-image__items">
            <p>Texto 4</p>
             </div>
            <div class="preview-image__items">
            <p>Texto 5</p>
             </div>
          </div>
      </div>
    </div>

  </div>
</section>
<script>

let carouselBullets = document.querySelectorAll(".carousel-indicator__button");
let carouelWrapper = document.querySelector(".carousel");
let carouselItemList = document.querySelectorAll(".carousel-item");
let carouselWrapper = document.querySelector(".carousel-wrapper");
let previewImages = document.querySelectorAll(".preview-image__items");
let buttonAutoplayCarousel = document.querySelector(
  ".button-autoplay-carousel"
);
let buttonPauseCarousel = document.querySelector(".button-pause-carousel");

// Declare variables
let activeIndex;
let translateVal = 0;
let timeInterval;

// init function that add active class to elements
function init() {
  activeIndex = 0;
  carouselBullets[activeIndex].classList.add("carousel-indicator--active");
  carouselItemList[activeIndex].classList.add("carousel-item--active");
  previewImages[activeIndex].classList.add("preview-image--active");
}

// Carousel Bullet Click Function
carouselBullets.forEach(function (bullet, index) {
  bullet.addEventListener("click", function () {
    if (index == 0) {
      translateVal = 0;
    } else {
      translateVal = index * (-1 * 100);
    }

    // Remove Active Class
    carouselBullets[activeIndex].classList.remove("carousel-indicator--active");
    carouselItemList[activeIndex].classList.remove("carousel-item--active");
    previewImages[activeIndex].classList.remove("preview-image--active");

    // Add active Class
    bullet.classList.add("carousel-indicator--active");
    carouselItemList[index].classList.add("carousel-item--active");
    carouselWrapper.style.transform = "translateX(" + `${translateVal}%` + ")";
    previewImages[index].classList.add("preview-image--active");
    activeIndex = index;
  });
});

// Window Load
window.addEventListener("load", init());

</script>







      <div class="started">
        <p class="started-boldtext">Conocenos</p>
        <p class="started-slimtext">
        Bienvenidos a Etreva Travel, tu puerta de entrada a las maravillas ocultas de La Paz. Nuestros programas turísticos impulsados por redes neuronales recurrentes están diseñados para llevarte a una aventura única y personalizada.       </p>
        <div class="started-items">
          <div class="itemwrapper">
            <div class="started-items-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                <path
                  style="
                    stroke: none;
                    fill-rule: nonzero;
                    fill: #e0e0e0;
                    fill-opacity: 1;
                  "
                  d="M24.7969 14.6719c.4375-.4414.4375-1.1524 0-1.5938-.4414-.4375-1.1524-.4375-1.5938 0L16.5 19.7851l-2.9531-2.957c-.4414-.4375-1.1524-.4375-1.5938 0-.4375.4414-.4375 1.1524 0 1.5938l3.75 3.75a1.1246 1.1246 0 0 0 1.5938 0Zm0 0"
                />
                <path
                  style="
                    stroke: none;
                    fill-rule: evenodd;
                    fill: #e0e0e0;
                    fill-opacity: 1;
                  "
                  d="M18.8086.957a2.6005 2.6005 0 0 0-1.6172 0L4.8164 4.9688C3.7344 5.3202 3 6.3241 3 7.4648V15c0 9.2852 5.6563 16.0586 14.1016 19.246a2.5853 2.5853 0 0 0 1.7968 0C27.3438 31.0587 33 24.2853 33 15V7.4648a2.6182 2.6182 0 0 0-1.8164-2.496Zm-.9219 2.1368a.3738.3738 0 0 1 .2266 0l12.375 4.0117c.1601.0547.2617.1992.2617.3593V15c0 8.1914-4.9219 14.2227-12.6445 17.1367a.2815.2815 0 0 1-.211 0C10.172 29.2227 5.25 23.1914 5.25 15V7.4648c0-.1601.1016-.3046.2617-.3593Zm0 0"
                />
              </svg>
            </div>
            <p>Seguridad y Confianza</p>
          </div>
          <div class="itemwrapper">
            <div class="started-items-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                <path
                  style="
                    stroke: none;
                    fill-rule: evenodd;
                    fill: #bdbdbd;
                    fill-opacity: 1;
                  "
                  d="M4.125 3C2.6758 3 1.5 4.1758 1.5 5.625v5.25c0 1.4492 1.1758 2.625 2.625 2.625h27.75c1.4492 0 2.625-1.1758 2.625-2.625v-5.25C34.5 4.1758 33.3242 3 31.875 3Zm27.75 2.25H4.125c-.207 0-.375.168-.375.375v5.25c0 .207.168.375.375.375h27.75c.207 0 .375-.168.375-.375v-5.25c0-.207-.168-.375-.375-.375Zm0 0"
                />
                <path
                  style="
                    stroke: none;
                    fill-rule: nonzero;
                    fill: #bdbdbd;
                    fill-opacity: 1;
                  "
                  d="M4.125 15c.621 0 1.125.504 1.125 1.125v14.25c0 .207.168.375.375.375h24.75c.207 0 .375-.168.375-.375v-14.25c0-.621.504-1.125 1.125-1.125S33 15.504 33 16.125v14.25C33 31.8242 31.8242 33 30.375 33H5.625C4.1758 33 3 31.8242 3 30.375v-14.25C3 15.504 3.504 15 4.125 15Zm0 0"
                />
                <path
                  style="
                    stroke: none;
                    fill-rule: nonzero;
                    fill: #bdbdbd;
                    fill-opacity: 1;
                  "
                  d="M14.625 17.25c-.621 0-1.125.504-1.125 1.125s.504 1.125 1.125 1.125h6.75c.621 0 1.125-.504 1.125-1.125s-.504-1.125-1.125-1.125Zm0 0"
                />
              </svg>
            </div>
            <p>Explora Más Allá, Vive Más Allá</p>
          </div>
          <div class="itemwrapper">
            <div class="started-items-item">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="36"
                height="px"
                viewBox="0 0 36 31"
              >
                <path
                  style="
                    stroke: none;
                    fill-rule: evenodd;
                    fill: #bdbdbd;
                    fill-opacity: 1;
                  "
                  d="M2.832 2.9219c-.2148 0-.3867.1758-.3867.3906v24.375c0 .2148.1719.3906.3867.3906h4.9453l13.332-14.1875c1.0548-1.121 2.8165-1.1445 3.8985-.0508l8.5469 8.6407V3.3125c0-.2148-.1719-.3906-.3867-.3906Zm30.336 27.5156H2.832c-1.5039 0-2.7226-1.2305-2.7226-2.75V3.3125c0-1.5195 1.2187-2.75 2.7226-2.75h30.336c1.5039 0 2.7226 1.2305 2.7226 2.75v24.375c0 1.5195-1.2187 2.75-2.7226 2.75ZM22.8008 15.5156 10.996 28.0781H33.168c.2148 0 .3867-.1758.3867-.3906v-1.871L23.3594 15.5077a.388.388 0 0 0-.5586.0078Zm-9.4688-4.3398c0 1.5195-1.2187 2.75-2.7226 2.75-1.5 0-2.7188-1.2305-2.7188-2.75 0-1.5196 1.2188-2.75 2.7188-2.75 1.5039 0 2.7226 1.2304 2.7226 2.75Zm2.336 0c0 2.8242-2.2657 5.1094-5.0586 5.1094-2.789 0-5.0547-2.2852-5.0547-5.1094s2.2656-5.1094 5.0547-5.1094c2.793 0 5.0586 2.2852 5.0586 5.1094Zm0 0"
                />
              </svg>
            </div>
            <p> Experiencias Inolvidables</p>
          </div>
          <div class="itemwrapper">
            <div class="started-items-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                <path
                  style="
                    stroke: none;
                    fill-rule: evenodd;
                    fill: #bdbdbd;
                    fill-opacity: 1;
                  "
                  d="M30.9453.5a16.7245 16.7245 0 0 0-11.4687 4.5508l-2.0274 1.914a35.9135 35.9135 0 0 0-2.3984 2.4805h-7.836c-.957 0-1.8437.5-2.3359 1.3203L.668 17.7891c-.1952.3242-.2226.7226-.0702 1.0664.1523.3476.4609.5976.828.6758l7.1134 1.496c.0586.0782.125.1485.1992.2188l3.1054 2.914 2.9102 3.1016c.0703.0742.1406.1406.2188.1992l1.496 7.1133c.0782.3672.3282.6758.6758.8281a1.158 1.158 0 0 0 1.0664-.0703l7.0235-4.211a2.7222 2.7222 0 0 0 1.3203-2.3358v-7.836a36.8748 36.8748 0 0 0 2.4844-2.3984l1.9101-2.0274A16.7411 16.7411 0 0 0 35.5 5.0508l-.004-1.8281C35.496 1.7187 34.2774.5 32.7774.5Zm-6.7226 22.3398a39.89 39.89 0 0 1-1.582 1.1172l-5.2813 3.5196 1.0547 5.0156 5.621-3.3711c.1172-.0703.1876-.1992.1876-.336ZM8.5234 18.6406l3.5196-5.2812a34.8776 34.8776 0 0 1 1.1172-1.582H7.2148a.3952.3952 0 0 0-.3359.1913L3.508 17.586ZM21.0781 6.75a14.3862 14.3862 0 0 1 9.8672-3.918h1.832c.211 0 .3868.1758.3868.3907v1.828c0 3.672-1.3985 7.2032-3.9141 9.8712l-1.9102 2.0273a34.7388 34.7388 0 0 1-5.996 5.0664l-5.1133 3.4102-2.711-2.8906c-.0195-.0157-.0351-.0352-.0547-.0508l-2.8906-2.7149 3.4102-5.1172c1.457-2.1796 3.1523-4.1914 5.0625-5.9921Zm5.4766 5.0273c0 1.2891-1.043 2.332-2.332 2.332-1.2891 0-2.332-1.0429-2.332-2.332 0-1.289 1.0429-2.332 2.332-2.332 1.289 0 2.332 1.043 2.332 2.332ZM9.4453 32c1.3985-1.3984 1.3985-4.043 0-5.4453-1.4023-1.3985-4.0469-1.3985-5.4453 0-1.879 1.8828-2.246 6.0703-2.3164 7.3789a.3609.3609 0 0 0 .3828.3828C3.375 34.2461 7.5625 33.879 9.4454 32Zm0 0"
                />
              </svg>
            </div>
            <p>Profesionales Expertosl</p>
          </div>
        </div>
      </div>
  
 
      <div class="discover">
        <button class="discover-loadbtn"><a class="linkaaa" href="assets/apk/vinetas.apk">DESCARGAR</a> </button>
      </div>
      <div class="footer">
        <div class="footer-main">
          Nos adecuamos a las necesidades de tus requerimientos
        </div>
        <div class="footer-navigate">
          <div class="nav">
            <h5>Sistema web</h5>
            <p>Casa</p>
            <p>Iniciar Sesion</p>
            <p>Registrarse</p>
          </div>
          <div class="nav">
            <h5>Aplicacion Movil</h5>
            <p>Descargar</p>
            <p>QR</p>
            
          </div>
          <div class="nav">
            <h5>Contacto</h5>
            <p>Facebook</p>
            <p>Instagram</p>
            <p>Email</p>
          </div>
        </div>
      </div>
      <div class="footer2">
        <div></div>
        <p>Copyright 2022 Vinetas - Bolivia</p>
      </div>
    </div>
    <script src="sistemaT/sistema/js/theme.js"></script>




  </body>

  
<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/all.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/sweetalert2@10.js"></script>
<script type="text/javascript" src="assets/js/theme.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#table').DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay datos",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(Filtro de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron coincidencias",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        },
        "aria": {
          "sortAscending": ": Activar orden de columna ascendente",
          "sortDescending": ": Activar orden de columna desendente"
        }
      }
    });
  /*  var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
    searchForDetalle(usuarioid);*/
  });
</script>

</body>

</html>
</html>
