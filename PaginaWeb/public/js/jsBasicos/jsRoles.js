import {
    setUrl,
    setUrlAjaxRxP,
    loadTableRol as loadTable,
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

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'delete': deleteModal,
    'visualizarRolesPermisos': visualizarUpdateModalRxP,
    'updateRolesPermisos': visualizarUpdateModalRxP,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);