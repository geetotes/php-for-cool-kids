<?php
require 'vendor/autoload.php';


$app = new \Slim\Slim();



$app->get('/', function(){
  //ok, def need to this out... ideally haml will be a renderer for slim
  $haml = new MtHaml\Environment('php');
  $template = __DIR__."/views/index.haml";
  $compiled = $haml->compileString(file_get_contents($template), $template);
  echo $compiled;

});

$app->get('/foo.js', function(){
  $file = __DIR__."/app/js/foo.coffee";
  try
  {
    $coffee = file_get_contents($file);
    $js = CoffeeScript\Compiler::compile($coffee, array('filename' => $file));
    echo $js;
  }
  catch (Exception $e)
  {
    echo $e->getMessage();
  }

});

$app->get('/foo.css', function(){
  $scss = new scssc();
  $file = file_get_contents(__DIR__."/app/css/foo.scss");
  echo $scss->compile($file);
});



$app->run();
