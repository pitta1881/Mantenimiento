import {
    setUrl,
    modificarModalEspecializacion as modificarModal,
    eliminarModalEspecializacion as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/especializaciones/");

loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal
});
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Especializaciones Registradas');