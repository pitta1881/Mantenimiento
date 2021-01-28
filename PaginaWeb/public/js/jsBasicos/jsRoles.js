import {
    setUrl,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    eliminarModalRol as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/roles/");
setUrlAjaxRxP("/administracion/roles/");

loadTooltips();
modalDrag();
loadListenerActionButtons(null, deleteModal, null, null, null, visualizarUpdateModalRxP);
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Roles Registrados');