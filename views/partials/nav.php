<!-- js controlador de nav -->
<!--<script src="assets/js/nav.js"></script>-->
<!-- --------------------- -->

<nav class="navbar bg-blue">
    <div class= "container1 logo">
        <a href="?pag=landing">
            <img src="assets/img/logoMin.png" alt="logo">
            <span class="brandTitle">GCAdministrative</span>
        </a>
    </div>
    <div class="container2">
        <a href="?pag=landing"class="nav-link <?php if(isset($_GET['pag']) && $_GET['pag'] == 'landing') echo 'currentPage'; ?>">Home</a>
        <a href="?pag=tutorials"class="nav-link <?php if(isset($_GET['pag']) && $_GET['pag'] == 'tutorials') echo 'currentPage'; ?>">Tutoriales</a>
        <a href="?pag=docs"class="nav-link <?php if(isset($_GET['pag']) && $_GET['pag'] == 'docs') echo 'currentPage'; ?>">Documentación</a>
        <a href="?pag=contacts"class="nav-link <?php if(isset($_GET['pag']) && $_GET['pag'] == 'nav-link') echo 'currentPage'; ?>">Contactos</a>    
    </div>
    <div class="container3 ">
        <a href="?pag=closeSession" class="btn btn-sm btn-outline-light" aria-disabled="true">   
                <i class="bi bi-box-arrow-right pr-2"></i> Cerrar sesión
        </a>
        <a href="?pag=admin"class="btn btn-sm btn-outline-light">
                <i class="bi bi-wrench-adjustable-circle"></i>
        </a>
        

    </div> 
</nav>
