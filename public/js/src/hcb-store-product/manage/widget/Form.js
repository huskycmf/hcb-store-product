define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/widget/Form",
    "hc-backend/form/_HasPageFieldsMixin",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/config",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dijit/form/NumberTextBox",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox",
    "dojo-common/form/FileInputList"
], function(declare, Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin, config,
            template, i18nAdd) {
    return declare([ Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: i18nAdd,

        postMixInProperties: function () {
            try {
                this.filebrowserUploadUrl = config.get('primaryRoute') +
                                            '/store/product/' +
                                            this.saveService.identifier +
                                            '/images';
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
