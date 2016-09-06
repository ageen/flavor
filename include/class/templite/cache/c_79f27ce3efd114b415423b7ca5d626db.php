<?php require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.resize_image.php'); $this->register_function("resize_image", "tpl_function_resize_image");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.popup.php'); $this->register_function("popup", "tpl_function_popup");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.html_select_time.php'); $this->register_function("html_select_time", "tpl_function_html_select_time");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.html_select_date.php'); $this->register_function("html_select_date", "tpl_function_html_select_date");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.html_radios.php'); $this->register_function("html_radios", "tpl_function_html_radios");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\block.textformat.php'); $this->register_block("textformat", "tpl_block_textformat");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\block.strip.php'); $this->register_block("strip", "tpl_block_strip");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.strip.php'); $this->register_modifier("strip", "tpl_modifier_strip");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.string_format.php'); $this->register_modifier("string_format", "tpl_modifier_string_format");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.spacify.php'); $this->register_modifier("spacify", "tpl_modifier_spacify");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.replace.php'); $this->register_modifier("replace", "tpl_modifier_replace");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.regex_replace.php'); $this->register_modifier("regex_replace", "tpl_modifier_regex_replace");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.indent.php'); $this->register_modifier("indent", "tpl_modifier_indent");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.escape.php'); $this->register_modifier("escape", "tpl_modifier_escape");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.default.php'); $this->register_modifier("default", "tpl_modifier_default");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.date.php'); $this->register_modifier("date", "tpl_modifier_date");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.count_words.php'); $this->register_modifier("count_words", "tpl_modifier_count_words");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.count_sentences.php'); $this->register_modifier("count_sentences", "tpl_modifier_count_sentences");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.count_paragraphs.php'); $this->register_modifier("count_paragraphs", "tpl_modifier_count_paragraphs");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.count_characters.php'); $this->register_modifier("count_characters", "tpl_modifier_count_characters");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.cat.php'); $this->register_modifier("cat", "tpl_modifier_cat");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.capitalize.php'); $this->register_modifier("capitalize", "tpl_modifier_capitalize");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.bbcode2html.php'); $this->register_modifier("bbcode2html", "tpl_modifier_bbcode2html");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\modifier.upper.php'); $this->register_modifier("upper", "tpl_modifier_upper");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\block.capture.php'); $this->register_block("capture", "tpl_block_capture");  require_once('D:\AppServ\www\sys\include\class\templite\plugins\function.popup_init.php'); $this->register_function("popup_init", "tpl_function_popup_init");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2013-03-19 01:55:12 中国标准时间 */ ?>

<html>
<head>
<title>Document Title</title>
	
	<?php echo tpl_function_popup_init(array('src' => "./templates/javascripts/overlib/overlib.js"), $this);?>
</head>
<body>

<!--
	
	<?php echo $this->_vars['foo']; ?>

	<?php echo $this->_vars['foo'][0]; ?>

	<?php echo $this->_vars['foo']['2']; ?>

	<?php $this->assign('key', 1); ?>
	<?php echo $this->_vars['foo'][$this->_vars['key']]; ?>

	<?php echo $this->_vars['foo'][$this->_TPL['key']]; ?>

-->
<!--
	//	Associative Arrays
	<?php echo $this->_vars['foo']['fruit']; ?>

	<?php echo $this->_vars['foo']['dairy']; ?>

	<?php echo $this->_vars['foo']['vegetable']; ?>

-->

<!--
<ul>
	<?php if (isset($this->_sections['item'])) unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($this->_vars['foo']) ? count($this->_vars['foo']) : max(0, (int)$this->_vars['foo']);
$this->_sections['item']['show'] = true;
$this->_sections['item']['max'] = $this->_sections['item']['loop'];
$this->_sections['item']['step'] = 1;
$this->_sections['item']['start'] = $this->_sections['item']['step'] > 0 ? 0 : $this->_sections['item']['loop']-1;
if ($this->_sections['item']['show']) {
	$this->_sections['item']['total'] = $this->_sections['item']['loop'];
	if ($this->_sections['item']['total'] == 0)
		$this->_sections['item']['show'] = false;
} else
	$this->_sections['item']['total'] = 0;
if ($this->_sections['item']['show']):

		for ($this->_sections['item']['index'] = $this->_sections['item']['start'], $this->_sections['item']['iteration'] = 1;
			 $this->_sections['item']['iteration'] <= $this->_sections['item']['total'];
			 $this->_sections['item']['index'] += $this->_sections['item']['step'], $this->_sections['item']['iteration']++):
