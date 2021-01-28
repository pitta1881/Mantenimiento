import {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    modificarModalUsuario as modificarModal,
    modificarRolesModalUsuario as modificarModalRoles,
    visualizarPersonaAgente as visualizarModal,
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
loadListenerActionButtons(modificarModal, deleteModal, visualizarModal, null, modificarModalRoles, visualizarUpdateModalRxP);
loadScriptValidarCampos();

loadScriptOrdenarPagTablas('miTabla', '0,1,2,3', [4], 'Usuarios Registrados');