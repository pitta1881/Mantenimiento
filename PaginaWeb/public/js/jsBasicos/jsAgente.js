import {
    setUrl,
    setUrlAjax,
    modificarModalAgente as modificarModal,
    eliminarModalAgente as deleteModal,
    visualizarPersonaAgente as visualizarModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/agentes/");
setUrlAjax("/administracion/personas/");

loadTooltips();
modalDrag();
loadListenerActionButtons(modificarModal, deleteModal, visualizarModal);
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4', [5], 'Agentes Registrados');