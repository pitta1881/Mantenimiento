 //Función de Fecha y Hora
 var months = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
     "Agosto",
     "Septiembre", "Octubre", "Noviembre", "Diciembre")
 var dayName = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
     "Sábado")
 var relojGlobal
 var intDiferencia

 function reloj() {
     var date = relojGlobal
     intDiferencia = (relojGlobal - new Date()) / 1000
     correrReloj()
 }

 function correrReloj() {

     var difMax = 60;
     var difSeg = (relojGlobal - new Date()) / 1000
     if (difSeg > intDiferencia + difMax || difSeg < intDiferencia - difMax)
         window.location.reload();

     var date = new Date();
     relojGlobal = new Date(date.getFullYear(), date.getMonth(), date.getDate(), date
         .getHours(), date
         .getMinutes(), date.getSeconds() + intDiferencia)
     date = relojGlobal

     var year = date.getFullYear()
     var month = date.getMonth()
     var day = date.getDate()
     var hour = date.getHours()
     var minute = date.getMinutes()
     var second = date.getSeconds()
     var monthname = months[month]

     if (hour > 12) {
         //hour = hour - 12;
         var AM_PM = ""
     } else {
         var AM_PM = ""
     }
     if (minute < 10) {
         minute = "0" + minute
     }
     if (second < 10) {
         second = "0" + second
     }
     if (month < 10) {
         month = "0" + month
     }
     var dayString = dayName[date.getDay()]
     if (document.getElementById('divReloj') != null) {
         document.getElementById('divReloj').innerHTML = " " + dayString + " " + day +
             " de " +
             monthname + ", <b class=\"texto11Azul\">" + hour + ":" + minute + ":" + second +
             " " +
             AM_PM + "</b>"
     }
     setTimeout("correrReloj()", 1000)
 }

 relojGlobal = new Date();
 reloj()