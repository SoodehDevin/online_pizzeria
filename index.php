<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Emilio Pizzeria</title>
<script>var NREUMQ=[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>

    
 <script src="js/info.js"></script> 
 <script src="js/main.js"></script>
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
           Welcome to Emilio Pizzeria
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
    <h1>Top ten pizzas</h1>
    
    <?php 
    
    
    		
		$doc = new DOMDocument;
		$doc->load('pizzeria.xml');

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
    
    
    
    <div id="quantity">
       <div id="quantity-form">
        <form action="#"> 
                 
        <fieldset id="view"> 
           <legend>View order</legend>  
             <div class="sort"><label class="label"><span >Name:</span></label>
                               <label class="label"><span id="lbl_pizza_name"></span></label>
             </div>
               <div class="sort"><label class="label"><span >Quantity:</span></label>
                                <input type="text" id="how-many-1" class="wheelable" value="1" name="how-many-1" size="3" /> <!-- <input name="quantiy"  type="text" id="p_quantity" /> -->
                                                               
               </div>
         </fieldset>
         </form>
         <input name="button_quantity" type="button" id="b_add" value="Add to order"/> 
         </div>
      
      
      
      <div id="check">
       <div id="check-form">
          <form action="check">
            <fieldset id="order"> 
           <legend>Your order</legend>  
             
               <div id="check_out"></div>
         </fieldset>
         </form>
         <input name="button_quantity" type="button" id="b_checkout" value="checkout" />
         </div>
      </div>
      </div>
   
       
   <div id="container">
	<div id="accordion">
	
	<?php
	
	

	// Location of the XML file on the file system
	$file = 'pizzeria.xml';
	$xml = simplexml_load_file($file);
	
	


		if (count($xml-> menu -> pizza) > 0) {
    		foreach ($xml-> menu -> pizza as $node) {
    			
    			$flag = true; // This flag is used to control the availability of pizzas!
    			
    			// checking the existence of each pizza's ingredients
    			
    			foreach ($node -> ingredient as $pizza_ingredinet) {
					
					
						foreach ($xml -> storage -> ingredient as $ingredient){
					
							if( $ingredient['id'] == $pizza_ingredinet['id'] ){
								if($ingredient['in_storage'] < $pizza_ingredinet['units']) 
									$flag = false;
									
									
									
							}
						}
						
					
					
				}
				if($flag == true) {
									echo "<div class='item'>";
    								echo "<a href='#' >";
    			
      	  						// This prints out each of the pizza
    								echo $node -> name;
									echo "</a>";
									echo "<span>";
									echo $node -> description;
									echo "</span>";
									echo "<br />";
									echo "Ingredients : ";
									echo "<br />";
									
									foreach ($node -> ingredient as $pizza_ingredinet) {
										foreach ($xml -> storage -> ingredient as $ingredient){
					
											if( $ingredient['id'] == $pizza_ingredinet['id'] ){
																	
											echo "<span>";
											echo $ingredient['name'];
											echo ",";
											echo "</span>";
					
											}		
									
										}
									}
									
									echo "<br />";
									echo "<br />";
									echo "<input name='button_quantity' type='button' class ='b_select' value='Select' />";
									echo "</div>";
    			
    			
    			}
				
    		}
		}

	?>
	

		

		
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
