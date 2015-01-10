define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/_base/array",
    "dojo/promise/Promise",
    "dojo/Deferred",
    "hc-backend/layout/main/content/manage/Form",
    "hc-backend/layout/main/content/_LoadableMixin",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/config",
    "dojo-common/store/JsonRest",
    "dojo/store/Memory",
    "dojo-common/form/InputList",
    "dojo/DeferredList",
    "dijit/form/FilteringSelect",
    "underscore",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../nls/Package",
    "dijit/form/TextBox",
    "dijit/form/NumberTextBox",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox"
], function(declare, lang, array, Promise, Deferred, Form, _LoadableMixin,
            _WidgetsInTemplateMixin, config, JsonRest, Memory,
            InputList, DeferredList, FilteringSelect, underscore,
            template, i18nManage) {
    return declare([ Form, _LoadableMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        imageServiceUrl: '',

        templateString: template,
        rawValues: [],

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: i18nManage,

        postMixInProperties: function () {
            try {
                this.imageServiceUrl = config.get('primaryRoute') +
                                            '/store/product/selection' +
                                            this.saveService.identifier +
                                            '/image';
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        loadData: function (identifier) {
            try {
                this.loadingDeferred = new Deferred();
                this.set('identifier', identifier);

                var response = this.saveService
                                   .get('collectionStore')
                                   .get(identifier);

                if (!response.then) {
                    var obj = response;
                    response = new Deferred();
                    response.resolve(obj);
                }

                response.then(lang.hitch(this, function (res){
                            if (res.length < 1 ) {
                                this.loadingDeferred.resolve();
                                return this.set('value', {});
                            }
                            this.set('value', res);
                            this.loadingDeferred.resolve();
                        }));

                return this.loadingDeferred;
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        initProducts: function () {
            try {
                var store = new JsonRest({target: config.get('primaryRoute') + "/store/product"});

                var defList = new DeferredList([store.query()]);
                defList.then(lang.hitch(this, function (response) {
                    var fields = [{
                        w: FilteringSelect,
                        name: 'name',
                        args: {
                            searchAttr: 'name',
                            labelAttr: 'name',
                            maxLength: 250,
                            store: new Memory({data: response[0][1]})
                        }
                    }];

                    this.productsInstance = new InputList({fields: fields,
                                                            name: 'products[]'},
                                                           this.productsWidget);
                    this.productsInstance.attr('value',
                                                this.rawValues['products[]']);
                    this.own(this.productsInstance);
                }));
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        _setValueAttr: function (values) {
            try {
                this.inherited(arguments);

                if (this.productsInstance) {
                    this.productsInstance.attr('value', values['products[]']);
                }
            } catch (e) {
                console.error(this.declaredClass + " " + arguments.callee.nom, arguments, e);
                throw e;
            }
        },

        startup: function () {
            try {
                this.initProducts();
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
