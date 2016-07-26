$(document).ready(function(){
    $('.vmIP').click(function() {
    	//$(this).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
    	$button = $(this);
    	$id = $button.attr('data-uid');
    	$image = $button.attr('id');
    	$.ajax({
    	    url: '/eLab-GUI-web-portal/models/OCI_API.class.php',
    	    type: 'post',
    	    data: { "getInstanceID": $id, "getInstanceImage": $image },
    	    success: function(response) {
    	    	$button.text(response);
    	    },
    	    error: function(exception) {
    	    	$button.text("IP Not Found");
    	    }
    	});
    })
});