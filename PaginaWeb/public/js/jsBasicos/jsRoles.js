import {
    setUrl,
    eliminarModalRol as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/roles/");

loadTooltips();
modalDrag();
loadListenerActionButtons(null, deleteModal);
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Roles Registrados');