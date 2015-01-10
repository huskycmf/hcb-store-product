define([
    "dojo/_base/declare",
    "../../store/SelectionStore",
    "dgrid/OnDemandGrid",
    "dgrid/extensions/ColumnHider",
    "dgrid/extensions/ColumnResizer",
    "dgrid/extensions/DijitRegistry",
    "hc-backend/dgrid/_Selection",
    "hc-backend/dgrid/_Refresher",
    "hc-backend/dgrid/columns/timestamp",
    "hc-backend/dgrid/columns/editor",
    "dgrid/Keyboard",
    "dgrid/Selector",
    "dojo/i18n!../../nls/Package"
], function(declare, SelectionStore,
            OnDemandGrid, ColumnHider, ColumnResizer, DijitRegistry,
            _Selection, _Refresher, timestamp, ColumnsEditor, Keyboard,
            selector, i18nList) {
    return declare('hcb-store-product.selection.list.widget.Grid',
                   [ OnDemandGrid, ColumnHider, ColumnResizer,
                     Keyboard, _Selection, _Refresher, DijitRegistry ], {
        //  summary:
        //      Grid widget for displaying all available clients
        //      as list
        store: SelectionStore,

        columns: [
            selector({ label: "", width: 40, selectorType: "checkbox" }),
            {label: i18nList.idLabel, hidden: true, field: 'id', sortable: true, resizable: false},
            ColumnsEditor({label: i18nList.titleLabel, field: 'title', hidden: false,
                    sortable: true, resizable: true, route: '/update/:id'}),
            timestamp({label: i18nList.priceLabel, field: 'price', sortable: true})
        ],

        loadingMessage: i18nList.loadingMessage,
        noDataMessage: i18nList.noDataMessage,

        showHeader: true,
        allowTextSelection: true
    });
});
