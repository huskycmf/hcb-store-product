define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/dom-attr",
    "dojo/aspect",
    "hc-backend/widget/ContentLocalization/widget/Form",
    "hc-backend/form/_HasPageFieldsMixin",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/config",
    "dojo-common/store/JsonRest",
    "dojo/store/Cache",
    "dojo/store/Memory",
    "dojo-common/form/InputList",
    "dojo/DeferredList",
    "dijit/form/ComboBox",
    "dijit/form/FilteringSelect",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dijit/form/NumberTextBox",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox",
    "dojo-common/form/FileInputList",
    "dijit/form/Select",
    "dijit/form/CheckBox"
], function(declare, lang, domAttr, aspect, Form, _HasPageFieldsMixin,
            _WidgetsInTemplateMixin, config,
            JsonRest, Cache, Memory, InputList, DeferredList, ComboBox, FilteringSelect,
            template, i18nAdd) {
    return declare([ Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',
        filebrowserServiceUrl: '',
        instructionUploadUrl: '',
        thumbnailServiceUrl: '',
        image3dServiceUrl: '',

        templateString: template,
        rawValues: [],

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: i18nAdd,

        postMixInProperties: function () {
            try {
                this.restProductStore = Memory();
                this.restCategoryStore = Memory();

                (JsonRest({
                    target: config.get('primaryRoute')+"/store/product"
                })).query().forEach(lang.hitch(this, function (item){
                    this.restProductStore.put(item);
                })).then(lang.hitch(this, function (){
                    this.modelToReplaceWidget.attr('value', this.rawValues['replaceProduct']);
                }));

                (JsonRest({
                    target: config.get('primaryRoute')+"/store/product/category?enabled=1"
                })).query().forEach(lang.hitch(this, function (item){
                    this.restCategoryStore.put(item);
                })).then(lang.hitch(this, function (){
                        this.categoryWidget.attr('value', this.rawValues['category']);
                }));

                this.instructionUploadUrl = config.get('primaryRoute') +
                                            '/store/product/instruction';

                this.filebrowserUploadUrl = config.get('primaryRoute') +
                                            '/store/product/images';

                this.filebrowserServiceUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/images';

                this.thumbnailServiceUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/thumbnail';

                this.image3dServiceUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/image3d';
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        initCrosssell: function () {
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

                    this.crosssellInstance = new InputList({fields: fields,
                                                            name: 'crosssell[]'},
                                                           this.crosssellWidget);
                    this.crosssellInstance.attr('value',
                                                this.rawValues['crosssell[]']);
                    this.own(this.crosssellInstance);
                }));
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        initAttributes: function () {
            try {
                var store = new JsonRest({target: config.get('primaryRoute') + "/store/product/localized/attributes"});

                var defList = new DeferredList([store.query()]);

                defList.then(lang.hitch(this, function (response) {
                    var fields = [{
                        w: ComboBox,
                        name: 'name',
                        args: {
                            searchAttr: 'name',
                            labelAttr: 'name',
                            maxLength: 250,
                            store: new Memory({data: response[0][1]})
                        }
                    }];

                    this.attributesInstance = new InputList({fields: fields,
                            name: 'attributes[]'},
                        this.attributesWidget);
                    this.attributesInstance.attr('value',
                                                 this.rawValues['attributes[]']);
                    this.own(this.attributesInstance);
                }));
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },


        initCharacteristics: function () {
            try {
                var nameStore = new JsonRest({target: config.get('primaryRoute') + "/store/product/localized/characteristics"});
                var valueStore = new JsonRest({target: config.get('primaryRoute') + "/store/product/localized/characteristics/values"});

                var defList = new DeferredList([nameStore.query(), valueStore.query()]);

                defList.then(lang.hitch(this, function (response) {
                    var fields = [{
                        w: ComboBox,
                        name: 'name',
                        onChange: function (value) {
                            try {
                                this._getWidgetByName('value').query = {name: value};
                            } catch (e) {
                                console.error(this.declaredClass + " " + arguments.callee.nom, arguments, e);
                                throw e;
                            }
                        },
                        args: {
                            searchAttr: 'name',
                            labelAttr: 'name',
                            maxLength: 250,
                            store: new Memory({data: response[0][1]})
                        }
                    },
                        {
                            w: ComboBox,
                            name: 'value',
                            args: {
                                maxLength: 1024,
                                store: new Memory({data: response[1][1]}),
                                labelAttr: 'value',
                                searchAttr: 'value'
                            }
                        }];

                    this.characteristicInstance = new InputList({fields: fields,
                            name: 'characteristics[]'},
                        this.characteristicsWidget);
                    this.characteristicInstance
                        .attr('value', this.rawValues['characteristics[]']);
                    this.own(this.characteristicInstance);
                }));
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        _setValueAttr: function (values) {
            try {
                this.inherited(arguments);

                if (this.characteristicInstance) {
                    this.characteristicInstance.attr('value', values['characteristics[]']);
                }

                if (this.attributesInstance) {
                    this.attributesInstance.attr('value', values['attributes[]']);
                }

                if (this.crosssellInstance) {
                    this.crosssellInstance.attr('value', values['crosssell[]']);
                }

                if (values['instruction'] && values['instruction'].length) {
                   domAttr.set(this.instructionNameNode,
                               'innerHTML', values['instruction']);
                }

            } catch (e) {
                console.error(this.declaredClass + " " + arguments.callee.nom, arguments, e);
                throw e;
            }
        },

        postCreate: function () {
            try {
                this.modelToReplaceWidget.attr('store', this.restProductStore);
                this.categoryWidget.attr('store', this.restCategoryStore);

                aspect.after(this.instructionWidget, 'onComplete',
                             lang.hitch(this, function (def, response){
                                 if (response && response[0] && response[0].name) {
                                     domAttr.set(this.instructionNameNode,
                                                 'innerHTML', response[0].name);
                                     this.instructionWidget.attr('value', response[0].name);
                                 }
                            }));

                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        startup: function () {
            try {
                this.initCharacteristics(this.get('lang'));
                this.initAttributes(this.get('lang'));
                this.initCrosssell(this.get('lang'));
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
