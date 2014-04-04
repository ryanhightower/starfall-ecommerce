<?php  include("includes/functions.php");
if (session_status() == PHP_SESSION_NONE) {
//    echo "session_start"."<br>";
    session_start();
}

// Set variables for form and move to next step
if(isset($_POST['single-class'])){
    $_SESSION['curriculum']['returning'] = $_POST['return'];
    $_SESSION['curriculum']['classrooms'] = $_POST['classrooms']=="single" ? 1 : $_POST['num-classrooms'];
    $_SESSION['curriculum']['students'] = $_POST['students'];
    $location = SITE_URL."/curr-purchase-2.php";
    // $_SERVER['curriculum']['returning'] = $_POST['radio'];
    //echo $_SERVER['curriculum']['returning'];
	if(isset($_POST['image_option']))
	$_SESSION['curriculum']['image_option']= $_POST['image_option'];
    header("Location: $location", true);
    exit();
} elseif(isset($_POST['multiple-class'])){
    $_SESSION['curriculum']['returning'] = $_POST['return'];
    $_SESSION['curriculum']['multiclassroom'] = 'yes';

    $_SESSION['curriculum']['classrooms'] = $num = $_POST['classrooms']=="single" ? 1 : $_POST['num-classrooms'];
    $_SESSION['curriculum']['students'] = 0;
    for($i=0;$i<$num; $i++ ){
      $_SESSION['curriculum']['students'] += $_POST['class'.$i];  
    }
	if(isset($_POST['image_option']))
	$_SESSION['curriculum']['image_option']= $_POST['image_option'];
    //$_SESSION['curriculum']['students'] = $_POST['students'];
    $location = SITE_URL."/curr-purchase-2.php";
    // $_SERVER['curriculum']['returning'] = $_POST['radio'];
    //echo $_SERVER['curriculum']['returning'];
    header("Location: $location", true);
    exit();
}
//session_destroy();
if(isset($_POST['submit'])){
//print_r($_SESSION); 
    array_pop($_POST);
	/*echo "<pre>";
	print_r($_POST); exit;*/
    // Store Product values and move to next step
    foreach($_POST as $key => $row)
    { 
        $product_key_arr =explode('_',$key);
      	if(isset($_POST[$key]) && $_POST[$key]!='' && $_POST[$key]!=0)
      	{
			if (is_numeric($product_key_arr[1]))
			{
				$_SESSION['curriculum']['cart'][$product_key_arr[1]]= array("quantity" => $_POST[$key],"price" => $DB[$product_key_arr[1]]['price']);
			}
      	}
          //echo $_SESSION['curriculum']['products'][$i]."<br>";
    } 
     //echo "<pre>";
    //print_r($_SESSION['curriculum']['cart']);   echo "</pre>"; exit;
      $next_step = SITE_URL."/cart.php";
      header("Location: $next_step", true);
      exit();
}
?>
<?php
get_header_inner(); 
// Intermediate EDUCATOR Store Page

// Description: This page asks the user what payment method they wish to use.

// Options are "Institution (P.O.)", "Personal (CC)", "Offline (Mail, fax, phone). 

// After the user makes their selection, the page should redirect them to the original

// route they were going to. 

?>

	<div class="container">
		<header>
        	<div class="row">
            <div class="col-sm-2">
			<!-- Starfall logo -->
			<div id="logo"><a href="<?php echo SITE_URL; ?>/store.php"><h3>Starfall Store</h3></a></div>
            </div>
            <div class="col-sm-7">
				<h1>Starfall Kindergarten Curriculum</h1>
            </div>
            <div class="col-sm-3"><?php get_dropdown(); ?></div>
            <div class="newClear"></div>
            </div>
		</header>

