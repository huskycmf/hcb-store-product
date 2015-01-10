define([
    "dojo/_base/declare",
    "hc-backend/layout/main/content/manage/Container",
    "./Form",
    "../store/SelectionStore"
], function(declare, Container, Form, SelectionStore) {

    return declare([ Container ], {
        store: SelectionStore,
        containedWidget: Form
    });
});
