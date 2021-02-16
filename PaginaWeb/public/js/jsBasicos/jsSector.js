import {
    setUrl,
    modificarModalSector as modificarModal,
    eliminarModalSector as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/sectores/");

loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal
});
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5', [6], 'Sectores Registrados');