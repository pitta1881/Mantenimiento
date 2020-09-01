function verificarAlertas(alertas, tipo) {
    alertas = JSON.parse(alertas);
    var headerAlertify;
    var bodyAlertify;
    if (alertas['new']) {
        headerAlertify = "<span class='fal fa-check-circle fa-2x' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Alta realizada</span>";
        bodyAlertify = "Alta de " + tipo + " realizada correctamente";
    } else if (alertas['new'] == false) {
        headerAlertify = "<span class='fal fa-times-circle fa-2x' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
        bodyAlertify = "ERROR al crear " + tipo;
    }
    if (alertas['update']) {
        headerAlertify = "<span class='fal fa-check-circle fa-2x' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Modificación Realizada</span>";
        bodyAlertify = "Modificación de " + tipo + " realizada Correctamente";
    } else if (alertas['update'] == false) {
        headerAlertify = "<span class='fal fa-times-circle fa-2x' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
        bodyAlertify = "ERROR al modificar " + tipo;
    }
    if (alertas['delete']) {
        headerAlertify = "<span class='fal fa-check-circle fa-2x' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'> Baja Realizada</span>";
        bodyAlertify = "Eliminación de " + tipo + " realizada Correctamente";
    } else if (alertas['delete'] == false) {
        headerAlertify = "<span class='fal fa-times-circle fa-2x' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>";
        bodyAlertify = "ERROR al eliminar " + tipo;
    }
    if (headerAlertify) {
        alertify.alert(headerAlertify, bodyAlertify);
    }
}