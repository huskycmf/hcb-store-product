define([], function() {
    return {
        "route": "/store/product",
        "prio": 6,
        "modules": [{
            "route": "",
            "module": "list/Container"
        }, {
            "route": "/create",
            "subRoutes": {
                "/:lang": function (evt) { this.getInstance().selectLanguageTab(evt.params.lang); },
                "": function () { this.getInstance().selectLanguageTab(); }},
            "module": "create/Container"
        }, {
            "route": "/update/:id",
            "subRoutes": {"/:lang": function (evt) { this.getInstance().selectLanguageTab(evt.params.lang); },
                "": function () { this.getInstance().selectLanguageTab(); }},
            "module": "update/Container"
        }, {
            "route": "/selection",
            "module": "selection/list/Container"
        }, {
            "route": "/selection/create",
            "module": "selection/manage/Container"
        },  {
            "route": "/selection/update/:id",
            "module": "selection/manage/Container"
        }]
    }
});
