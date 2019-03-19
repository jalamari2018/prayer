<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
	// we get information about the costumers
	include './process/db.class.php';
	include './process/functions.php';
	$database = new JDB();
	$result = $database->runQuery("SELECT * FROM customers");
	if (!$result) {
		header("Location: admin.php/msg=error");
	}else{
		if ($result->num_rows == 0) {
			header("Location: ./admin.php/msg=no_customers");
		}else{
			$result= $database->formatAsAssoc($result);
            #initialize statistcs variables
            $totalPriceWithProfit = 0;# price 
            $totaldebt = 0;
            $totalPaid = 0;
            $totalOriginalPrice = 0;
            $totalProfit = 0;


			?>
			<?php
			foreach ($result as $row=> $value) {
                $totaldebt = $totaldebt + $value['debt'];
                $totalPaid = $totalPaid + $value['paid'];
                $totalOriginalPrice = $totalOriginalPrice + $value['base_price'];
                $totalPriceWithProfit = $totalPriceWithProfit + $value['total_price'];

			}
			?>
            <center>

     

			<div class="ui  segment">
               <h2 class="ui header">
                                  اجمالي الدين
                 <div class="sub header"><?php echo $totaldebt; ?></div>
                </h2>
            </div>
            <div class="ui inverted  segment">
                <h2 class="ui inverted header">
                        اجمالي  المدفوعة
                 <div class="sub header"><?php echo $totalPaid; ?></div>
                </h2>
            </div>
            <div class="ui   segment">
                <h2 class="ui header">
                 السعر الاصلي
                 <div class="sub header"><?php echo $totalOriginalPrice; ?></div>
                </h2>
            </div>

         <div class="ui inverted  segment">
                <h2 class="ui inverted header">
             الاجمالي
                 <div class="sub header"><?php echo $totalPriceWithProfit; ?></div>
                </h2>
            </div>
        <div class="ui  segment">
               <h2 class="ui header">
                                   صافي الربح
                 <div class="sub header"><?php echo $totalPriceWithProfit - $totalOriginalPrice; ?></div>
                </h2>
            </div>
                   </center>
			
			<?php
		}
	}

}else{
	header("Location: admin.php");
}