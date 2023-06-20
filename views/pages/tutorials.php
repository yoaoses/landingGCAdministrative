<section>
<div class="container-fluid maxHeight">
    <div class="row ">
        <div class="col-md-5">
            <div class="card rounded">
            <div class="card-header">Secciones Disponibles</div>
            <div class="card-body overflow">

                <div class="accordion" id="myAccordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button 
                            class="accordion-button" 
                            type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapseOne"
                            onclick="setText('SectionOne','sectionName')"
                            aria-expanded="true" aria-controls="collapseOne"
                        >
                          Sección 1
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#myAccordion">
                        <div class="accordion-body">
                          <ul>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('MDYSEq9pKdQ','Asmondgold','tutorialName')">Asmondgold ReactsTikTok CEO Testifies In Congress</a></li>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('iUrFW4JTv3c','HolaMundo','tutorialName')">Nunca es tarde para aprender a programar</a></li>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('Video 3','tutorialName')">Video 3</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button 
                            class="accordion-button collapsed" 
                            type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapseTwo"  
                            onclick="setText('SectionTwo','sectionName')"
                            aria-expanded="false" aria-controls="collapseTwo"
                        >
                          Sección 2
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#myAccordion">
                        <div class="accordion-body">
                          <ul>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('Video 4','tutorialName')">Video 4</a></li>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('Video 5','tutorialName')">Video 5</a></li>
                            <li><a href="#" class="video-link" onclick="showMeTheVideo('Video 6','tutorialName')">Video 6</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  
            </div>
            <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card rounded">
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