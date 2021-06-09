jQuery(document).ready(function(){
    // Add minus icon for collapse element which is open by default
    jQuery(".collapse.show").each(function(){
    	jQuery(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });
        
    // Toggle plus minus icon on show hide of collapse element
    jQuery(".collapse").on('show.bs.collapse', function(){
    	jQuery(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function(){
    	jQuery(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });
});