$this->_sections['item']['rownum'] = $this->_sections['item']['iteration'];
$this->_sections['item']['index_prev'] = $this->_sections['item']['index'] - $this->_sections['item']['step'];
$this->_sections['item']['index_next'] = $this->_sections['item']['index'] + $this->_sections['item']['step'];
$this->_sections['item']['first']	  = ($this->_sections['item']['iteration'] == 1);
$this->_sections['item']['last']	   = ($this->_sections['item']['iteration'] == $this->_sections['item']['total']);
?>
	<li><?php echo "test " . $this->_vars['foo'][$this->_sections['item']['index']] . " test"; ?>
</li>
	<?php endfor; endif; ?>
</ul>
-->
<!--
<?php $this->config_load("config.ini", null, null); ?>
<?php echo $this->_confs['test']; ?>

-->
<!--
	<?php echo $this->_vars['foo'].$this->_vars['name']; ?>

 <br />
	<?php echo $this->_vars['foo']." ".$this->_vars['name']; ?>

 <br />
	<?php echo $this->_vars['foo'].$this->_vars['name']; ?>

 <br />
	<?php echo $this->_vars['foo']." ".$this->_vars['name']; ?>

-->
<!--
	
	<?php echo $_GET[$this->_sections['PAGE']['index']]; ?>

	<?php echo $_GET['PAGE']; ?>

-->

<!--


	<?php $this->_tag_stack[] = array("tpl_block_capture", array('assign' => varel,'name' => testcapture)); tpl_block_capture(array('assign' => varel,'name' => testcapture), null, $this); ob_start(); ?>
	  Now is the time to test things out.
	<?php $this->_block_content = ob_get_contents(); ob_end_clean(); $this->_block_content = tpl_block_capture($this->_tag_stack[count($this->_tag_stack) - 1][1], $this->_block_content, $this); echo $this->_block_content; array_pop($this->_tag_stack); ?>
	<?php echo $this->_run_modifier($this->_vars['varel'], 'upper', 'plugin', 1); ?>



	<?php echo $this->_templatelite_vars['CAPTURE'][$this->_sections['testcapture']['index']]; ?>

	<?php echo $this->_templatelite_vars['CAPTURE']['testcapture']; ?>

-->
<!--
<?php $this->config_load("config.ini", null, null); ?>
	<?php echo $this->_confs['test']; ?>

-->
<!--
	
	<?php echo constant('PI'); ?>

	<?php echo constant('PI'); ?>

-->

<!--
	<?php echo $_COOKIE['three']; ?>


	<?php echo $_ENV['PATH']; ?>


	<?php echo $_GET['page']; ?>

   
	<?php echo time(); ?>

	<?php echo $this->left_delimiter; ?>

	<?php echo $this->right_delimiter; ?>

-->

<!--
	<?php if (isset($this->_sections['player_number'])) unset($this->_sections['player_number']);
$this->_sections['player_number']['name'] = 'player_number';
$this->_sections['player_number']['loop'] = is_array($this->_vars['player_id']) ? count($this->_vars['player_id']) : max(0, (int)$this->_vars['player_id']);
$this->_sections['player_number']['show'] = true;
$this->_sections['player_number']['max'] = $this->_sections['player_number']['loop'];
$this->_sections['player_number']['step'] = 1;
$this->_sections['player_number']['start'] = $this->_sections['player_number']['step'] > 0 ? 0 : $this->_sections['player_number']['loop']-1;
if ($this->_sections['player_number']['show']) {
	$this->_sections['player_number']['total'] = $this->_sections['player_number']['loop'];
	if ($this->_sections['player_number']['total'] == 0)
		$this->_sections['player_number']['show'] = false;
} else
	$this->_sections['player_number']['total'] = 0;
if ($this->_sections['player_number']['show']):

		for ($this->_sections['player_number']['index'] = $this->_sections['player_number']['start'], $this->_sections['player_number']['iteration'] = 1;
			 $this->_sections['player_number']['iteration'] <= $this->_sections['player_number']['total'];
			 $this->_sections['player_number']['index'] += $this->_sections['player_number']['step'], $this->_sections['player_number']['iteration']++):
$this->_sections['player_number']['rownum'] = $this->_sections['player_number']['iteration'];
$this->_sections['player_number']['index_prev'] = $this->_sections['player_number']['index'] - $this->_sections['player_number']['step'];
$this->_sections['player_number']['index_next'] = $this->_sections['player_number']['index'] + $this->_sections['player_number']['step'];
$this->_sections['player_number']['first']	  = ($this->_sections['player_number']['iteration'] == 1);
$this->_sections['player_number']['last']	   = ($this->_sections['player_number']['iteration'] == $this->_sections['player_number']['total']);
?>
	<p>
	  Player ID: <?php echo $this->_vars['player_id'][$this->_sections['player_number']['index']]; ?>
