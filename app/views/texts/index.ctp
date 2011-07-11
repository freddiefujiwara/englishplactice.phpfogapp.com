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
<li>(<?php echo intval($text["step"]) ?>/<?php echo intval($text["end"]-$text["start"]+1) ?>)</li>
</ul>
<?php echo $form -> end() ?>
<h1><?php echo h($text["data"]["Text"]["japanese"]) ?></h1>
<div id="player" ></div>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="http://plugins.learningjquery.com/expander/jquery.expander.js" type="text/javascript"></script>
<?php echo $javascript -> link("jquery.jplayer.min") ?>
<?php $terms = preg_split("/[\.!]/",trim($text["data"]["Text"]["english"]),-1,PREG_SPLIT_NO_EMPTY) ?>
<script type="text/javascript"> 
	$(document).ready(function() {
		$("#player").jPlayer({
			swfPath:"/js",
			ready:function(){
				<?php $mp3s = array();
				foreach($terms as $term){
					 $mp3s[] = json_encode($term).":http://englishplactice.appspot.com/apis/tts.mp3?q=".urlencode($term).";"
				} ?>
				$(this).jPlayer("setMedia",{
					<?php echo implode(",",$mp3s) ?>
				});
			}
		});
		$('div.hint').expander({
			slicePoint: 0, 
			widow: 2,
			expandEffect: 'show', 
			userCollapseText: 'close',
			expandText: 'HINT!'
		});
	});
</script>
<div class="hint"><?php echo h($text["data"]["Text"]["english"]) ?></div>
