$(document).ready(function() {
	
	
	
	

	$('#recepies').click(
	
		function() {
				$('#ing_edit').hide();
				$('#addrecipie').hide();
  				$('#navcontainer').show(1000);

				}
  		);
  		
  
  	$('#add_recepie').click(
	
		function() {
				$('#ing_edit').hide();
				$('#navcontainer').hide();
  				$('#addrecipie').show(1000);

				}
  				
  		);
  		
  $('#ingredients').click(
	
		function() {
				$('#navcontainer').hide();
  				$('#addrecipie').hide();
  				$('#ing_edit').show(1000);

				}
  				
  		);
  
  
  /**************************************************************/
  
  // Here we control the edit of the recipies!
  
  
  $('img.edit').click(function() {
  	
				$(this).parents('li').siblings('li').hide(); 
				//$(this).parent('li').hide();
				$(this).parents('li').children().hide(); 				
  				$(this).siblings('div.add_input_label').show(1000);
  				//$(this).hide();
  				//$(this).next().hide();
  				//$(this).next().next().hide();
  				//$(this).next().next().next().hide();
  				//$(this).next().next().next().next().show();
  				
  		});		
  	

	// Delete the recipie 
	
	$('img.del').click(function() {
  	
				// Show the confirmation box  				
  				var cnfirm = confirm('are you sure you want to delete this recepie?');
  				
  				if(cnfirm) {
  					
					$.ajax({
  					type: 'POST',
  					url: "delete.php",
  					data: {item : 'pizza' , id: $(this).parent().attr('id')},
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					});  					
  					
  					
  					$(this).parent().hide(1000);
  					$(this).parent().siblings('li').show(1000);
  				}
  				//alert("removed");
  		});
  		
  		
  		
  		$('.img_cancel_recepie').click(function() {
  			//$(this).siblings('div.edit_div').hide(1000);
  			$(this).parent().parent('li').show(1000);
  			$(this).parent().parent('li').children().show();
  			$(this).parent().parent('li').siblings('li').show();
  			$(this).parent('div').hide();

	});
	
	
		$('.img_save_recepie').click(function() {
			
			var tmp = $(this).siblings('form.frm_pizza').serialize();
			
			//alert(tmp);
			
			$.ajax({
  					type: 'POST',
  					url: "save.php",
  					data: tmp,
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					});  					
			
			$(this).parent().parent('li').show(1000);
  			$(this).parent().parent('li').children().show();
  			$(this).parent().parent('li').siblings('li').show();
  			$(this).parent('div').hide();
			alert("recipie saved successfully");
			
			
			});
	
	
	
	
	/*************************************************************/
	
	// Edit the ingredients part
	
	$('img.edit_ing').click(function() {
  	
  				$(this).siblings('label').hide();
  				$(this).siblings('input').show();
  				$(this).next().hide();
				$(this).hide();
				$(this).siblings('img.save_ing').show();
				$(this).siblings('img.cancel_ing').show();
  		});	
  		
  		
  		
  	$('img.del_ing').click(function() {
  	
				// Show the confirmation box  				
  				var $confirm = confirm('are you sure you want to delete this ingredient?');
  				
  				var xmldata = $(this).parent('form').serialize();
  				
  				if($confirm) {
  					$(this).parent().parent('li').hide(1000);
  					//$(this).parent().siblings('li').show(1000);
  					
  					$.ajax({
  					type: 'POST',
  					url: "del_ingredient.php",
  					data: xmldata,
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					}); 
  					
  					
  					
  				}
  				//alert("removed");
  		});		
	
	$('img.cancel_ing').click(function() {
  	
  				$(this).siblings('label').show();
  				$(this).siblings('input').hide();
  				$(this).prev().hide();
				$(this).hide();
				$(this).siblings('img.edit_ing').show();
				$(this).siblings('img.del_ing').show();
  		});	
  		
  		
  		
  	$('#img_ing_add').click(function() {
  		
  				if(($('#ing_name_label').val() == '') || ($('#ing_storage_label').val() == '')) {
					alert("Please fill in the name and amount of the ingredient!");
					return;
					}
				else {
					alert("Ingredient added successfully!");
					// add ing to xml part
					
					var xmldata = $(this).parent('form').serialize();
					
					$.ajax({
  					type: 'POST',
  					url: "add_ingredient.php",
  					data: xmldata,
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					}); 
					
					
					
				}
		});

	$('img.save_ing').click(function() {
		
				var xmldata = $(this).parent('form').serialize();
				
				//alert(xmldata);
				
				$.ajax({
  					type: 'POST',
  					url: "change_ingredient.php",
  					data: xmldata,
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					}); 			
				
								var new_stor = $(this).prev().prev().val();
				
								$(this).siblings('label').show();
								$(this).siblings('.in_storage_lbl').text(new_stor);
  								$(this).siblings('input').hide();
  								$(this).next().hide();
  								$(this).hide();
  								$(this).next().next().show();
								$(this).next().next().next().show();
								
				
				});	



	/****************************************************************************/
	// Save recepie section
	
	
	$('#img_save_recepie').click(function() {


			var flag = false;
			
			if(($('input#name_save_recepie').val() == '') || ($('input#desc_save_recepie').val() == '')) {
					alert("Please fill in the name and description of the pizza!");
					return;
					}
			
			// loop trough ingredient to check their value not be all zero!	
			$('input.ing_unit').each(function () { if ($(this).val() != 0) flag = true;});
				
				
			if(flag == false)
				alert("please choose at least one ingredient!");
			else {
				alert("pizza added successfully!");
				var frmdata = $(this).next('form').serialize();
				
				//alert(frmdata);
			
			$.ajax({
  					type: 'POST',
  					url: "save_new.php",
  					data: frmdata,
  					success: function(){},
  					
  					error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }  
					});  					
							
				
				
			}
			
							
	});








});