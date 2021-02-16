import {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    modificarModalUsuario as modificarModal,
    modificarRolesModalUsuario as modificarModalRoles,
    visualizarPersonaAgente,
    eliminarModalUsuario as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/usuarios/");
setUrlAjax("/administracion/personas/");
setUrlAjaxRxP("/administracion/roles/");

loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize': visualizarPersonaAgente,
    'updateRoles': modificarModalRoles,
    'visualizarRolesPermisos': visualizarUpdateModalRxP
});
loadScriptValidarCampos();

loadScriptOrdenarPagTablas('miTabla', '0,1,2,3', [4], 'Usuarios Registrados');