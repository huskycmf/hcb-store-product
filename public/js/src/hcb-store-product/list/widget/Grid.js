define([
    "dojo/_base/declare",
    "hcb-store-product/store/ProductStore",
    "dgrid/OnDemandGrid",
    "dgrid/extensions/ColumnHider",
    "dgrid/extensions/ColumnResizer",
    "dgrid/extensions/DijitRegistry",
    "hc-backend/dgrid/_Selection",
    "hc-backend/dgrid/_Refresher",
    "hc-backend/dgrid/columns/timestamp",
    "hc-backend/dgrid/columns/editor",
    "dgrid/Keyboard",
    "dgrid/selector",
    "dojo/i18n!../../nls/List"
], function(declare, ProductStore,
            OnDemandGrid, ColumnHider, ColumnResizer, DijitRegistry,
            _Selection, _Refresher, timestamp, editor, Keyboard,
            selector, i18nList) {
    return declare('hcb-store-product.list.widget.Grid',
                   [ OnDemandGrid, ColumnHider, ColumnResizer,
                     Keyboard, _Selection, _Refresher, DijitRegistry ], {
        //  summary:
        //      Grid widget for displaying all available clients
        //      as list
        store: ProductStore,

        columns: [
            selector({ label: "", width: 40, selectorType: "checkbox" }),
            {label: i18nList.labelId, hidden: true, field: 'id', sortable: true, resizable: false},
            editor({label: i18nList.labelAlias, field: 'alias', hidden: false,
                    sortable: true, resizable: true, route: '/update/:id'}),
            timestamp({label: i18nList.labelTimestamp, field: 'timestamp', sortable: true})
        ],

        loadingMessage: i18nList.loadingMessage,
        noDataMessage: i18nList.noDataMessage,

        showHeader: true,
        allowTextSelection: true
    });
});
