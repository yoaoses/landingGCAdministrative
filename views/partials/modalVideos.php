<div class="card p-1">
    <form id="modalCatForm">
        <div class="input-group input-group-sm mb-2">
            <select class="form-select" id="catSelect" onchange="getSetName(this, 'catNameInput')" aria-label="Default select example">        
                <?php
                    /*echo LandingController::loadCategories("select");*/
                    include '../controllers/videosModal.controller.php';
                    echo videoModalController::getCats();
                ?>
            </select>
            <!--<div class="input-group-append">-->
                <input type="text" class="form-control select disabled" onclick="selectAll()" value="Nombre nueva categoría y click en Agregar-->" name="catName" id="catNameInput">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" onClick="checkOptions()" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a id="addButton" class="dropdown-item" onClick="submit('add')">Agregar</a></li>
                    <li><a class="dropdown-item" >Actualizar Nombre</a></li>
                    <li><a class="dropdown-item" >Editar Videos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" >Eliminar Categoría</a></li>
                </ul>
            <!--</div>-->
        </div>
    </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    formState={
        text:null,
        target:document.getElementById("catNameInput"),
    }
    const getSetName=(selectState)=>{
        formState.text=selectState.options[selectState.selectedIndex].innerText;
        if(formState.text!="Listado Categorías"){
            formState.target.value=formState.text;
        }else{
            formState.target.value="Nombre nueva categoría y click en Agregar-->";
        }
    }

    const selectAll=()=>{
        formState.target.select();
    }
    const checkOptions=()=>{
        if(formState.target.value==formState.text){
            document.getElementById("addButton").classList.add("d-none");
        }else{
            document.getElementById("addButton").classList.remove("d-none");
        }
    }
    const submit=(option)=>{
        switch(option){
            case"add":
                //document.getElementById("modalCatForm").submit();
                sendNew();
                break;
        }
    }
    //----controlador select----
    
    //    $(document).ready(function() {
    //    $('#modalCatForm').submit(function(event) {
    //        event.preventDefault();
    const sendNew=()=>{
            // Obtener el nombre de la nueva categoría ingresado
            var catName = $('#catNameInput').val().trim();

            // Verificar si el campo no está vacío
            if (catName !== '') {
                // Realizar una solicitud AJAX para agregar la nueva categoría
                $.ajax({
                    url: '../controllers/videosModal.controller.php',
                    method: 'POST',
                    data: {
                        action: 'addNewCat',
                        catName: catName,
                        table: 'video_categories'
                    },
                    success: function(response) {
                        console.log("response ===>",response);
                        if (response.status === 'success') {
                            // La categoría se agregó correctamente, realizar una nueva solicitud para obtener la lista actualizada
                            $.ajax({
                                url: '../controllers/videosModal.controller.php',
                                method: 'POST',
                                data: {
                                    action: 'getCats'
                                },
                                success: function(updatedOptions) {
                                    // Actualizar el select con las nuevas opciones
                                    $('#catSelect').html(updatedOptions);
                                }
                            });
                        } else {
                            // Error al agregar la categoría
                            console.log('Error al agregar la categoría');
                        }
                    },
                    error:function(response){
                        console.log("error,response ===>",response);
                    },
                    complete:function(response){
                        console.log(" complete response ===>",response);
                    }
                });
            }
    }
    
    //------------------------- 

    

</script>

