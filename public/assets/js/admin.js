    // Llama a esta función para cargar la API de YouTube
    
    
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
    document.getElementById("formNameInput").value="";
    //---eventlisteners de pagina
    
    window.addEventListener('DOMContentLoaded', function() {
        const submittedFlag = sessionStorage.getItem('formSubmitted');
        if (!submittedFlag) {
          catForm.submit();
          sessionStorage.setItem('formSubmitted', 'true');
        }
      });
      
      window.addEventListener('hashchange', function() {
        sessionStorage.removeItem('formSubmitted');
      });
      
      window.addEventListener('popstate', function() {
        // Se ha producido un cambio en la URL (navegación hacia atrás o adelante)
        sessionStorage.removeItem('formSubmitted');
      });
      
    //----------------------------

    // Obtener todos los elementos radio por su clase
    var videoRadioButtons = document.getElementsByClassName('videoRadio');
    
    // Convertir la colección en un array
    var videoRadioArray = Array.from(videoRadioButtons);

    //-------------------------------------------------------
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

    // Obtener todos los elementos y agregarles evento click->seleccionar todo<input>
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("click", function() {
            this.select();
        });
        
    }

    const popModal = (selectedOption) => {
    let checkedRadioButton = document.querySelectorAll('.catRadio:checked');
    const selectedRadioButton=document.getElementById(checkedRadioButton[0].id);
    //console.log(selectedOption);
        switch (selectedOption) {
            case "add":
                resetFields();
                document.getElementById("formNameInput").value="addCat";
                console.log(document.getElementById("formNameInput").value);
                document.getElementById("catSecction").classList.remove("d-none");
                document.getElementById("videoSection").classList.add("d-none");
                document.getElementById("videoDisplay").classList.add("d-none");
                document.getElementById("modalTitle").innerHTML = "Agregar Nueva Categoría";
                break;
            case "update":
                document.getElementById("formNameInput").value="updateCat";
                console.log(document.getElementById("formNameInput").value);
                document.getElementById("catSecction").classList.remove("d-none");
                document.getElementById("videoSection").classList.add("d-none");
                document.getElementById("videoDisplay").classList.add("d-none");
                document.getElementById("modalTitle").innerHTML = "Modificar Nombre";
                const label = document.querySelector('label[for="' + selectedRadioButton.id + '"]');
                document.getElementById("catNameInput").value = label.innerHTML;
                document.getElementById("catIdInput").value = selectedRadioButton.value
                checkInput(document.getElementById("catNameInput"));
                break;
            case "modifyVideo":
                document.getElementById("formNameInput").value="updateVideo";
                console.log(document.getElementById("formNameInput").value);
                document.getElementById("catSecction").classList.add("d-none");
                document.getElementById("videoSection").classList.remove("d-none");
                document.getElementById("videoDisplay").classList.remove("d-none");
                var selectElement=document.getElementById("modalCatSelect");
                var selectElement = document.getElementById("modalCatSelect");
                var selectedValue = selectedRadioButton.value;
                // Iterar sobre las opciones del select y establecer la opción seleccionada
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === selectedValue) {
                        selectElement.selectedIndex = i;
                        break;
                    }
                }
                setVideo(document.getElementById("videoDir").value);
                
                break;
            case "addVideo":
                resetFields();
                document.getElementById("formNameInput").value="addVideo";
                console.log(document.getElementById("formNameInput").value);
                document.getElementById("catSecction").classList.add("d-none");
                document.getElementById("videoSection").classList.remove("d-none");
                document.getElementById("videoDisplay").classList.remove("d-none");
                var selectElement=document.getElementById("modalCatSelect");
                var selectElement = document.getElementById("modalCatSelect");
                var selectedValue = selectedRadioButton.value;
                // Iterar sobre las opciones del select y establecer la opción seleccionada
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === selectedValue) {
                        selectElement.selectedIndex = i;
                        break;
                    }
                }
                break;
        }
    }
    const checkInput = (inputElement) => {
        //valida input del nombre, si es valido se habilita el boton guardar
        //console.log(inputElement.id)
        var inputValue;
        if(inputElement.id!="checkButton"){
            inputValue = inputElement.value;
        }
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
            if(inputElement.id=="videoName"){
                document.getElementById("showTitle").innerHTML=inputValue;
            }
        }else{
            err++;
            chars.classList.add("text-muted");
            forbithenChar.classList.add("text-muted");
            forbithenCharIcon.classList.add("text-muted");
        }
        if(inputElement.id!="catNameInput"){
            if(document.getElementById("videoDir").value==""){
                document.getElementById("videoAlert").classList.remove("d-none");
                document.getElementById("videoAlert").innerHTML="Falta dirección de video";
                err++
            }
        }
        (err === 0) ? btnCatSave.removeAttribute("disabled"):btnCatSave.setAttribute("disabled","");
        //console.log("El contenido es válido.");
    };
    
    const checkUrl = () => {
        var videoUrl = document.getElementById("videoDir").value;
        // Expresión regular para extraer la ID del video de YouTube
        var youtubeRegex = /(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:.*&)?v=|(?:embed|v)\/))([^?&]+)/;
        var match = videoUrl.match(youtubeRegex);
      
        if (match && match[1]) {
            var videoId = match[1];
            var videoCode = videoId.split("/").pop();
            document.getElementById("videoDir").value = videoCode;
            setVideo(videoCode);
            document.getElementById("videoAlert").classList.add("d-none");
            btnCatSave.removeAttribute("disabled");
        } else {
          // El enlace no coincide con el formato de un enlace de YouTube válido
          document.getElementById("videoAlert").innerHTML = "Enlace No valido";
          document.getElementById("videoAlert").classList.remove("d-none");
          btnCatSave.setAttribute("disabled", "");
        }
        
    };
    const resetFields=()=>{
        // Obtener todos los inputs dentro del modal
        var inputs = document.querySelectorAll("#addModal input");

        // Restablecer el valor de cada input a vacío
        inputs.forEach(function(input) {
        input.value = "";
        });
        document.getElementById('insertIframeHere').innerHTML="";
        document.getElementById("showTitle").innerHTML="";
    }
    const radioClicked = (clickedRadio) => {
        console.log(clickedRadio);
        document.getElementById("videoName").value = clickedRadio.nextElementSibling.innerHTML;
        var id = clickedRadio.id;
        id = id.split("_");
        document.getElementById("videoId").value = id[1];
        document.getElementById("videoDir").value = clickedRadio.value;
        document.getElementById("checkButton").click();
    }
    const setVideo = (code) => {
        var url = 'https://www.youtube.com/embed/' + code;
        var iframe = '<iframe width="100%" height="100%" src="' + url + '" frameborder="0" allowfullscreen></iframe>';
        var insertIframeHere = document.getElementById('insertIframeHere');
    
        insertIframeHere.innerHTML = iframe;
    
        // Adjuntar el controlador de eventos al evento 'load' del iframe
        insertIframeHere.querySelector('iframe').addEventListener('load', function() {
            // Habilitar el botón después de que el contenido se haya cargado
            document.getElementById('btnCatSave').removeAttribute('disabled');
        });
    };
    



    //al final de todo los listeners
    // Adjuntar el evento click a cada elemento VideoRadio
    videoRadioArray.forEach(function(radioButton) {
        radioButton.addEventListener('click', function() {
            radioClicked(this);
        });
    });
    // Hacer clic en el primer radio button
    if (videoRadioArray.length > 0) {
    videoRadioArray[0].click();
    }
    // Agregar eventos de clic a cada elemento de radio
    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener("click", function() {
            document.getElementById("categoryForm").submit();
        });
    });
    /*
    if(document.getElementById("videoList").innerHTML=""){
        if (radioButtons.length > 0) {
            radioButtons[0].click();
        }
    }
    */
      

    
      
      