<section class="container">
		<div class="row">
			<div class="col-sm-12">
        <a href="<?php echo SITE_URL; ?>">Educators</a> // <a href="<?php echo SITE_URL; ?>/curriculum.php">Curriculum</a> // Step1  
      </div>
    </div>
		<div class="space20"></div>
    <div class="col-sm-10 col-sm-push-2">
      <h2>Step 1 of 3</h2>
    </div>
    <div class="space20"></div>
		<div class="col-sm-12">
	   		<div class="row">
            <div class="col-sm-3">
                <img data-src="holder.js/150x150" alt="150x150" class="img-circle img-center img-responsive">
                <div class="space20"></div>
                </div>
	<form name="frmoption" id="frmoption" method="post">
                <div class="col-sm-9">
                    <div class="row">
                    <div class="grey-box">
                      <h3 class="text-center">Have you purchased this Curriculum before? </h3>
                      <p>
                        <label for="radio"><input type="radio" name="return" id="radio_yes" value="yes" class="return-yes"> Yes.Take me straight to the itemized order form.</label>
                      </p>
                       <p>
                        <label for="radio"><input type="radio" name="return" id="radio_no" value="no" class="return-no"> No. Help me calculate how many materials I need.</label>
                      </p>
                    </div>
                    </div>
                    <div class="space20"></div>

				<div class="row">
                    <div class="grey-box print_image">
                      <h3 class="text-center">Do you want to order practice books in Block Print or Manuscript? (ex. Block , Manuscript )</h3>
                      <p>
                        <label for="radio"><input type="radio" name="image_option" id="blockimage" value="6" class="return-image"> Block&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><img src="theme/icon/block.png" alt="block" />
                      </p>
                       <p>
                        <label for="radio"><input type="radio" name="image_option" id="manuscript" value="7" class="return-image"> Manuscript &nbsp;</label><img src="theme/icon/man.png" alt="block" width="84px" height="48px" />
                      </p>
                    </div>
                    </div>
				<div class="space20"></div>

                    <div class="row">
                    <div id="no" class="grey-box conditional-1">
                      <h3 class="text-center">Multiple Classrooms or Just one?</h3>
                      <p>
                        <label for="radio3"><input type="radio" name="classrooms" id="radio3" value="single" class="classroom-single"> Just One</label>
                      </p>
                      <p>
                        <label for="radio4">
                        	<input type="radio" name="classrooms" id="radio4" value="multiple" class="classroom-multiple"> Multiple Classrooms
                        </label>
                        <span class="num-classrooms">
                        <label for="num-classrooms">: 
                        	<input type="text" name="num-classrooms" id="num-classrooms">
                        </label>
                        </span>
                      </p>
                    </div>
                    </div>
                    <div class="space20"></div>
                    <div class="row">
                    <div id="single" class="grey-box conditional-2">
                      <h3 class="text-center">How many students do you have in your class?</h3>
                      <p>
                         <label for="textfield2"><input type="text" name="students" id="textfield2"> Students</label>
                      </p>
                      <p>The recommended number of classroom kits and student kits will be based on the information you provided.</p>
                      <p>
                        <input type="submit" name="single-class" id="button" value="Next Step" class="btn btn-primary">
                      </p>
                    </div>
                    </div>
                    <div class="space20"></div>
                    <div class="row">
                    <div id="multiple" class="grey-box conditional-2">
                      <h3 class="text-center">How many students in each classroom?</h3>
					<div id="multiple-inputs"></div>
						<p>The recommended number of classroom kits and student kits will be based on the information you provided.</p>
						<p><input type="submit" name="multiple-class" id="button" value="Next Step" class="btn btn-primary"></p>
                    </div>
                    </div>
                  </div>

	<div class="col-sm-12" id="yes">
				<div class="row">
                <div class="col-sm-3">
                <img data-src="holder.js/150x150" alt="150x150" class="img-circle img-center img-responsive">
                <div class="space20"></div>

                </div>
                <div class="col-sm-9">		
                 <div class="row">
				 
                    <div class="grey-box2">

					<div class="padsim1">
						<div class="col-sm-8">
							<div class="simplleBoldstyle1">Per Classroom Items<br />
						   <span> A typical classroom will have one or more of each of these per classroom.</span>
							</div>
						</div>
                        <div class="col-sm-4 text-left">Price</div>
                        <div class="newClear"></div>
                    </div>
	<?php 
	foreach($DB as $key => $product)
	{
		if($product['type']=='Per Classroom Items')
		{ 
		$product_id = $key;
	?>
                     <div class="padsim1">
                     	<div class="col-sm-8">
                            <div class="studItemBox">
                                <span><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><img src="<?php echo $product['product_image']; ?>" alt="25x25" class="img-center img-responsive"></a></span>
                                <div><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><strong><?php echo $product['name']; ?></strong></a><br />
                                <?php echo $product['description']; ?>
                                </div> 
                                <div class="newClear"></div>
                            </div>
                        </div>                       
                        <div class="col-sm-4 text-right">
              						<div class="left_price">
              						<span id="p_price_<?php echo $product_id; ?>">$<?php echo $product['price']; ?></span><strong> X </strong><input type="text" name="product_<?php echo $product_id; ?>" id="product_<?php echo $product_id; ?>" value=""></div>
              						<div class="right_price">
              						<span id="p_cost_<?php echo $product_id; ?>"></span>
                          
						            </div>
						          </div>                        
                      <div class="newClear"></div>
                     </div>

				<div id="product_info_<?php echo $product_id; ?>" style="display:none;">
				<p> <img src="<?php echo $product['product_image']; ?>" alt="150x150" class="pull-left img-responsive"></p>
				<p> <?php echo $product['details_description']; ?></p>
				</div>
	<?php } } ?>	
	
					<div class="padsim1">
                    <div class="col-sm-8">
                        <div class="simplleBoldstyle1">Required Student Practice Books<br />
						<span> These require replacement year after year.</span>
						</div>
					</div>
                        <div class="col-sm-4 text-left">Price</div>
                        <div class="newClear"></div>
                    </div>
	<?php 
	foreach($DB as $key => $product)
	{
		if($product['type']=='Practice Books')
		{
		$product_id = $key;
	?>
                     <div class="padsim1">
                     	<div class="col-sm-8">
                            <div class="studItemBox">
                                <span><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><img src="<?php echo $product['product_image']; ?>" alt="25x25" class="img-center img-responsive"></a></span>
                                <div><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><strong><?php echo $product['name']; ?></strong></a><br />
                                <?php echo $product['description']; ?>
                                </div> 
                                <div class="newClear"></div>
                            </div>
                        </div>                       
                        <div class="col-sm-4 text-right">
						<div class="left_price">
						  <span id="p_price_<?php echo $product_id; ?>">$<?php echo $product['price'];?></span> <strong> X </strong><input type="text" name="product_<?php echo $product_id; ?>" id="product_<?php echo $product_id; ?>" value=""> </div> 
              <div class="right_price"><span id="p_cost_<?php echo $product_id; ?>"></span></div>
              <div class="text-left" style="clear:both;">
                  <?php if(count($product['price_option'])>0){
                    echo "Buy ".$product['price_option']['quantity']." or more for $".$product['price_option']['set_price']." each";
                  }  ?>
                </div>
						</div>                        
                        <div class="newClear"></div>
                     </div>

				<div id="product_info_<?php echo $product_id; ?>" style="display:none;">
				<p> <img src="<?php echo $product['product_image']; ?>" alt="150x150" class="pull-left img-responsive"></p>
				<p> <?php echo $product['details_description']; ?></p>
				</div>
				
	<?php } } ?>
	
                     <div class="padsim1">
                    	<div class="col-sm-8">
                        <div class="simplleBoldstyle1">Per Student Items<br />
                       <span> A typical classroom will have one of these per student. Tip:you may want
