<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";


    /** 
	  check if the category 
	  id set
	**/
	if (isset($_GET['id'])) {
		/** 
		Get data from GET request 
		and store it in var
		**/
		$id = $_GET['id'];

		#simple form Validation
		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: ../admin.php?error=$em");
            exit;
		}else {
            # DELETE the category from Database
			$sql  = "DELETE FROM categories
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$id]);

			/**
		      If there is no error while 
		      Deleting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully removed!";
				header("Location: ../admin.php?success=$sm");
	            exit;
			 }else {
			 	$em = "Error Occurred!";
			    header("Location: ../admin.php?error=$em");
                exit;
			 }
             
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}