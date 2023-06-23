    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-header">
                    <div class="input-group-sm">
                        <div class="d-flex justify-content-between">
                            <span class="input-group-text">Categorías</span>
                            <button class="btn btn-sm btn-outline-secondary input-group-button" 
                                    type="button" 
                                    id="btnEdit" 
                                    onclick="popModal()"  
                                    title="Editar Categorías"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="categoryForm" action="" method="post">
                        <?php
                            echo LandingController::loadCategories();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header overflow-auto">Videos</div>
                    <div class="card-body" id="videoList">
                    <?php
                        include '../views/partials/videoList.php';
                    ?>
                    </div>
            </div>
        </div>
        <div class="col-7">
        <div class="card">
            <div class="card-header overflow-auto">Contenido del Header</div>
            <div class="card-body">Contenido de la Card</div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edición</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <?php
                    include '../views/partials/modalVideos.php';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>



<script>
    const catForm = document.getElementById('categoryForm');
    const videoListContainer = document.getElementById('videoList');
    const radioButtons = document.querySelectorAll('input[name="cat"]');//OBTENER TODOS LOS RADIO NAME="cat"

    // Agregar eventos de clic a cada elemento de radio
    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener("click", function() {
            document.getElementById("categoryForm").submit();
        });
    });
    catForm.addEventListener('submit', function(event) {
        event.preventDefault(); //calcelar comportamiento default

        const formData = new FormData(form); // Obtener los datos del formulario
        // Realizar una solicitud AJAX para cargar el contenido del include
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Actualizar el contenido del include con la respuesta de la solicitud
                videoListContainer.innerHTML = xhr.responseText;
            }
        };
        xhr.open('POST', '', true); // Especificar la URL de la misma página
        xhr.send(formData);
    });

    const popModal=()=>{
        const editFormData = new FormData();

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../views/partials/videoList.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
            // La solicitud se completó exitosamente
            const response = xhr.responseText;
            // Hacer algo con la respuesta recibida
            console.log(response);
            } else {
            // Hubo un error en la solicitud
            console.error('Error en la solicitud. Código de estado: ' + xhr.status);
            }
        };
        // Enviar la solicitud con el objeto FormData
        xhr.send(editDormData);
    }
</script>






