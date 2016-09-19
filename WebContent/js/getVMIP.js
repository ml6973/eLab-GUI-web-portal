$(document).ready(function(){
    $('.vmIP').click(function() {
    	//$(this).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
    	$button = $(this);
    	$id = $button.attr('data-uid');
    	$name = $button.attr('data-uname');
    	$image = $button.attr('id');
    	$vmtype = $button.attr('data-vmtype');
    	$info = document.getElementById($image + "_info");
    	$info = $($info);
    	$command = document.getElementById($image + "_command");
    	$command = $($command);
    	console.log($command);
    	$.ajax({
    	    url: '/eLab-GUI-web-portal/models/OCI_API.class.php',
    	    type: 'post',
    	    data: { "getInstanceID": $id, "getInstanceImage": $image },
    	    success: function(response) {
    	    	if (response.length) {
    	    		$button.hide();
    	    		if ($vmtype != null && $vmtype === "jupyter") {
    	    			$command.val("http://" + response + ":8888/");
    	    		}else{
    	    			$command.val("ssh " + $name + "@" + response);
    	    		}
    	    		$info.show();
    	    	}else
    	    		$button.text("Lab Machine Not Available");
    	    },
    	    error: function(exception) {
    	    	$button.text("IP Not Found");
    	    }
    	});
    })
});