define([
    'dojo/_base/declare',
    'dojo-common/store/JsonRest',
    'dojo/store/Cache',
    'dojo/store/Memory',
    'dojo/store/Observable',
    'hc-backend/public/js/src/hc-backend/config'
], function (declare, JsonRest, Cache, Memory, Observable, config) {
    return Observable(Cache(JsonRest({
        target: config.get('primaryRoute')+"/products",
        idProperty: 'id'
    }), Memory()));
});
