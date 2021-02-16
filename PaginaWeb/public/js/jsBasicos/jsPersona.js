import {
    setUrl,
    modificarModalPersona as modificarModal,
    eliminarModalPersona as deleteModal,
    modificarEstadoModalPersona as modificarEstadoModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/personas/");

loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'updateEstado': modificarEstadoModal
});
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6', [7], 'Personas Registradas');