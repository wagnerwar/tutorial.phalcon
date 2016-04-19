<?php

error_reporting(E_ALL);

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Di\FactoryDefault;

try {
  define('APP_PATH', realpath('..') . '/');

  $di = new FactoryDefault();
  /**
  * Read the configuration
  */
  $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
  if (is_readable(APP_PATH . 'app/config/config.ini.dev')) {
    $override = new ConfigIni(APP_PATH . 'app/config/config.ini.dev');
    $config->merge($override);
  }
  /*Carregando diretórios localizáveis.
  Desta forma, quando a aplicação procurar por algum controller ou alguma classe, irá buscar dentro destes diretórios
  */
  $loader = new Loader();

  $loader->registerDirs(
  APP_PATH . $config->application->controllersDir,
  APP_PATH . $config->application->modelsDir,
  APP_PATH . $config->application->viewsDir
);

  /*Setando URL base*/
  $di->set('url', function () use ($config) {
    $url = new UrlProvider();
    $url->setBaseUri($config->application->baseUri);
    return $url;
  });

/*Configurando VIEWS */
  $di->set('view', function () use ($config) {

        $view = new View();

        $view->setViewsDir(APP_PATH . $config->application->viewsDir);

        $view->registerEngines(array(
                ".volt" => 'volt'
        ));

        return $view;
});

/**
 * Setting up volt
 */
$di->set('volt', function ($view, $di) {

        $volt = new VoltEngine($view, $di);

        $volt->setOptions(array(
                "compiledPath" => APP_PATH . "cache/volt/"
        ));

        $compiler = $volt->getCompiler();
        $compiler->addFunction('is_a', 'is_a');

        return $volt;
}, true);



  $application = new Application($di);

  echo $application->handle()->getContent();
} catch (Exception $e){
  echo $e->getMessage() . '<br>';
  echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
