define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/Container",
    "hc-backend/widget/ContentLocalization/LangContainer",
    "hc-backend/widget/ContentLocalization/service/Saver",
    "./widget/Form",
    "hcb-store-product/store/ProductStore"
], function(declare, Container, LangContainer, SaverService, Form, ProductStore) {

    return declare([LangContainer], {
        formWidget: Form,
        store: ProductStore,

        _createSaverService: function (store) {
            try {
                return new SaverService({polyglotCollectionStore: store,
                                         polyglotCollectionPath: '/localized'});
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },
    });
});