to order a few extras for replacements and new student transfers.
						</span></div></div>
                        <div class="col-sm-4 text-left">Price</div>
                        <div class="newClear"></div>
                    </div>
	<?php 
	foreach($DB as $key => $product)
	{
		if($product['type']=='Per Student Items')
		{
		$product_id = $key;
	?>
                     <div class="padsim1">
                     	<div class="col-sm-8">
                            <div class="studItemBox">
                                <span><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><img src="<?php echo $product['product_image']; ?>" alt="25x25" class="img-center img-responsive"></a></span>
                                <div><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><strong><?php echo $product['name']; ?></strong></a><br />
                                <?php echo $product['description']; ?>
                                </div> 
                                <div class="newClear"></div>
                            </div>
                        </div>                       
                        <div class="col-sm-4 text-right">
						<div class="left_price">
						  <span id="p_price_<?php echo $product_id; ?>">$<?php echo $product['price'];?></span> <strong> X </strong><input type="text" name="product_<?php echo $product_id; ?>" id="product_<?php echo $product_id; ?>" value=""> </div> 
              <div class="right_price"><span id="p_cost_<?php echo $product_id; ?>"></span></div>
              <div class="text-left" style="clear:both;">
                  <?php if(count($product['price_option'])>0){
                    echo "Buy ".$product['price_option']['quantity']." or more for $".$product['price_option']['set_price']." each";
                  }  ?>
                </div>
						</div>                        
                        <div class="newClear"></div>
                     </div> 

				<div id="product_info_<?php echo $product_id; ?>" style="display:none;">
				<p> <img src="<?php echo $product['product_image']; ?>" alt="150x150" class="pull-left img-responsive"></p>
				<p> <?php echo $product['details_description']; ?></p>
				</div>
	<?php } } ?>
                   
                     <div class="padsim1">
                    	<div class="col-sm-8">
                        <div class="simplleBoldstyle1">Optional Items<br />
                       <span> A typical classroom will have one of these per student. Tip:you may want