<br />
	  Player Name: <?php echo $this->_vars['player_name'][$this->_sections['player_number']['index']]; ?>

	</p>
	<?php endfor; endif; ?>
	<?php echo $_SERVER['SERVER_NAME']; ?>

	<?php echo $_SESSION['id']; ?>

	<?php echo $_SESSION[$this->_sections['id']['index']]; ?>

	<?php echo $this->_file; ?>

	<?php echo $this->_version; ?>

-->

	
	<h2><?php echo $this->_run_modifier($this->_vars['title'], 'upper', 'plugin', 1); ?>
</h2>

	
	Topic: <?php echo $this->_run_modifier($this->_vars['topic'], 'truncate', 'plugin', 1, 40, "..."); ?>


	
	Topic: <?php echo $this->_run_modifier($this->_run_modifier($this->_vars['topic'], 'truncate', 'plugin', 1, 40, "..."), 'upper', 'plugin', 1); ?>

<br />
	<?php echo $this->_run_modifier("This will be [b]bold[/b]. My website is 
	[url=http://www.paullockaby.com/]paullockaby.com[/url].", 'bbcode2html', 'plugin', 1); ?>

<br />
	<?php echo $this->_run_modifier("This is some text.", 'capitalize', 'plugin', 1); ?>

<br />
	<?php echo $this->_run_modifier("This Is Some TEXT", 'cat', 'plugin', 1, " for you."); ?>

<br />
	<?php echo $this->_run_modifier("This Is Some TEXT", 'count_characters', 'plugin', 1); ?>

	<?php echo $this->_run_modifier("This Is Some TEXT", 'count_characters', 'plugin', 1, true); ?>

<br />
	<?php echo $this->_run_modifier("Hi there everyone.\nThis is for you.", 'count_paragraphs', 'plugin', 1); ?>

<br>
	<?php echo $this->_run_modifier("Hi there everyone. This is for you.", 'count_sentences', 'plugin', 1); ?>

<br>
	<?php echo $this->_run_modifier("Hi there everyone", 'count_words', 'plugin', 1); ?>

<br>
	<?php echo $this->_run_modifier($this->_vars['var'], 'count', 'PHP', 0); ?>

<br>
	<?php echo $this->_run_modifier(time(), 'date', 'plugin', 1, "n/j/Y g:ia"); ?>

	<?php echo $this->_run_modifier(time(), 'date', 'plugin', 1, "l, F j, Y"); ?>

<br>
	<?php echo $this->_run_modifier(time(), 'date_format', 'plugin', 1, " %I:%M %p"); ?>

	<?php echo $this->_run_modifier(time(), 'date_format', 'plugin', 1, "%A, %B %e, %Y"); ?>

<br>
	<?php echo $this->_run_modifier($this->_vars['variable'], 'default', 'plugin', 1, "nothing"); ?>

	<?php echo $this->_run_modifier($this->_vars['value'], 'default', 'plugin', 1, "something"); ?>

<br>
	<?php echo $this->_run_modifier("'This Is Some TEXT'", 'escape', 'plugin', 1); ?>

	<?php echo $this->_run_modifier("'This Is Some TEXT'", 'escape', 'plugin', 1, "url"); ?>

<br>
	<?php echo $this->_run_modifier("This Is Some TEXT", 'indent', 'plugin', 1, 10); ?>

<br>
	<?php echo $this->_run_modifier("This Is Some TEXT", 'indent', 'plugin', 1, 1, "\t"); ?>

<br>
	<?php echo $this->_run_modifier("Infertility unlikely to\nbe passed on, experts say.", 'regex_replace', 'plugin', 1, " /[\r\t\n]/", " "); ?>

<br>
	<?php echo $this->_run_modifier("I hate beans.", 'replace', 'plugin', 1, "hate", "like"); ?>

<br>
	<?php echo $this->_run_modifier($this->_vars['articleTitle'], 'spacify', 'plugin', 1); ?>

	<?php echo $this->_run_modifier($this->_vars['articleTitle'], 'spacify', 'plugin', 1, "^^"); ?>

<br>
	<?php echo $this->_run_modifier("Number %d is a %s.", 'string_format', 'plugin', 1, "45", "pitcher"); ?>

<br>
	<?php echo "Grandmother of\neight makes\t    hole in one."; ?>
<br>

	<?php echo $this->_run_modifier("Grandmother of\neight makes\t    hole in one.", 'strip', 'plugin', 1); ?>
<br>

	<?php echo $this->_run_modifier("Grandmother of\neight makes\t    hole in one.", 'strip', 'plugin', 1, " "); ?>
<br>
	<?php echo $this->_run_modifier("Might we make this sentence a little shorter, not a long run-on?", 'truncate', 'plugin', 1); ?>

	<?php echo $this->_run_modifier("Might we make this sentence a little shorter, not a long run-on?", 'truncate', 'plugin', 1, 50, "..."); ?>

	<?php echo $this->_run_modifier("Might we make this sentence a little shorter, not a long run-on?", 'truncate', 'plugin', 1, 50, "...", true); ?>

<br>
<?php echo $this->_run_modifier("my stuff", 'urlencode', 'PHP', 1); ?>

<br>
	<?php $this->assign('test', $this->_run_modifier("this is a test variable", 'upper', 'plugin', 1)); ?>
	The value of $test is <?php echo $this->_vars['test']; ?>
.
<br>
	<?php $this->config_load("config.ini", null, null); ?>
	<?php echo $this->_confs['test']; ?>

<br>
	<?php if (count((array)$this->_vars['contacts'])): foreach ((array)$this->_vars['contacts'] as $this->_vars['contact']): ?>
		<?php if (count((array)$this->_vars['contact'])): foreach ((array)$this->_vars['contact'] as $this->_vars['key'] => $this->_vars['item']): ?>
			<?php echo $this->_vars['key']; ?>
: <?php echo $this->_vars['item']; ?>
<br>
		<?php endforeach; endif; ?>
	<?php endforeach; endif; ?>
<br>
	<?php for($for1 = 0; ((0 < 10) ? ($for1 < 10) : ($for1 > 10)); $for1 += ((0 < 10) ? 2 : -2)):  $this->assign('current', $for1); ?>
	We are on number <?php echo $this->_vars['current']; ?>

	<?php endfor; ?>

	<?php for($for1 = 0; ((0 < 1) ? ($for1 < 1) : ($for1 > 1)); $for1 += ((0 < 1) ? 0.2 : -0.2)):  $this->assign('current', $for1); ?>
	We are on number <?php echo $this->_vars['current']; ?>

	<?php endfor; ?>
<br>
<!--	<?php echo $this->_run_insert(array('name' => "stuffandjunk")); ?>
	<?php echo $this->_run_insert(array('name' => "othercrap", 'var' => "hi")); ?>
--><br>
	<?php echo '
		Here is an example: { config_load file="config.conf" }
	'; ?>

<br>
	<?php 
		echo "Hello to " . "<BR>";
	 ?>
<br>
	<?php $this->_tag_stack[] = array("tpl_block_strip", array()); tpl_block_strip(array(), null, $this); ob_start(); ?>
		<A HREF="<?php echo $this->_vars['url']; ?>
">
			<font color="red">This is a test</font>
		</A>
	<?php $this->_block_content = ob_get_contents(); ob_end_clean(); $this->_block_content = tpl_block_strip($this->_tag_stack[count($this->_tag_stack) - 1][1], $this->_block_content, $this); echo $this->_block_content; array_pop($this->_tag_stack); ?>
<br>
	<?php $this->_tag_stack[] = array("tpl_block_textformat", array('wrap' => 10)); tpl_block_textformat(array('wrap' => 10), null, $this); ob_start(); ?>
		This is a special test of the 20 wrap.
	<?php $this->_block_content = ob_get_contents(); ob_end_clean(); $this->_block_content = tpl_block_textformat($this->_tag_stack[count($this->_tag_stack) - 1][1], $this->_block_content, $this); echo $this->_block_content; array_pop($this->_tag_stack); ?>
<br>
<?php echo tpl_function_html_radios(array('name' => "test"), $this);?>
<br>
	<?php echo tpl_function_html_select_date(array(), $this);?>
<br>
	<?php echo tpl_function_html_select_time(array('use_24_hours' => true), $this);?>
<br>
	
		<a href="mypage.html" <?php echo tpl_function_popup(array('text' => "This link takes you to my page!"), $this);?>>mypage</a>
	
		<a href="mypage.html" <?php echo tpl_function_popup(array('sticky' => true,'caption' => "mypage contents",'text' => "<ul><li>links</li><li>pages</li><li>images</li></ul>",'snapx' => 10,'snapy' => 10), $this);?>>mypage</a>
<br>
	<?php echo tpl_function_resize_image(array('img_src' => "./thumbnails/",'directory' => "./html/mysite/ad_images/",'thumbdir' => "./html/mysite/thumbnails/",'filename' => "Myfile.jpg",'xscale' => "150",'yscale' => "200",'thumbname' => "thumb_"), $this);?>


</body>
</html>
