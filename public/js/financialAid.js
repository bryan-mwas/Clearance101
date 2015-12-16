
$(document).ready(function(){
  		var bal = 0;
    	var loan = 0;
    	var paid = 0;
    	$( "#loan" ).keyup(function(){
    		loan = $(this).val();
    		bal = (loan - paid);
  			$('#balance').val(bal);
  		}).keyup();
  		$( "#paid" ).keyup(function(){
    		paid = $(this).val();
    		bal = (loan - paid);
  			$('#balance').val(bal);
  		}).keyup();

  		$("#choiceNo, #choiceYes").change(function(){
    		$("#crbName").val("").attr("disabled",true);
    		if($("#choiceYes").is(":checked")){
    			$("#crbName").removeAttr("disabled");
    			$("#crbName").focus();
    		}else if($('#choiceNo').is(':checked')){
    			$("#crbName").val("").attr("disabled",true);
    		}
    	});
	});
