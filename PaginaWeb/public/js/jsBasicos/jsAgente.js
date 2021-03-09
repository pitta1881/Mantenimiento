import {
    setUrl,
    setUrlAjax,
    loadTableAgente as loadTable,
    modificarModalAgente as modificarModal,
    eliminarModalAgente as deleteModal,
    visualizarPersonaAgente as visualizarModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/agentes/");
setUrlAjax("/administracion/personas/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize-2': visualizarModal,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);