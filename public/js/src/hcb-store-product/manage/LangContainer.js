define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/LangContainer",
    "hc-backend/widget/ContentLocalization/service/Saver",
    "./widget/Form",
    "hcb-store-product/store/ProductStore"
], function(declare, LangContainer, Saver, Form, ProductStore) {
    return declare([LangContainer], {
        formWidget: Form,
        store: ProductStore,

        _createSaverService: function (store) {
            try {
                return new Saver({polyglotCollectionStore: store,
                                  polyglotCollectionPath: '/localized'});
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
