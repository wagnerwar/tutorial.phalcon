<?php

error_reporting(E_ALL);

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;


try {
  define('APP_PATH', realpath('..') . '/');

/*Objeto responsável por carregar as classes e serviços do framework*/
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
  $loader = new \Phalcon\Loader();

  $loader->registerDirs(array(
  APP_PATH . $config->application->controllersDir,
  APP_PATH . $config->application->modelsDir,
  APP_PATH . $config->application->viewsDir,
  APP_PATH . $config->application->formsDir
  )
)->register();


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
 * Configurando VOLT como template engine
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

/*Configurando base de dados*/
$di->set('db', function () use ($config) {
        $config = $config->get('database')->toArray();

        $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
        unset($config['adapter']);

        return new $dbClass($config);
});

// Start the session the first time a component requests the session service
$di->set('session', function () {
    $session = new SessionAdapter();

    $session->start();

    return $session;
});

/**
 * Carregar CSS Classes para determinadas  flashMessages
 */
$di->set('flash', function () {
        return new FlashSession(array(
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning'
        ));
});

  $application = new Application($di);

  echo $application->handle()->getContent();
} catch (Exception $e){
  echo $e->getMessage() . '<br>';
  echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
