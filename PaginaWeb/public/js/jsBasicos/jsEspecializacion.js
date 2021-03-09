import {
    setUrl,
    loadTableEspecializacion as loadTable,
    modificarModalEspecializacion as modificarModal,
    eliminarModalEspecializacion as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/especializaciones/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);