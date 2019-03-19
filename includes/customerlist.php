<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
	// we get information about the costumers
	include './process/db.class.php';
	include './process/functions.php';
	$database1 = new JDB();
	$result = $database1->runQuery("SELECT * FROM customers");
	if (!$result) {
		header("Location: admin.php/msg=error");
	}else{
		if ($result->num_rows == 0) {
			header("Location: ./admin.php/msg=no_customers");
		}else{
			$result= $database1->formatAsAssoc($result);
			// we loop and show costumers names

			?>
			<!-- start of the list -->
			<div class="ui middle aligned divided list" dir="rtl">
			<?php
			foreach ($result as $row=> $value) {
				?>
				<!-- single list item -->
				<div class="item">
					<div class="left floated content">
					   <a href="./details.php?id=<?php echo $value['serial'] ?>" class="ui button">تفاصيل</a>
					</div>
					<img class="ui avatar image" src="assets/default_avatar.png">
					<div class="content">
				       <a  class="header <?php 
				   ?>"><?php echo $value['name'];?>
				  </a>	
				  <div class="description"> اخر قسط كان قبل :<a><b><?php $difference = calculate_date_difference($value["last_payment_date"]); echo $difference ;?></b></a> <?php echo day_days($difference); ?> </div>
				</div>
				  </div>	
				<?php
			}
			?>
			<!-- end of the list -->
			</div>
			<a href="newcustomer.php" class="ui olive button" role="button" aria-disabled="true">زبون جديد </a>
			
			<?php
		}
	}

}else{
	header("Location: admin.php");
}