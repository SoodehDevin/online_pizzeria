<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Emilio Pizzeria</title>
<script>var NREUMQ=[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>

    <script type="text/javascript" src="js/script.js"></script>
 <script src="js/info.js"></script>
 <script src="manager.js"></script>
<link href="style.css" rel="stylesheet"  />

</head>

<body  class="home blog">
  <div id="wrapper" class="hfeed">
   <div id="info">
  
    <div class="tip">
      
	  <p>For ordering a pizza you should follow these steps:</p>
	  <ul>
	    <li>1.Select your desired pizza from the menu.</li>

	    <li>2.Order your selected pizza by clicking on the name of the pizza.</li>
	    <li>3.Enter the quantity of the pizzaz you would like to order.</li>
	    <li>4.Click on the Add to order botton.</li>
	    <li>5.You can edit your order in the "Your order" form.</li>
	    <li>6.Click on Checkout botton to finalize your shopping and see the progress.</li>
	   </ul>
        </div>
      </div>

   <div id="header">
    <div id="masthead">
    
     <div id="ttw-site-logo"></div>
      <div id="ttw-site-logo-link" onclick="location.href= '.'" style="cursor:pointer"></div>
     
        <h1 id="site-title">
         <span>
           Welcome to Administration Section
         </span>          
        </h1>
     
     <div id="nav-top-menu"><div id="access2" role="navigation"></div></div>
      <div id="branding" role="banner">
      <!-- <img src="pizza1.jpg" alt="pizza" width="940" height="198" /> -->
      </div><!-- branding -->
      <div id="nav-bottom-menu">
       <div id="access" role="navigation">
        <div id="menu">
       
       </div>
      </div><!-- access -->      
      </div><!-- nav-bottom-menu -->
    </div> <!-- masthead -->
  </div> <!-- header -->  
     
   <div id="main">
   
    
   <div id="top-ten">
    <div id="accordion">
		<div class="item">
			<a href="#" id="recepies">Recepies</a>
			<img src="../img/rec.jpeg"/>
		</div>
		<div class="item">
			<a href="#" id="add_recepie">Add recepie</a>
			<img src="../img/recipie.jpeg"/>
		</div>
		
		<div class="item">
			<a href="#" id="ingredients">Ingredients</a>
			<img src="../img/ingredients.jpg"/>			
		</div>
	</div>
    
    

       
    </div>
    
    
    
    <div id="quantity">
       
    <div id="quantity-form">
        
                 
        <fieldset id="view"> 
           <legend>Top ten pizzas</legend>  
            
    <?php 
    
    
    		
		$doc = new DOMDocument;
		$doc->load('../pizzeria.xml');

		$xpath = new DOMXPath($doc);
		$query = '/pizzeria/menu/pizza';
		$queryname = '/pizzeria/menu/pizza/name';
		//$querypop = '/pizzeria/menu/pizza/popularity';
		
		$tmp_arr = array();
		
      		
		
		foreach($xpath->query($queryname) as $pizza) {
 	   	
 	   	
 	   			$name = $pizza -> nodeValue;
 	   			
 	   			$querypop = sprintf('/pizzeria/menu/pizza[name= "%s" ]/popularity',$name);
 	   			
 	   			$pop = ($xpath-> query($querypop) -> item(0)); 
 	   			
 	   			$popnode = $pop -> nodeValue;
 	   			//$pop = $pizza -> childNodes -> item(2) -> textContent;
 	   	
 	 
 	   			$tmp_arr[$name] = $popnode;
 	   	
 	   	 	
 	   	
	 	}		
	 	
	 	
		// very useful sort function that 
		// works in a way that array indices maintain 
		// their correlation with the array elements they are associated with
		
		asort($tmp_arr); 
		//print_r($tmp_arr);

    echo "<ol>";
	

       
    for ($i=0;$i<10;$i++){
    			
    			//$popul = array_pop($tmp_arr);
    			$mostpop = array_splice($tmp_arr, -1 , 1 );
    			//$queryname = sprintf('/pizzeria/menu/pizza[popularity= "%s" ]/name',$popul);
    			
    			//$piz_name = ($xpath-> query($queryname) -> item(0));
    			//$namenode = $piz_name -> nodeValue;
    			
				foreach ($mostpop  as $key => $val) {
    					echo "<li>" . $key . "</li> ";
				}    			
    			
    		
    	}
    	
  
    
    echo "</ol>";
    
    
		?>
      
      
      </div>
      </div>
   
       
   <div id="container">
   
   <div id="navcontainer">
      <ul class="navlist">
      
      <?php
	
	

	// Location of the XML file on the file system
	$file = '../pizzeria.xml';
	$xml = simplexml_load_file($file);
	
	


		if (count($xml-> menu -> pizza) > 0) {
    		foreach ($xml-> menu -> pizza as $node) {
    			
    			//$flag = true; // This flag is used to control the availability of pizzas!
    			
    			// checking the existence of each pizza's ingredients
			
    								$pop = $node -> popularity;
									$tmp_name = ($node -> name);
									$name = $tmp_name;
									$desc = ($node -> description);
									$piz_id = $node['id'];
									echo "<li id=$piz_id>";
									
									
									////////////////////////////////////////////////////////////////
																		
									echo	"<div class='add_input_label'>";
									
									
									echo	"<img src='../img/save.jpeg' style='float:right;margin-right:20px;' class='img_save_recepie'/>";
			   					echo  "<img src='../img/cancel.jpeg' style='float:right;' class='img_cancel_recepie' />";
		
			
				echo  "<form class = 'frm_pizza'>";
			
				
				echo "<label> Pizza name: </label> <input type='text' class='edit_input' value ='$name' name = 'pizza_name' /><br />";
			   echo "<label> Description: </label> <input type='text' class='edit_input' value = '$desc'  name = 'description' /><br />";			
			
				

			
				
				
				$tmp_arr_all = array();		
				$tmp_arr = array();
				
				foreach ($xml -> storage -> ingredient as $ingredient) {
					
											$id = $ingredient['id'];
											$ing_name = $ingredient['name'];
											
											foreach ($node -> ingredient as $ingred) {
												
												$unit = $ingred['units'];
												if( $ingred['id'] == $id ) {
													
													echo "<label> $ing_name </label> <input type='text' class='edit_input' id =$id value = $unit name = $id /> <br />";
													array_push($tmp_arr,$id);
												}
												else 
													if (in_array($id, $tmp_arr_all) == FALSE) {
    													

															array_push($tmp_arr_all,$id);
															
													}
													
												//echo "<label> $ing_name </label> <input type='text' class='edit_input' value = $unit /> <br />";
											}
											
									}			
			
				
				echo "<hr style='margin-right:10px;'>";
				echo 	"<ul class='navlist'>";
				
				$diff_arr = array_diff($tmp_arr_all,$tmp_arr);
				
				foreach ($diff_arr as &$value) {
					foreach ($xml -> storage -> ingredient as $ingredient) {
						$nam = $ingredient['name'];
						if ($ingredient['id'] == $value)
    					echo "<li><label> $nam </label> <input type='text' class='ing_unit' id = $value value = 0 style='width:20px;' name = $value /> <br /></li>";
					}
				}
				
			
				
				
				echo "</ul>";
				echo "</form>";
				echo "</div>";	
				
				
				////////////////////////////////////////////////////////////////////////////////////////
    								
    			
      	  						// This prints out each of the pizza
    								echo "<label > $tmp_name  </label> ";
    								echo "<br />"; 
    								echo "<label style = 'font-size:10px;'> Popularity: </label> ";     								
    								echo "<label style = 'font-size:10px;'> $pop  </label> ";
    								echo "<br />";
    								echo "<img src='../img/edit.png' class = 'edit' />";
    								echo "<img src='../img/delete.png' class = 'del' />";
									
									
									//echo "</li>";
									
									
									
								
    			
    			
    			}
				
    		}
		

	?>
      
      
      
    
		</ul>
	</div>
	
	
	
	<div id="ing_edit">
		<span> Add new Ingredient Here</span> <br /><br />
		<form class="add_new_ing">
		<label for="ing_name_label"> Name: </label> <input type='text'  id = "ing_name_label" name="ing_name"/>
		<label for="ing_storage_label"> Instorage: </label> <input type='text'  id = "ing_storage_label" name="ing_storage"/>
		<img src='../img/save.jpeg' style="margin-left:10px;margin-top:5px;" id="img_ing_add" /> 
		</form>
		<hr>
      <ul class="navlist">
     
			<?php
			
				foreach ($xml -> storage -> ingredient as $ingredient) {
					
						$name = $ingredient['name'];
						$storage = $ingredient['in_storage'];
				
						echo "<li><form class='ingredient_form'><label> $name </label> <label class ='in_storage_lbl'> $storage </label> <input type='text' class='edit_ing_input' value = '$name' name='name' /><br /><input type='text' class='edit_ing_input' value = '$storage' name='storage' /> <br /><img src='../img/save.jpeg' class = 'save_ing' /><img src='../img/cancel.jpeg' class = 'cancel_ing' /><img src='../img/edit.png' class = 'edit_ing' /><img src='../img/delete.png' class = 'del_ing' /></form></li>";
					
				}	
			?>
		
		</ul>
	</div>
	
	
	
	
	
	
	
	
	
	
	<div id="addrecipie">
	
			<img src='../img/save.jpeg' style='float:right;margin-right:20px;' id="img_save_recepie" />
			<form class="addrecepie">
			<label> Pizza name: </label> <input type='text' id="name_save_recepie" name="save_recep_name" /> <br />
			<label> Description: </label> <input type='text' id="desc_save_recepie" name="desc_recep_name" /> <br />
			<hr style='margin-right:10px;'>
			
			<ul class="navlist">
			<?php
			
				foreach ($xml -> storage -> ingredient as $ingredient) {
					
						$id = $ingredient['id'];
						$name = $ingredient['name'];
						$storage = $ingredient['in_storage'];
						
						echo "<li><label> $name </label> <input type='text' class='ing_unit' value = 0 style='width:20px;' name= $id /> <br /></li>";
								
				}	
			?>
			</ul>
			</form>
	</div>
 
    </div><!-- container -->     
    
    
    
    
      
      
    </div>     
   </div><!-- main -->
   
   
     <div id="footer">
       <div id="colophon">
         <table id='ttw-ftable' ><tr>
         <td id="ttw-ftdl">
          <div id="site-info"> <span id="siteinf">&copy; 2014 </span> </div>         
         </td>
         </tr>
         </table>       
          
     </div><!-- colophon -->
    
   </div> <!-- footer -->
   </div> <!-- wrapper -->
   </body> 
  </html>
