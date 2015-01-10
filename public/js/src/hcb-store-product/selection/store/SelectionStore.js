define([
    'dojo-common/store/JsonRest',
    'dojo/store/Cache',
    'dojo/store/Memory',
    'dojo/store/Observable',
    'hc-backend/config'
], function (JsonRest, Cache, Memory, Observable, config) {
    return Observable(Cache(JsonRest({
        target: config.get('primaryRoute')+"/store/product/selection",
        idProperty: 'id'
    }), Memory()));
});
