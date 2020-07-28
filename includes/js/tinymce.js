(function() {
    tinymce.create("tinymce.plugins.bs_button_plugin", {

        init : function(ed, url) {

            ed.addButton("bs_help_button", {
                title : "Bootstrap Shortcodes",
                onclick: function() { jQuery("#bootstrap-shortcodes-help").modal('show'); },
                image : "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Bootstrap_logo.svg/32px-Bootstrap_logo.svg.png"
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Bootstrap Shortcodes Button",
                author : "Uwe Jacobs",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("bs_button_plugin", tinymce.plugins.bs_button_plugin);
})();