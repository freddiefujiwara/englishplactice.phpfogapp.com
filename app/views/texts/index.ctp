<h1><?php h($text["Text"]["data"]["japanese"]) ?></h1>
<ul>
<?php 
	foreach($text["question"]["splitted"] as $index => $word){
		echo $html -> tag("li",$word); 
	}
?>
</ul>
