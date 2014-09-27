define([
    "dojo/_base/declare",
    'hc-backend/layout/main/content/_ContentMixin',
    "dijit/_TemplatedMixin",
    "dojo/text!./templates/Container.html",
    "hcb-store-product/list/widget/Grid"
], function(declare, _ContentMixin, _TemplatedMixin, template, Grid) {
    return declare('hcb-store-product.list.Container', [ _ContentMixin, _TemplatedMixin ], {
        //  summary:
        //      List container. Contains widgets who responsible for
        //      displaying list of clients.
        templateString: template,

        baseClass: 'storeProductList',
        
        postCreate: function () {
            try {
                this._gridWidget = new Grid({'class': this.baseClass+'Grid'});
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        startup: function () {
            try {
                this.addChild(this._gridWidget);
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        refresh: function () {
            try {
                this._gridWidget.refresh({keepScrollPosition: true});
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
