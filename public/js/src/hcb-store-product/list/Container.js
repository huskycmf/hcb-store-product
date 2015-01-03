define([
    "dojo/_base/declare",
    'hc-backend/layout/main/content/_ContentMixin',
    "dijit/_TemplatedMixin",
    "dojo/_base/lang",
    "dojo/text!./templates/Container.html",
    "dojo/i18n!hcb-store-product/nls/List",
    "dijit/form/Button",
    "hc-backend/router",
    "hcb-store-product/list/widget/Grid",
    "hc-backend/dgrid/form/DeleteSelectedButton"
], function(declare, _ContentMixin, _TemplatedMixin,
            lang, template, i18nList, Button, router, Grid, DeleteSelectedButton) {
    return declare('hcb-store-product.list.Container', [ _ContentMixin, _TemplatedMixin ], {
        //  summary:
        //      List container. Contains widgets who responsible for
        //      displaying list of clients.
        templateString: template,

        baseClass: 'storeProductList',
        
        postCreate: function () {
            try {
                this._gridWidget = new Grid({'class': this.baseClass+'Grid'});

                this._addWidget = new Button({'label': i18nList.addButton,
                    'class': this.baseClass+'Add',
                    'onClick': lang.hitch(this, function (){
                        router.go(router.assemble('/create', {}, true));
                    })});

                this._saveWidget = new Button({'label': i18nList.saveButton,
                    'class': this.baseClass+'Add',
                    'onClick': lang.hitch(this, function (){
                        this._gridWidget.save()
                            .then(lang.hitch(this, 'refresh'));
                    })});

                this._deleteWidget = new DeleteSelectedButton({'label': i18nList.deleteSelectedButton,
                    'target': router.assemble('/delete', {}, true),
                    'name': 'products',
                    'class': this.baseClass+'Delete',
                    'grid': this._gridWidget});
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        startup: function () {
            try {
                this.addChild(this._addWidget);
                this.addChild(this._saveWidget);
                this.addChild(this._deleteWidget);
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
