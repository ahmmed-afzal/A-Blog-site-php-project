<?php
include"../lib/Session.php";
Session::checkSession();
?>
<?php include"../config/config.php"; ?>
<?php include"../lib/Database.php" ;?>
<?php include"../helpers/Format.php"?>

<?php
$db = new Database();
$fm = new Format();
?>
<?php
if(!isset($_GET['deletepostId']) || isset($_GET['deletepostId'])==null){
	echo "<script>
	window.location='postlist.php';
	</script";
}else{
	$postId = $_GET['deletepostId'];
	$query = "SELECT * FROM tbl_post WHERE id = '$postId' ";
	$getdata = $db->select($query);
	if($getdata){
		while($delimg=$getdata->fetch_assoc()){
			$dellink = $delimg['image'];
			unlink($dellink);
		}
	}
	$delquery = "DELETE FROM tbl_post WHERE id = '$postId'";
	$deldata  = $db->delete($delquery);
	if($deldata){
		echo "<script>alert('Data deleted succesfully');</script";
		echo "<script>window.location='postlist.php';</script";
	}else{
		echo "<script>alert('Something went wrong!');</script";
		echo "<script>window.location='postlist.php';</script";
	}
}
?>
