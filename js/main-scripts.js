$(document).ready(function(){
    $("#idbusqueda").keyup(function(e){
        if(e.keyCode==13){
            buscar_producto();
        }
    })
});
function buscar_producto(){
    window.location="busqueda.php?text="+$("#idbusqueda").val();
}

function bloquearEnter(e) {
    if (e && e.keyCode == 13) {
        return false;
    }
    return true;
}
function actualizarRango(rangeId, labelId) {
    const range = document.getElementById(rangeId);
    const label = document.getElementById(labelId);
    label.textContent = range.value + "€";
}
function ajustarRango(){
    let pMin = document.getElementById("precio_minimo").value;
    let pMax = document.getElementById("precio_maximo").value;
    if(pMin>pMax){
        pMax=pMin;
    }
}
function validarFiltros() {
    var precioMinimo = parseInt(document.getElementById('precio_minimo').value);
    var precioMaximo = parseInt(document.getElementById('precio_maximo').value);

    if (precioMinimo > precioMaximo) {
        alert("El precio mínimo no puede ser mayor que el precio máximo");
        return false; // Evita que se envíe el formulario
    }

    return true; // Permite que se envíe el formulario si la validación pasa
}
