<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
	// we get information about the costumers
	include './process/db.class.php';
	include './process/functions.php';
	$database = new JDB();
	$result = $database->runQuery("SELECT * FROM requests");
	if (!$result) {
		header("Location: admin.php/msg=error");
	}else{
		if ($result->num_rows == 0) {
			header("Location: ./admin.php");
		}else{
			$result= $database->formatAsAssoc($result);

			?>
			<?php
			foreach ($result as $row=> $value) {
                			?>
            <center>

     

			<div class="ui  segment">
               <h2 class="ui header">
               <?php echo $value['name']; ?>
                <?php echo '<br/>'; ?>
                <?php echo $value['phone']; ?>
                 <div class="sub header"><?php echo $value['information']; ?></div>
                </h2>
            </div>

                   </center>
			
			<?php

			}

		}
	}

}else{
	header("Location: admin.php");
}