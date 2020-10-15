function verificarAlertas(alertas, tipo) {
    alertas = JSON.parse(alertas);
    var headerAlertify;
    var bodyAlertify;
    if (alertas['new'] !== null && (typeof alertas['new'] !== "undefined")) {
        if (alertas['new']['estado']) {
            headerAlertify = "<span class='fal fa-check-circle  fa-lg' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Alta realizada</span>";
            bodyAlertify = "Alta de " + tipo + " realizada correctamente";
        } else {
            headerAlertify = "<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
            bodyAlertify = "ERROR al crear " + tipo + "<br>" + alertas['new']['mensaje'];
        }
    }
    if (alertas['update'] !== null && (typeof alertas['update'] !== "undefined")) {
        if (alertas['update']['estado']) {
            headerAlertify = "<span class='fal fa-check-circle  fa-lg' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Modificación Realizada</span>";
            bodyAlertify = "Modificación de " + tipo + " realizada Correctamente";
        } else {
            headerAlertify = "<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
            bodyAlertify = "ERROR al modificar " + "<br>" + alertas['update']['mensaje'];
        }
    }
    if (alertas['delete'] !== null && (typeof alertas['delete'] !== "undefined")) {
        if (alertas['delete']['estado']) {
            headerAlertify = "<span class='fal fa-check-circle  fa-lg' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Baja Realizada</span>";
            bodyAlertify = "Eliminación de " + tipo + " realizada Correctamente";
        } else {
            headerAlertify = "<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
            bodyAlertify = "ERROR al eliminar " + "<br>" + alertas['delete']['mensaje'];
        }
    }
    if (alertas['errorLogin']) {
        headerAlertify = "<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error al Iniciar Sesion</span>";
        bodyAlertify = "Verifique Usuario y Contraseña..";
        window.history.pushState("", "", '/');
    }
    if (alertas['rolChange']) {
        headerAlertify = "<span class='fal fa-check-circle  fa-lg' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Exito</span>";
        bodyAlertify = "Rol Cambiado Correctamente..";
    }
    if (headerAlertify) {
        alertify.alert(headerAlertify, bodyAlertify);
    }
}