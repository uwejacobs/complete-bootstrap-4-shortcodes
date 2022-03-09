<?php

// ======================================================================== //		
// Get the contents of the help document, save them in a variable
// ======================================================================== // 

$html = file_get_contents(dirname(__FILE__) . '/help/README.html');

// ======================================================================== // 



// ======================================================================== //		
// Include some jQuery to edit the help document
// ======================================================================== //
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        // ======================================================================== //		
        // Send example shortcodes to the TinyMCE editor when an "Insert Example"
        // button is clicked.
        // ======================================================================== //
        
	    jQuery(".insert-code").click(function() {
		var example = jQuery( this ).parent().prev().find("code").text();
                var lines = example.split('\n');
		var paras = '';
		if ((typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
			eol = '<br>';
		} else {
			eol = '\r\n';
		}
                jQuery.each(lines, function(i, line) {
                    if (line) {
                        paras += line + eol;
                    }
                });
                var win = window.dialogArguments || opener || parent || top;
                win.send_to_editor(paras);
            });
        
        // ======================================================================== //
    
    
        
        // ======================================================================== //		
        // Create tabs from the help documentation content, splitting on the H2s
        // ======================================================================== //
        
            jQuery('#bootstrap-shortcodes-help h2').each(function(){
                var id = jQuery(this).attr("id");
                jQuery(this).removeAttr("id").nextUntil("h2").andSelf().wrapAll('<div class="tab-pane" id="bs-' + id + '" />');
            });
            //Make the documentation tab active
            jQuery('#bs-shortcode-reference').addClass('active');
        
            //Hide header info from the readme, not relevent to documentation.
            jQuery("#bootstrap-shortcodes-help #complete-bootstrap-4-shortcodes").nextUntil("#bootstrap-shortcodes-help #bs-requirements").hide();
        
        // ======================================================================== //
        
    });
</script>

<script type="text/javascript">
    
    // ======================================================================== //		
    // Make the documentation popup modal scrollable
    // Originally from: http://stackoverflow.com/questions/9899676/twitter-bootstrap-scrollable-modal
    // ======================================================================== //
    
        jQuery(document).ready(adjustamodal);
        jQuery(window).resize(adjustamodal);
        function adjustamodal() {
            var altura = jQuery(window).height() - 155; //value corresponding to the modal heading + footer
            jQuery(".ativa-scroll").css({"height":altura,"overflow-y":"auto"});
        }
    
    // ======================================================================== //

</script>

<?php
// ======================================================================== //		
?>



<?php
// ======================================================================== //		
// Create the documentation popup modal
// ======================================================================== //
?>

<div id="bootstrap-shortcodes-help" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Bootstrap Shortcodes Help</h4>  
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#bs-shortcode-reference" data-toggle="tab">Shortcode Reference</a></li>
                    <li><a href="#bs-requirements" data-toggle="tab">System Requirements</a></li>
                </ul>   
            </div>
            
            <div class="modal-body ativa-scroll">
                <div>
                    <div id="bs-top" class="tab-content">

                    <?php
                        // ======================================================================== //		
                        // Put HTML content in the page so we can pop it up in a modal
                        // But first edit the HTML to make it more useful as popup documentation
                        //      * Alter links to open in new tabs
                        //      * Add Bootstrap styling to tables
                        //      * Add Bootstrap styling to lists (and replace ULs with DIVs, and LIs with As)
                        //      * Edit anchors to be on-page jumps
                        //      * Add back-to-top buttons after sections
                        //      * Add IDs to h3 tags for the above on-page jumps
                        //      * Add "Insert Example" buttons after code examples
                        // ======================================================================== //
                        
                        $html = preg_replace('/(<a href="https:[^"]+")>/is','\\1 target="_blank">',$html);
                        $html = str_replace('<table>', '<table class="table table-striped">', $html);
                        $html = str_replace('<ul>', '<div class="list-group">', $html);
                        $html = str_replace('</ul>', '</div>', $html);
                        $html = str_replace('<li><a ', '<a class="list-group-item" ', $html);
                        $html = str_replace('</li>', '', $html);
                        $html = str_replace('href="#', 'href="#bs-', $html);
                        $html = str_replace('<hr>', '<hr><a class="btn btn-link btn-default pull-right" href="#bs-top"><i class="fas fa-long-arrow-alt-up text-muted"></i></a>', $html);
                        $html = str_replace('<h3 id="', '<h3 id="bs-', $html);
                        $html = str_replace('<h4 id="', '<h4 id="bs', $html);
                        $html = str_replace('</pre>', '</pre><p><button data-dismiss="modal" class="btn btn-primary btn-sm insert-code"><i class="fas fa-share-square"></i> Insert Example</button></p>', $html);
                        $html = preg_replace("/<img[^>]+\>/i", "", $html);
                        //Insert the HTML now that we're done editing it
                        echo $html;
                        
                        // ======================================================================== //

                    ?>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
// ======================================================================== //
?>
