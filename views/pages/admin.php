    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-header">
                    <div class="input-group-sm">
                        <div class="d-flex justify-content-between">
                            <span class="input-group-text">Categorías</span>
                            <button class="btn btn-sm btn-outline-secondary  input-group-button" 
                                    type="button" 
                                    id="btnEdit" 
                                    title="Acciones"
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false"
                            >
                                <i class="bi bi-caret-down-square"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item text-muted disabled">Opciones</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item" type="button" onclick="popModal('add')"data-bs-toggle="modal" data-bs-target="#addModal">Agregar</button></li>
                                <li><button class="dropdown-item" type="button" onclick="popModal('update')"data-bs-toggle="modal" data-bs-target="#addModal">Modificar</button></li>
                                <li><button class="dropdown-item" type="button">Something else here</button></li>
                            </ul>

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
                        echo LandingController::loadCatVideos($_POST['cat']??'');
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

    <!---modals--->
    <div class="modal fade" id="addModal" 
         data-bs-backdrop="static" 
         data-bs-keyboard="false" 
         tabindex="-1" aria-labelledby="addModalLabel" 
         aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="modalTitle">Agregar/Actualizar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modalForm" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-pencil"></i>Nombre Categoría</span>
                            <div class="form-floating">
                                <input type="text" class="form-control" oninput='checkInput(this)'id="catNameInput" name="catNameInput"placeholder="Nombre Categoría">
                                <input type="text" class="form-control d-none" id="catIdInput" name="catIdInput" placeholder="Nombre Categoría">
                                <label for="catNameInput">Nombre Categoría</label>
                            </div>
                    </div>
                    <!-- validaciones -->
                    <div class="text-center">
                        <div class="input-group" id="lenghtGroup">
                            <label class="input-group-text" id="inputLenghtSpan">
                                El contenido debe tener al menos 3 caracteres.
                            </label>
                            <label class="input-group-text" id="inputLenghtIcon">
                                
                            </label>
                        </div>
                        <div class="input-group" id="forbithCharGroup">
                            <label class="input-group-text text-muted" id="forbithenChar">
                                Caracteres no permitidos:  
                            </label>
                            <label class="input-group-text text-muted" id="chars"> [ ' " \ / . , : ; * ^ ` ? ] </label>
                            <label class="input-group-text text-muted" id="forbithenCharIcon">
                                
                            </label>
                        </div>
                    </div>
                    <!------------------>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnCatSave" class="btn btn-primary" data-bs-dismiss="modal" disabled>Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
<script>
    const catForm = document.getElementById('categoryForm');
    const videoListContainer = document.getElementById('videoList');
    const radioButtons = document.querySelectorAll('input[name="cat"]');//OBTENER TODOS LOS RADIO NAME="cat"
    const forbiddenChars = /['"\/.,:;*^`?]/; // Expresión regular para caracteres prohibidos (' " \)
    const inputLenghtSpan=document.getElementById("inputLenghtSpan");
    const inputLenghtIcon=document.getElementById("inputLenghtIcon");
    const forbithenChar=document.getElementById("forbithenChar");
    const forbithenCharIcon=document.getElementById("forbithenCharIcon");
    const chars=document.getElementById("chars");
    const btnCatSave=document.getElementById("btnCatSave");

    window.addEventListener('DOMContentLoaded', function() {
        const submittedFlag = sessionStorage.getItem('formSubmitted');
        if (!submittedFlag) {
            catForm.submit();
            sessionStorage.setItem('formSubmitted', 'true');
        }
    });

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
    const popModal = (selectedOption) => {
    let checkedRadioButton = document.querySelectorAll('.catRadio:checked');
    const selectedRadioButton=document.getElementById(checkedRadioButton[0].id);
    const modalFormulary=document.getElementById("modalForm");
    //console.log(selectedRadioButton);
        switch (selectedOption) {
            case "add":
                document.getElementById("modalTitle").innerHTML = "Agregar Nueva Categoría";
                modalFormulary.setAttribute("action","?pag=addNewCategory");
                break;
            case "update":
                document.getElementById("modalTitle").innerHTML = "Modificar Nombre";
                const label = document.querySelector('label[for="' + selectedRadioButton.id + '"]');
                document.getElementById("catNameInput").value = label.innerHTML;
                document.getElementById("catIdInput").value = selectedRadioButton.value
                checkInput(document.getElementById("catNameInput"));
                break;
            case "":
                break;
        }
    }
    const checkInput = (inputElement) => {
        //valida input del nombre, si es valido se habilita el boton guardar
        const inputValue = inputElement.value;
        forbithenChar.classList.remove("text-muted");
        forbithenCharIcon.classList.remove("text-muted");
        chars.classList.remove("text-muted");
        let err=0;
        if (inputValue.length < 3) {
            inputLenghtSpan.classList.remove("text-success");
            inputLenghtSpan.classList.add("text-danger");
            inputLenghtIcon.classList.remove("text-success");
            inputLenghtIcon.classList.remove("text-muted");
            inputLenghtIcon.classList.add("text-danger");
            inputLenghtIcon.innerHTML='<i class="bi bi-exclamation-triangle"></i>';
            err++;
        }else{
            inputLenghtSpan.classList.add("text-success");
            inputLenghtSpan.classList.remove("text-danger");
            inputLenghtIcon.classList.add("text-success");
            inputLenghtIcon.classList.remove("text-danger");
            inputLenghtIcon.innerHTML='<i class="bi bi-check-lg"></i>';
        }
        if(inputValue!=""){
            forbithenChar.classList.remove("text-muted");
            forbithenCharIcon.classList.remove("text-muted");
            chars.classList.remove("text-muted"); 
            if (forbiddenChars.test(inputValue)) {
                chars.classList.add("text-danger");
                chars.classList.remove("text-success");
                forbithenChar.classList.remove("text-success");
                forbithenChar.classList.add("text-danger");
                forbithenCharIcon.classList.remove("text-success");
                forbithenCharIcon.classList.add("text-danger");
                forbithenCharIcon.innerHTML='<i class="bi bi-exclamation-triangle"></i>';
                err++;
            }else{
                chars.classList.remove("text-danger");
                chars.classList.add("text-success");
                forbithenChar.classList.add("text-success");
                forbithenChar.classList.remove("text-danger");
                forbithenCharIcon.classList.add("text-success");
                forbithenCharIcon.classList.remove("text-danger");
                forbithenCharIcon.innerHTML='<i class="bi bi-check-lg"></i>';
            }
        }else{
            err++;
            chars.classList.add("text-muted");
            forbithenChar.classList.add("text-muted");
            forbithenCharIcon.classList.add("text-muted");
        }
        (err === 0) ? btnCatSave.removeAttribute("disabled"):btnCatSave.setAttribute("disabled","");
        //console.log("El contenido es válido.");
    };


    
</script>






