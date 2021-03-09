import {
    setUrl,
    loadTablePersona as loadTable,
    modificarModalPersona as modificarModal,
    eliminarModalPersona as deleteModal,
    modificarEstadoModalPersona as modificarEstadoModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/personas/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'updateEstado': modificarEstadoModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);