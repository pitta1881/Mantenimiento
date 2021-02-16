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
loadListenerActionButtons({
    'delete': deleteModal,
    'visualizarRolesPermisos': visualizarUpdateModalRxP,
    'updateRolesPermisos': visualizarUpdateModalRxP
});
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Roles Registrados');