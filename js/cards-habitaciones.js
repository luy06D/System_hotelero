
const cardDispo = document.querySelector("#H_dispo");
const cuerpoDispo = cardDispo.querySelector("div");
const cardOcup = document.querySelector("#H_ocup");
const cuerpoOcup = cardOcup.querySelector("div");
const cardLimp = document.querySelector("#H_limp");
const cuerpoLimp = cardLimp.querySelector("div");


function getDisponibles(){
    const data = new URLSearchParams();
    data.append("operacion" , "hDisponiblesGet");

    fetch("../controller/habitacion.controller.php", {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(datos => {
        cuerpoDispo.innerHTML = ``
        datos.forEach(element => {
            let row = `
        <div class="card shadow dispo ">
            <div class="card-body">             
            <p class="card-text">Habitaciones Disponibles:</p> 
            <p class="card-text">${element.habitaciones_disponibles}</p>                                         
            </div>                    
        </div>                                        
            `;
            cuerpoDispo.innerHTML += row;
        });
    });
}

function getOcupadas(){
    const data = new URLSearchParams();
    data.append("operacion" , "hOcupadasGet");

    fetch("../controller/habitacion.controller.php", {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(datos => {
        cuerpoOcup.innerHTML = ``
        datos.forEach(element => {
            let row = `                   
        <div class="card shadow ocup">
            <div class="card-body">             
            <p class="card-text">Habitaciones Ocupadas:</p> 
            <p class="card-text">${element.habitaciones_ocupadas}</p>                                         
            </div>                    
        </div>                                                         
            `;
            cuerpoOcup.innerHTML += row;
        });
    });
}

function getMantenimiento(){
    const data = new URLSearchParams();
    data.append("operacion" , "hLimpiezaGet");

    fetch("../controller/habitacion.controller.php", {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(datos => {
        cuerpoLimp.innerHTML = ``
        datos.forEach(element => {
            let row = `                   
        <div class="card shadow limp">
            <div class="card-body">             
            <p class="card-text">Habitaciones en Limpieza:</p> 
            <p class="card-text">${element.habitaciones_Limpieza}</p>                                         
            </div>                    
        </div>                                                         
            `;
            cuerpoLimp.innerHTML += row;
        });
    });
}

getDisponibles();
getOcupadas();
getMantenimiento();