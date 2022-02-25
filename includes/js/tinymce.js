(function() {
    tinymce.create("tinymce.plugins.bs_button_plugin", {

        init : function(ed, url) {

            ed.addButton("bs_help_button", {
                title : "Bootstrap Shortcodes",
                onclick: function() { jQuery("#bootstrap-shortcodes-help").modal('show'); },
                image : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAA3lBMVEUAAABZPXpWPXxWPHxWPXxXPHxXQHpVPn1WPXxWPXxXPX1WPXxWPXxWPXxWPXxWPXxVPn1TO31WPn1VPXlWPXxZQX9hSoWKeKT////o5e64rshqVIv29fh9apr8/P27scvCudDg2+fo5O1XP335+Pqom7t1YZRgSISGdKFbQ4D9/f2Ofqjk4er6+vt4ZJaCcJ6qnr339vn08/fx7/T7+vyvo8H6+fttV417aJmzqMSUhazi3uh4ZZf+/v55ZZetob/8+/xcRIFxW5Grnr7Nxtjz8fbTzN2xpsOai7BwW5A5ZpDEAAAAFHRSTlMALqbo56UsWvn4WKT+/eajLStWKigdCssAAAABYktHRBibaYUeAAAAB3RJTUUH4wsICSsl3MXI0wAAAOtJREFUOMuF03tTgkAUBfArKgYaWK52yxS1oiylh1r5Rsoe3/8LuWg4NS1nz187ww84u3OXiDJGViiTy5skUzgQqbFs+T54LoVJhoApUhaDHJUwKFGyqtaS/BV7cML7nJ7VMWA+byhB04vTakvRuVCBy5/llRQ+AtcS3CDQvdV84Y65p+zQD+LcPzzyU4C3OfB15zAcKcHzyzavY1lygkqKEfMUghnzvIvAQtaoI7BkDleqkrt5iN5C5ne8TV5HGHxE/8/B95J8fn3/HjnN0B7qxt6hPAYulS149Y6IbCCs4/h6m0Un5f9uhWgDHJpYkq/KzR0AAAAldEVYdGRhdGU6Y3JlYXRlADIwMTktMTEtMDhUMDk6NDM6MzcrMDA6MDCC18JaAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE5LTExLTA4VDA5OjQzOjM3KzAwOjAw84p65gAAAABJRU5ErkJggg=="
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Bootstrap 4 Shortcodes Button",
                author : "Uwe Jacobs",
                version : "4.6.3"
            };
        }
    });

    tinymce.PluginManager.add("bs_button_plugin", tinymce.plugins.bs_button_plugin);
})();
