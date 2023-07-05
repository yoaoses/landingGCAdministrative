<section>
<div class="container-fluid mainconteinerH">
    <div class="row ">
        <div class="col-md-5 ">
            <div class="card p-0 rounded cardsH">
            <div class="card-header">Secciones Disponibles</div>
            <div class="card-body p-0 ">

                <?php
                LandingController::generarAccordion();
                ?>
                  
            </div>
            <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-md-7 ">
            <div class="card rounded cardsH">
            <div class="card-header">
                <span id="sectionName">Secction</span>
                <span> / </span>
                <span id="tutorialName">videoName</span>
            </div>

            <div class="card-body" id="insertIframeHere">
                <span>Seleccione algun Video de la lista para empezar</span>
            </div>

            <div class="card-footer"></div>
            </div>
        </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://www.youtube.com/player_api"></script>
  <script src="assets/js/tutorials.js"></script>
  
</section>