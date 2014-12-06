define([
    "dojo/_base/declare",
    "dojo/_base/lang",
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
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dijit/form/NumberTextBox",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox",
    "dojo-common/form/FileInputList",
    "dijit/form/Select",
    "dijit/form/FilteringSelect",
    "dijit/form/CheckBox"
], function(declare, lang, Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin, config,
            JsonRest, Cache, Memory, InputList, DeferredList, ComboBox, template, i18nAdd) {
    return declare([ Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',
        thumbnailUploadUrl: '',
        image3dUploadUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: i18nAdd,

        postMixInProperties: function () {
            try {

                this.restStore = Cache(JsonRest({
                    target: config.get('primaryRoute')+"/store/product"
                }), Memory());

                this.filebrowserUploadUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/images';

                this.thumbnailUploadUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/thumbnail';

                this.image3dUploadUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/image3d';
                this.inherited(arguments);
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
                            onChange: function (value) {
                                try {
                                    alert(11);
                                } catch (e) {
                                    console.error(this.declaredClass + " " + arguments.callee.nom, arguments, e);
                                    throw e;
                                }
                            },
                            args: {
                                maxLength: 1024,
                                store: new Memory({data: response[1][1]}),
                                labelAttr: 'value',
                                searchAttr: 'value'
                            }
                        }];

                    this.own(new InputList({fields: fields,
                            name: 'characteristics'},
                        this.characteristicsWidget));
                }));
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        postCreate: function () {
            try {
                this.modelToReplaceWidget.attr('store', this.restStore);
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        startup: function () {
            try {
                this.initCharacteristics(this.get('lang'));
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
