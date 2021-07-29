function verificarAlertas(alertas) {
    thisAlert = JSON.parse(alertas);
    if (thisAlert != null) {
        let textHeaderOK = "<span class='fal fa-check-circle  fa-lg' style='vertical-align:middle;color:#31d255'></span><span style='font-size:15px; color:black'>";
        let textHeaderError = "<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'>";
        let headerAlertify;
        let bodyAlertify;

        switch (thisAlert["operacion"]) {
            case "insert":
                if (thisAlert['estado']) {
                    headerAlertify = textHeaderOK + " Alta realizada</span>";
                    bodyAlertify = "Alta de " + thisAlert["tipo"] + " realizada correctamente";
                } else {
                    headerAlertify = textHeaderError + " Error</span>";
                    bodyAlertify = "ERROR al crear " + thisAlert["tipo"] + "<br>" + thisAlert['mensaje'];
                }
                break;
            case "update":
                if (thisAlert['estado']) {
                    headerAlertify = textHeaderOK + " Modificación Realizada</span>";
                    bodyAlertify = "Modificación de " + thisAlert["tipo"] + " realizada Correctamente";
                } else {
                    headerAlertify = textHeaderError + " Error</span>";
                    bodyAlertify = "ERROR al modificar " + "<br>" + thisAlert['mensaje'];
                }
                break;
            case "delete":
                if (thisAlert['estado']) {
                    headerAlertify = textHeaderOK + " Baja Realizada</span>";
                    bodyAlertify = "Eliminación de " + thisAlert["tipo"] + " realizada Correctamente";
                } else {
                    headerAlertify = textHeaderError + " Error</span>";
                    bodyAlertify = "ERROR al eliminar " + "<br>" + thisAlert['mensaje'];
                }
                break;
            case "errorLogin":
                headerAlertify = textHeaderError + " Error al Iniciar Sesion</span>";
                bodyAlertify = "Verifique Usuario y Contraseña..";
                window.history.pushState("", "", '/');
                break;
            case "rolChange":
                headerAlertify = textHeaderOK + " Exito</span>";
                bodyAlertify = "Rol Cambiado Correctamente..";
                break;
            default:
                break;
        }
        if (headerAlertify) {
            alertify.alert(headerAlertify, bodyAlertify);
        }
    }
}