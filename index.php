<?php 

include_once ('core/config.php');

$controler =  isset($_GET['modulo'])?$_GET['modulo']:'pedido';
$action =  isset($_GET['acao'])?$_GET['acao']:'formulario';


include_once(CORE.'model.php');
include_once(CORE.'controller.php');


include_once(MODELS.ucfirst($controler).'.php');
include_once(CONTROLLERS.$controler.'Controller.php');

$controler = $controler.'Controller';
$class = new $controler;
$class->$action();


?>