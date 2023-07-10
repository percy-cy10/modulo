function viewPagina() {
    window.location.href = "/modulo/paginas/pagina_principal.php";
}

function viewDetalle() {
    var id = event.target.getAttribute('data-id');
    window.location.href = "/modulo/paginas/detalle_notificaciones.php?id=" + id;
  
}
