<?php
	require('class.template.php');
	$tpl = new Template_Lite;
	$tpl->compile_dir = "cache/";
	$tpl->template_dir = "templates/";

//	$tpl->assign("foo","bar");	//	Basic Varibles

//	$foo = array("apples", "oranges", "bananas");	// Array
//	$tpl->assign("foo", $foo);

//	$foo = array("fruit" => "apples", "vegetable" => "carrot", "dairy" => "milk");	//	Associative Arrays
//	$tpl->assign("foo", $foo);
//	$foo = array("apples", "carrot", "milk");
//	$tpl->assign("foo", $foo);

//	$tpl->assign("foo","bar");
//	$tpl->assign("name","Paul");

//With the this change your templates would use the $smarty variable. 
//	$template_object->reserved_template_varname = "smarty"; 

//	setcookie("three", "cookiethree");
/**
	$player_id = array(1,2,3);
	$tpl->assign('player_id',$player_id);

	$player_name = array('Panama Jack','Tarnus Harten','Goober');
	$tpl->assign('player_name',$player_name);

*/

	$tpl->assign("title","This is Fox Title");
	$tpl->assign("topic","Again, much like Smarty, Template Lite supports variable modifiers. At present, Template Lite comes with a few modifiers, namely those listed below. Additionally, modifiers are extremely easy to create. Here are some examples of using them in various situations and how to create one.");

	$tpl->assign("var", array("value1", "value2", "value3"));
	$tpl->assign("variable","");
	$tpl->assign("value","here i am");
	$tpl->assign("articleTitle","here i am");

	$tpl->assign("contacts", array(
		array("phone" => "1", "fax" => "2", "cell" => "3"),
		array("phone" => "555-4444", "fax" => "555-3333", "cell" => "760-1234")
	));


	function insert_stuffandjunk($params, &$tpl) {
		return $tpl->fetch('','sidebar|template');
	}

	function insert_othercrap($params, &$tpl) {
		return "random text: " . $params["var"];
	}

	$tpl->display("index.htm");
?>