to order a few extras for replacements and new student transfers.
						</span></div></div>
                        <div class="col-sm-4 text-left">Price</div>
                        <div class="newClear"></div>
                    </div>	
 	<?php 
	foreach($DB as $key => $product)
	{
		if($product['type']=='Optional Items')
		{
		$product_id = $key;
	?>
                     <div class="padsim1">
                     	<div class="col-sm-8">
                            <div class="studItemBox">
                                <span><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><img src="<?php echo $product['product_image']; ?>" alt="25x25" class="img-center img-responsive"></a></span>
                                <div><a href="#product_info_<?php echo $product_id; ?>" rel="facebox"><strong><?php echo $product['name']; ?></strong></a><br />
                                <?php echo $product['description']; ?>
                                </div> 
                                <div class="newClear"></div>
                            </div>
                        </div>                       
                        <div class="col-sm-4 text-right">
						<div class="left_price">
						<span id="p_price_<?php echo $product_id; ?>">$<?php echo $product['price']; ?></span><strong> X </strong><input type="text" name="product_<?php echo $product_id; ?>" id="product_<?php echo $product_id; ?>" value=""></div>
						<div class="right_price">
						<span id="p_cost_<?php echo $product_id; ?>"></span>
						</div>
						</div>                        
                        <div class="newClear"></div>
                     </div>
					 
				<div id="product_info_<?php echo $product_id; ?>" style="display:none;">
				<p> <img src="<?php echo $product['product_image']; ?>" alt="150x150" class="pull-left img-responsive"></p>
				<p> <?php echo $product['details_description']; ?></p>
				</div>
					 
<?php } }?>                   

                    </div>
                   </div>
                </div>
                 <div class="clearfix"></div>
                <div class="col-sm-3 fr"> 
        	<div class="totalBox">
            	<div class="totlaBar">
                	<strong>SubTotal: </strong><span id="subtotal">$0.00</span>
                </div>
                <!--<div class="totlaBar">
                	<strong>Shipping: </strong><span>$0.00</span>
                </div>
                <div class="totlaBar">
                	<strong>Tax </strong><span>$0.00</span>
                </div>-->
                <div class="totlaBar2">
                	<strong>Total </strong><span id="total">$0.00</span>
                </div>
            </div>				
           			<div class="padsim3">
					<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add All to Quote"></div>
        		</div>  
				</div>
			</div>
</form>	
		
				</div>
			</div>
</section>
		<div class="clearfix"></div>

