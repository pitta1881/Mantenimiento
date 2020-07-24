function fichaRoles(idRol, modificar) {
    var parametros = {
        "idRol": idRol,
    };
    var modificable = '';
    var btnEnviar = '';
    var disableChk = '';
    var headerAlert = 'Detalle Rol';
    if (modificar) {
        btnEnviar = "<button type='submit' class='btn btn-success btn-modal float-right'>Enviar</button>";
        headerAlert = "Modificar permisos del Rol"
    } else {
        modificable = " onclick='javascript: return false;'";
        disableChk = 'disabled';
    }
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/administracion/roles/fichaRol', //archivo que recibe la peticion
        type: 'post', //método de envio
        success: function (
            response
        ) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            var miRol = JSON.parse(response);

            var usuarioAlta = '';
            var usuarioBaja = '';
            var usuarioModif = '';
            var usuarioVisual = '';

            if (miRol.misPermisos.includes("1")) {
                usuarioAlta = 'checked';
            }
            if (miRol.misPermisos.includes("2")) {
                usuarioBaja = 'checked';
            }
            if (miRol.misPermisos.includes("3")) {
                usuarioModif = 'checked';
            }
            if (miRol.misPermisos.includes("4")) {
                usuarioVisual = 'checked';
            }

            var permisoAlta = '';
            var permisoBaja = '';
            var permisoModif = '';
            var permisoVisual = '';

            if (miRol.misPermisos.includes("5")) {
                permisoAlta = 'checked';
            }
            if (miRol.misPermisos.includes("6")) {
                permisoBaja = 'checked';
            }
            if (miRol.misPermisos.includes("7")) {
                permisoModif = 'checked';
            }
            if (miRol.misPermisos.includes("8")) {
                permisoVisual = 'checked';
            }

            var rolAlta = '';
            var rolBaja = '';
            var rolModif = '';
            var rolVisual = '';

            if (miRol.misPermisos.includes("9")) {
                rolAlta = 'checked';
            }
            if (miRol.misPermisos.includes("10")) {
                rolBaja = 'checked';
            }
            if (miRol.misPermisos.includes("11")) {
                rolModif = 'checked';
            }
            if (miRol.misPermisos.includes("12")) {
                rolVisual = 'checked';
            }

            var pedidoAlta = '';
            var pedidoBaja = '';
            var pedidoModif = '';
            var pedidoVisual = '';

            if (miRol.misPermisos.includes("13")) {
                pedidoAlta = 'checked';
            }
            if (miRol.misPermisos.includes("14")) {
                pedidoBaja = 'checked';
            }
            if (miRol.misPermisos.includes("15")) {
                pedidoModif = 'checked';
            }
            if (miRol.misPermisos.includes("16")) {
                pedidoVisual = 'checked';
            }

            var tareaAlta = '';
            var tareaBaja = '';
            var tareaModif = '';
            var tareaVisual = '';

            if (miRol.misPermisos.includes("17")) {
                tareaAlta = 'checked';
            }
            if (miRol.misPermisos.includes("18")) {
                tareaBaja = 'checked';
            }
            if (miRol.misPermisos.includes("19")) {
                tareaModif = 'checked';
            }
            if (miRol.misPermisos.includes("20")) {
                tareaVisual = 'checked';
            }

            var oTAlta = '';
            var oTBaja = '';
            var oTModif = '';
            var oTVisual = '';

            if (miRol.misPermisos.includes("21")) {
                oTAlta = 'checked';
            }
            if (miRol.misPermisos.includes("22")) {
                oTBaja = 'checked';
            }
            if (miRol.misPermisos.includes("23")) {
                oTModif = 'checked';
            }
            if (miRol.misPermisos.includes("24")) {
                oTVisual = 'checked';
            }

            var sectorAlta = '';
            var sectorBaja = '';
            var sectorModif = '';
            var sectorVisual = '';

            if (miRol.misPermisos.includes("25")) {
                sectorAlta = 'checked';
            }
            if (miRol.misPermisos.includes("26")) {
                sectorBaja = 'checked';
            }
            if (miRol.misPermisos.includes("27")) {
                sectorModif = 'checked';
            }
            if (miRol.misPermisos.includes("28")) {
                sectorVisual = 'checked';
            }

            var agenteAlta = '';
            var agenteBaja = '';
            var agenteModif = '';
            var agenteVisual = '';

            if (miRol.misPermisos.includes("29")) {
                agenteAlta = 'checked';
            }
            if (miRol.misPermisos.includes("30")) {
                agenteBaja = 'checked';
            }
            if (miRol.misPermisos.includes("31")) {
                agenteModif = 'checked';
            }
            if (miRol.misPermisos.includes("32")) {
                agenteVisual = 'checked';
            }

            var especialidadAlta = '';
            var especialidadBaja = '';
            var especialidadModif = '';
            var especialidadVisual = '';

            if (miRol.misPermisos.includes("33")) {
                especialidadAlta = 'checked';
            }
            if (miRol.misPermisos.includes("34")) {
                especialidadBaja = 'checked';
            }
            if (miRol.misPermisos.includes("35")) {
                especialidadModif = 'checked';
            }
            if (miRol.misPermisos.includes("36")) {
                especialidadVisual = 'checked';
            }

            var eventoAlta = '';
            var eventoBaja = '';
            var eventoModif = '';
            var eventoVisual = '';

            if (miRol.misPermisos.includes("37")) {
                eventoAlta = 'checked';
            }
            if (miRol.misPermisos.includes("38")) {
                eventoBaja = 'checked';
            }
            if (miRol.misPermisos.includes("39")) {
                eventoModif = 'checked';
            }
            if (miRol.misPermisos.includes("40")) {
                eventoVisual = 'checked';
            }

            var insumoAlta = '';
            var insumoBaja = '';
            var insumoModif = '';
            var insumoVisual = '';

            if (miRol.misPermisos.includes("41")) {
                insumoAlta = 'checked';
            }
            if (miRol.misPermisos.includes("42")) {
                insumoBaja = 'checked';
            }
            if (miRol.misPermisos.includes("43")) {
                insumoModif = 'checked';
            }
            if (miRol.misPermisos.includes("44")) {
                insumoVisual = 'checked';
            }

            var personaAlta = '';
            var personaBaja = '';
            var personaModif = '';
            var personaVisual = '';

            if (miRol.misPermisos.includes("45")) {
                personaAlta = 'checked';
            }
            if (miRol.misPermisos.includes("46")) {
                personaBaja = 'checked';
            }
            if (miRol.misPermisos.includes("47")) {
                personaModif = 'checked';
            }
            if (miRol.misPermisos.includes("48")) {
                personaVisual = 'checked';
            }

            var oCAlta = '';
            var oCBaja = '';
            var oCModif = '';
            var oCVisual = '';

            if (miRol.misPermisos.includes("49")) {
                oCAlta = 'checked';
            }
            if (miRol.misPermisos.includes("50")) {
                oCBaja = 'checked';
            }
            if (miRol.misPermisos.includes("51")) {
                oCModif = 'checked';
            }
            if (miRol.misPermisos.includes("52")) {
                oCVisual = 'checked';
            }

            alertify.myAlert(headerAlert,
                "<form action='updateRol' method='post'>" +
                "<input type='text' name='idRol' value=" + idRol + " hidden>" +
                "<table id='miTabla' class='table table-bordered table-sm table-striped table-hover text-nowrap'>" +
                "<thead class='headtable'>" +
                "<tr>" +
                "<th>Modulo</th>" +
                "<th>A</th>" +
                "<th>B</th>" +
                "<th>M</th>" +
                "<th>V</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody>" +
                "<tr>" +
                "<td>Usuario</td>" +
                "<td><input type='checkbox' name='permisos[]' value='1' " + disableChk + " readonly='readonly' " + usuarioAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='2' " + disableChk + " readonly='readonly' " + usuarioBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='3' " + disableChk + " readonly='readonly' " + usuarioModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='4' " + disableChk + " readonly='readonly' " + usuarioVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Permiso</td>" +
                "<td><input type='checkbox' name='permisos[]' value='5' " + disableChk + " readonly='readonly' " + permisoAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='6' " + disableChk + " readonly='readonly' " + permisoBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='7' " + disableChk + " readonly='readonly' " + permisoModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='8' " + disableChk + " readonly='readonly' " + permisoVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Rol</td>" +
                "<td><input type='checkbox' name='permisos[]' value='9' " + disableChk + " readonly='readonly' " + rolAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='10' " + disableChk + " readonly='readonly' " + rolBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='11' " + disableChk + " readonly='readonly' " + rolModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='12' " + disableChk + " readonly='readonly' " + rolVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Pedido</td>" +
                "<td><input type='checkbox' name='permisos[]' value='13' " + disableChk + " readonly='readonly' " + pedidoAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='14' " + disableChk + " readonly='readonly' " + pedidoBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='15' " + disableChk + " readonly='readonly' " + pedidoModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='16' " + disableChk + " readonly='readonly' " + pedidoVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Tarea</td>" +
                "<td><input type='checkbox' name='permisos[]' value='17' " + disableChk + " readonly='readonly' " + tareaAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='18' " + disableChk + " readonly='readonly' " + tareaBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='19' " + disableChk + " readonly='readonly' " + tareaModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='20' " + disableChk + " readonly='readonly' " + tareaVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>OT</td>" +
                "<td><input type='checkbox' name='permisos[]' value='21' " + disableChk + " readonly='readonly' " + oTAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='22' " + disableChk + " readonly='readonly' " + oTBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='23' " + disableChk + " readonly='readonly' " + oTModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='24' " + disableChk + " readonly='readonly' " + oTVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Sector</td>" +
                "<td><input type='checkbox' name='permisos[]' value='25' " + disableChk + " readonly='readonly' " + sectorAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='26' " + disableChk + " readonly='readonly' " + sectorBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='27' " + disableChk + " readonly='readonly' " + sectorModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='28' " + disableChk + " readonly='readonly' " + sectorVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Agente</td>" +
                "<td><input type='checkbox' name='permisos[]' value='29' " + disableChk + " readonly='readonly' " + agenteAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='30' " + disableChk + " readonly='readonly' " + agenteBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='31' " + disableChk + " readonly='readonly' " + agenteModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='32' " + disableChk + " readonly='readonly' " + agenteVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Especialidad</td>" +
                "<td><input type='checkbox' name='permisos[]' value='33' " + disableChk + " readonly='readonly' " + especialidadAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='34' " + disableChk + " readonly='readonly' " + especialidadBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='35' " + disableChk + " readonly='readonly' " + especialidadModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='36' " + disableChk + " readonly='readonly' " + especialidadVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Evento</td>" +
                "<td><input type='checkbox' name='permisos[]' value='37' " + disableChk + " readonly='readonly' " + eventoAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='38' " + disableChk + " readonly='readonly' " + eventoBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='39' " + disableChk + " readonly='readonly' " + eventoModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='40' " + disableChk + " readonly='readonly' " + eventoVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Insumo</td>" +
                "<td><input type='checkbox' name='permisos[]' value='41' " + disableChk + " readonly='readonly' " + insumoAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='42' " + disableChk + " readonly='readonly' " + insumoBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='43' " + disableChk + " readonly='readonly' " + insumoModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='44' " + disableChk + " readonly='readonly' " + insumoVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>Persona</td>" +
                "<td><input type='checkbox' name='permisos[]' value='45' " + disableChk + " readonly='readonly' " + personaAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='46' " + disableChk + " readonly='readonly' " + personaBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='47' " + disableChk + " readonly='readonly' " + personaModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='48' " + disableChk + " readonly='readonly' " + personaVisual + modificable + "></td>" +
                "</tr>" +

                "<tr>" +
                "<td>OC</td>" +
                "<td><input type='checkbox' name='permisos[]' value='49' " + disableChk + " readonly='readonly' " + oCAlta + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='50' " + disableChk + " readonly='readonly' " + oCBaja + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='51' " + disableChk + " readonly='readonly' " + oCModif + modificable + "></td>" +
                "<td><input type='checkbox' name='permisos[]' value='52' " + disableChk + " readonly='readonly' " + oCVisual + modificable + "></td>" +
                "</tr>" +
                "</tbody>" +
                "</table>" +
                "<div style='display:inline-block'>" +
                "<small class='text-muted d-block'>A=ALTA</small>" +
                "<small class='text-muted d-block'>B=BAJA</small>" +
                "<small class='text-muted d-block'>M=MODIFICACION</small>" +
                "<small class='text-muted d-block'>V=VISUALIZACION</small>" +
                "</div>" +
                btnEnviar +
                "</form>");
        }
    });
}