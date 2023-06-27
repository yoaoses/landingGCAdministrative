    <div class="row">
    <div class="col-3">
        <div class="card">
        <div class="card-header">
            <div class="input-group-sm">
            <div class="d-flex justify-content-between">
                <span class="input-group-text w-100">Categorías</span>
                <button class="btn btn-sm btn-outline-secondary input-group-button" type="button" id="btnEdit" title="Acciones" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-caret-down-square"></i>
                </button>
                <ul class="dropdown-menu">
                <li><span class="dropdown-item text-muted disabled">Opciones</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" type="button" onclick="popModal('add')" data-bs-toggle="modal" data-bs-target="#addModal">Agregar</button></li>
                <li><button class="dropdown-item" type="button" onclick="popModal('update')" data-bs-toggle="modal" data-bs-target="#addModal">Modificar</button></li>
                <li><button class="dropdown-item d-none" type="button">Something else here</button></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="card-body">
            <form id="categoryForm" action="" method="post">
            <?php
                echo LandingController::loadCategories("radios");
            ?>
            </form>
        </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
        <div class="card-header">
            <div class="input-group-sm">
            <div class="d-flex justify-content-between">
                <span class="input-group-text w-100">Videos</span>
                <button class="btn btn-sm btn-outline-secondary input-group-button" type="button" title="Acciones" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-caret-down-square"></i>
                </button>
                <ul class="dropdown-menu">
                <li><span class="dropdown-item text-muted disabled">Opciones</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" type="button" onclick="popModal('addVideo')" data-bs-toggle="modal" data-bs-target="#addModal">NuevoVideo</button></li>
                <li><button class="dropdown-item" type="button" onclick="popModal('modifyVideo')" data-bs-toggle="modal" data-bs-target="#addModal">Modificar</button></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="card-body" id="videoList">
            <?php
            echo LandingController::loadCatVideos($_POST['cat'] ?? '1');
            ?>
        </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
        <div class="card-header overflow-auto">Contenido del Header</div>
        <div class="card-body">Contenido de la Card</div>
        </div>
    </div>
    </div>

    <div class="modal fade modal-fullscreen" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" style="height: 90vh;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Agregar/Actualizar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetFields()" aria-label="Close"></button>
        </div>
        <form id="modalForm" action="" method="post">
            <div class="modal-body h-100 row">
                <div class="col-5">
                    <div class="input-group input-group-sm mb-3" id="catSecction">
                        <span class="input-group-text"><i class="bi bi-pencil"></i>Nombre Categoría</span>
                        <input type="text" id="formNameInput" name="formName" value="" hidden>
                        <div class="form-floating">
                            <input type="text" class="form-control" oninput="checkInput(this)" id="catNameInput" name="catNameInput" placeholder="Nombre Categoría">
                            <input type="text" class="form-control d-none" id="catIdInput" name="catIdInput" placeholder="Nombre Categoría">
                            <label for="catNameInput">Nombre Categoría</label>
                        </div>
                    </div>
                    <div id="videoSection">
                        <div class="input-group mb-3 input-group-sm">
                            <select class="form-select" name="videoCatId" aria-label="Categorías"id="modalCatSelect">
                            <?php
                                echo LandingController::loadCategories("options");
                            ?>  
                            </select>
                        </div>
                        <div class="input-group mb-3 input-group-sm">
                            <span class="input-group-text">Nombre video</span>
                            <input type="text" class="form-control" oninput="checkInput(this)" id="videoName" name="videoName" placeholder="Nombre video">
                            <input type="text" class="form-control" id="videoId" name="videoId" hidden>
                        </div>
                        <div class="input-group mb-3 input-group-sm">
                            <span class="input-group-text">url</span>
                            <input type="text" class="form-control" id="videoDir" name="videoDir" placeholder="Dirección web">
                            <button class="btn btn-outline-primary" id="checkButton" type="button" onclick="checkUrl()">
                                Check
                            </button>
                        </div>      
                    </div>
                    <!-- validaciones -->
                    <!------------------>
                </div>
                <div class="col-7" id="videoDisplay">
                    <div id="showTitle" class="card-header"></div>
                    <div class="card-body p-0 h-100 d-flex flex-column" id="insertIframeHere"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row m-0 w-100">
                    <div class="col-9 d-flex align-items-start">
                        <div class="d-flex flex-column">
                            <div class="input-group" id="lenghtGroup">
                            <label class="input-group-text" id="inputLenghtSpan">
                                El nombre debe tener al menos 3 caracteres.
                            </label>
                                <label class="input-group-text" id="inputLenghtIcon"></label>
                            </div>
                            <div class="input-group" id="forbithCharGroup">
                                <label class="input-group-text text-muted" id="forbithenChar">
                                    Caracteres no permitidos:
                                </label>
                                <label class="input-group-text text-muted" id="chars"> [ ' " \ / . , : ; * ^ ` ? ] </label>
                                <label class="input-group-text text-muted" id="forbithenCharIcon"></label>
                            </div>
                            <div class="input-group">
                                <label class="input-group-text text-danger d-none" id="videoAlert"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 p-1 d-flex flex-column align-items-end">
                        <div class="mb-2 w-100">
                            <button type="button" class="btn btn-sm btn-outline-primary w-100" data-bs-dismiss="modal" onclick="resetFields()">Cancelar</button>
                        </div>
                        <div class="mb-2 w-100">
                            <button type="submit" id="btnCatSave" class="btn btn-sm btn-outline-primary w-100" data-bs-dismiss="modal" disabled>Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>

    <script src="assets/js/admin.js"></script>
