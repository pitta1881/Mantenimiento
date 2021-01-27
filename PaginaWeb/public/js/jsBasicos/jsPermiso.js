import {
    setUrl,
    modificarModalPermiso as modificarModal,
    eliminarModalPermiso as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/permisos/");

loadTooltips();
modalDrag();
loadListenerActionButtons(modificarModal, deleteModal);
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Permisos Registrados');