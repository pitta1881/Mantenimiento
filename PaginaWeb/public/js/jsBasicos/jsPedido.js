import {
    setUrl,
    setUrlAjax,
    setUrlAjax2,
    loadTablePedido,
    loadTableTareas,
    modificarModalPedido as modificarModal,
    deleteModalPedido as deleteModal,
    visualizarPersonaAgente,
    visualizarSectorPedido,
    visualizarPedidoGeneral,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/pedidos/");
setUrlAjax("/administracion/sectores/");
setUrlAjax2("/administracion/personas/");

loadTablePedido();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize': visualizarPedidoGeneral,
    'visualize-2': visualizarSectorPedido,
    'visualize-3': visualizarPersonaAgente,
    'loadTable': loadTablePedido
});
loadScriptValidarCampos(loadTablePedido, loadTableTareas);