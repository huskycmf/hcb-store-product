define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "hc-backend/widget/ContentLocalization/widget/Form",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/config",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox"
], function(declare, array, Form, _WidgetsInTemplateMixin, config,
            template, translation) {

    return declare([ Form, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: translation,

        postMixInProperties: function () {
            try {
                this.filebrowserUploadUrl = config.get('primaryRoute')+'/static-page/image';

                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
