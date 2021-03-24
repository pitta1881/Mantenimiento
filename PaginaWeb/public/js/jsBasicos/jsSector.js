import {
    setUrl,
    loadTableSector as loadTable,
    modificarModalSector as modificarModal,
    eliminarModalSector as deleteModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/sectores/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);