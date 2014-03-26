define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/Container",
    "../manage/LangContainer"
], function(declare, Container, LangContainer) {

    return declare([ Container ], {
        baseClass: 'productsUpdate',
        langContainer: LangContainer,

        handle: function (router, route) {
            try {
                this.inherited(arguments);

                if (route.params.id) {
                    this._langContainerWidget.attr('identifier', route.params.id);
                }
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
