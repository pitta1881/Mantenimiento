import {
    setUrl,
    loadTablePermiso as loadTable,
    modificarModalPermiso as modificarModal,
    eliminarModalPermiso as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/permisos/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);