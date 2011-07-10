<ul class="clearfix">
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
<?php echo $form->create("",
	array('url' =>
		array(
			"controller" => "texts",
			"action"     => "params",
	))); ?>
<ul class="clearfix">
<li>START:<?php 
	$ranges = array();
	for($i = 1 ; $i <= $max ; $i++ ){
		$ranges[$i] = $i;
	}
	echo $form -> select("start",$ranges,$text["start"],array('empty' => false));
?></li>
<li>END:<?php 
	echo $form -> select("end",$ranges,$text["end"],array('empty' => false));
?></li>
<li>NUM QUESTIONS:<?php 
	echo $form -> select("questions",array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8),$this -> params["questions"],array('empty' => false));
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
<ul class="clearfix">
<?php 
	foreach($text["question"]["splitted"] as $index => $word){
?>
<li class="word">
<?php 
		if(in_array($index,$text["question"]["indexes"])){
			echo $form -> input("question$index",array('label' => false));
		}else{
			echo h($word);
		}
?>
</li>
<?php 
	}
?>
</ul>
<?php echo $form->submit("Check") ?>
<?php echo $form->end() ?>
