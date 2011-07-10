<ul>
<li><?php echo $html -> link("<<Prev",array(
			"controller" => "texts",
			"action"     => "index",
			"start"      => $text["start"],
			"end"        => $text["end"],
			"questions"  => $text["questions"],
			"step"       => $text["step"]-1
	)); ?></li>
<li><?php echo $html -> link("Next>>",array(
			"controller" => "texts",
			"action"     => "index",
			"start"      => $text["start"],
			"end"        => $text["end"],
			"questions"  => $text["questions"],
			"step"       => $text["step"]+1
	)); ?></li>
</ul>
<?php echo $form->create(null,
	array('url' =>
		array(
			"controller" => "texts",
			"action"     => "params",
	))); ?>
<ul>
<li><?php 
	$ranges = array();
	for($i = 1 ; $i <= $max ; $i++ ){
		$ranges[] = array($i => $i);
	}
	echo $form -> select("start",$ranges,$this -> params["start"],array('empty' => false));
?></li>
<li><?php echo $form->submit("Go") ?></li>
</ul>
<?php echo $form -> end() ?>
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
<?php echo $form->hidden("indexes",array("value" => implode(",",$text["question"]["indexes"]))) ?>
<ul>
<?php 
	foreach($text["question"]["splitted"] as $index => $word){
		if(in_array($index,$text["question"]["indexes"])){
			echo "<li>".$form -> input("question$index",array('label' => false))."</li>";
		}else{
			echo $html -> tag("li",$word); 
		}
	}
?>
</ul>
<?php echo $form->submit("Check") ?>
<?php echo $form->end() ?>
