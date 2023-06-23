<div class="card p-1">
    <form action="?" method="POST">
        <div class="input-group input-group-sm mb-2">
            <select class="form-select" id="catSelect" onchange="getSetName(this, 'catNameInput')" aria-label="Default select example">        
                <?php
                    require_once '../models/DBQ.php';
                    $dbq=new DBQ();
                    $data = $dbq->selectStuff(["*"], "video_categories");
                    if(count($data) == 0) {
                        echo '<option selected>No hay Categorías Agregar Nueva--></option>';
                    } else {
                        $options = '<option selected>Listado Categorías</option>';
                        foreach($data as $index => $item) {
                            $options .= "<option value=\"" . $item['id'] . "\">" . $item['modulo'] . "</option>";
                        }
                        echo $options;
                    }
                ?>
            </select>
            <!--<div class="input-group-append">-->
                <input type="text" class="form-control select disabled" onclick="selectAll()" value="Nombre nueva categoría y click en Agregar-->" name="catName" id="catNameInput">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" onClick="checkOptions()" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a id="addButton" class="dropdown-item" href="?action=add">Agregar</a></li>
                    <li><a class="dropdown-item" href="?action=update">Actualizar Nombre</a></li>
                    <li><a class="dropdown-item" href="?action=editList">Editar Videos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="?action=delete">Eliminar Categoría</a></li>
                </ul>
            <!--</div>-->
        </div>
    </form>
    </div>
</div>
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
</script>

