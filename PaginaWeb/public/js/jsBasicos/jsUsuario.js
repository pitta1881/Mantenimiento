import {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    loadTableUsuario as loadTable,
    visualizarUpdateModalRxP,
    modificarModalUsuario as modificarModal,
    modificarRolesModalUsuario as modificarModalRoles,
    visualizarPersonaAgente,
    eliminarModalUsuario as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/usuarios/");
setUrlAjax("/administracion/personas/");
setUrlAjaxRxP("/administracion/roles/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize-2': visualizarPersonaAgente,
    'updateRoles': modificarModalRoles,
    'visualizarRolesPermisos': visualizarUpdateModalRxP,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);