<script type="text/javascript">
$(document).ready(function(){ 
$(".print_image").hide();

	$(".return-no").change(function(){
			$("#yes").hide();
			$(".conditional-1").hide();
			$('input[type=text]').val("");
			$( "#multiple-inputs" ).html( "" );
			$(".print_image").show();
			if($('#manuscript').prop('checked') || $('#blockimage').prop('checked'))
			$("#no").show();
			else
			$("#no").hide();
	});	
	$(".return-image").change(function(){

			$("#yes").hide();
			$(".conditional-1").hide();
			$('input[type=text]').val("");
			$( "#multiple-inputs" ).html( "" );
			$("#no").show();
	});	
	$(".return-yes").change(function(){
		$(".conditional-1").hide();
		$(".conditional-2").hide();
		$(".print_image").hide();
		$('input[type=text]').val("");
		$('#radio3').prop('checked', false);
		$('#radio4').prop('checked', false);
		$("#yes").show();
	});
	$(".classroom-single").change(function(){
		$(".conditional-2").hide();
		$( "#multiple-inputs" ).html( "" );
		$('#num-classrooms').val("");
		$("#single").show();
		$(".num-classrooms").hide();
	});		
	$(".classroom-multiple").change(function(){
		$(".conditional-2").hide();
		$(".num-classrooms").show();
		$('#textfield2').val("");
	});	
	$("#num-classrooms").keypress(function(event) { validate(event); });
	$("#multiple-inputs input[type=text]").keypress(function(event) { validate(event); });
	$("#textfield2").keypress(function(event) { validate(event); });
	$("#num-classrooms").change(function() {
		$( "#multiple-inputs" ).html( "" );
		var cnt = $( this ).val();
		if (cnt > 20) { cnt = 20; }
		cnt++;
		$("#multiple").show();
		for(var i=1; i<cnt; i++){ 
			var htmlString = $( "#multiple-inputs" ).html();
			var newHTML = '<p><input type="text" name="class' + i + '" id="class' + i + '" class="multclass" /><label for="newtextfield' + i + '"> &nbsp; &nbsp; Classroom ' + i + ' Students</label></p>';
			var newhtml = htmlString + newHTML;
			$( "#multiple-inputs" ).html( newhtml );
		}
	}).keyup();	
	
 var total = 0;	
$('.grey-box2 input[type=text]').each(function(index, element) {
//alert();
	$(this).keyup(function() {
	//alert($(this).attr("id"));
	var id = $(this).attr("id");
	var id_arr = id.split('_');
	var product_id = id_arr[1];
	var product_qty = $(this).val();
	
$.ajax({
url: "<?php echo SITE_URL; ?>/product_set_price.php",
data: {product_id: product_id , quantity: product_qty},
success: function( data ) {
$('#p_price_'+product_id).html('$'+data);
	
	//var price = $('#p_price_'+product_id).html();
	//var split_price_arr = price.split('$');
	//var per_price = parseFloat(split_price_arr[1]);
	var per_price = parseFloat(data);
	//per_price = per_price.toFixed(2);
	if(product_qty=='')
	var product_cost = 0;
	else
	var product_cost = (per_price) * (parseInt(product_qty));
	product_cost = product_cost.toFixed(2);
	//alert(product_cost);
	var p_cost_str = '$'+product_cost;
	$('#p_cost_'+product_id).html(' <strong>=</strong> '+p_cost_str);
	}
});
	/*total = parseFloat(total) + parseFloat(product_cost);
	total = total.toFixed(2);
	//alert(total);
	$('#subtotal').html(total);
	$('#total').html(total);*/
	var total = 0;
	$('.grey-box2 input[type=text]').each(function(index, element) {
		var id = $(this).attr("id");
		var id_arr = id.split('_');
		var product_id = id_arr[1];
		var product_qty = $(this).val();
		var price = $('#p_price_'+product_id).html();
		var split_price_arr = price.split('$');
		var per_price = parseFloat(split_price_arr[1]);
		//per_price = per_price.toFixed(2);
		if(product_qty=='')
		var product_cost = 0;
		else
		var product_cost = (per_price) * (parseInt(product_qty));
		product_cost = product_cost.toFixed(2);
		total = parseFloat(total) + parseFloat(product_cost);
		total = total.toFixed(2);
		//alert(total);
		$('#subtotal').html(total);
		$('#total').html(total);
		});
	});

});
	
	
});
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?php echo THEME_URL; ?>/icon/loading.gif',
        closeImage   : '<?php echo THEME_URL; ?>/icon/closelabel.png'
      })
    })
  </script>
<?php get_footer(); ?>