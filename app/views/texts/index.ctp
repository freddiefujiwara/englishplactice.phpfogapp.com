<h1><?php echo h($text["data"]["Text"]["japanese"]) ?></h1>
<?php echo $form->create('TextCheckAction',
	array('url' =>
		array(
			"controller" => "texts",
			"action"     => "index",
			"start"      => $text["start"],
			"end"        => $text["end"],
			"questions"  => $text["questions"],
			"step"       => $text["step"]
	))); ?>
<ul>
<?php 
	foreach($text["question"]["splitted"] as $index => $word){
		if(in_array($index,$text["question"]["indexes"])){
			echo $form -> input("question$index",array('label' => false));
		}else{
			echo $html -> tag("li",$word); 
		}
	}
?>
</ul>
<?php echo $form->submit("Check") ?>
<?php echo $form->end() ?>
