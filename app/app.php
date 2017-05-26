<?php
  //load modules
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Brand.php";
  require_once __DIR__."/../src/Store.php";
  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  $app = new Silex\Application();

  //Instantiate new PDO connection
  $server = 'mysql:host=localhost:8889;dbname=shoes';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server,$username,$password);

  //Instantiate twig template
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));


  //get routes
  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
  });

  //brands
  $app->get("/brands", function() use ($app) {
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  $app->post("/brands/create", function() use ($app) {
    $new_brand = new Brand($_POST['name']);
    $new_brand->save();
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  $app->post("/brands/delete", function() use ($app) {
    Brand::deleteAll();
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  $app->get("/brand/{id}", function($id) use ($app) {
    $this_brand = Brand::find($id);
    return $app['twig']->render('brand.html.twig', array('brand' => $this_brand, 'stores'=>$this_brand->getStores()));
  });

  $app->post("/brand/{id}/addStore", function($id) use ($app) {
    $this_brand = Brand::find($id);
    $this_store = Store::find($_POST['store_id']);
    $this_brand->addStore($this_store);
    return $app['twig']->render('brand.html.twig', array('brand' => $this_brand, 'stores'=>$this_brand->getStores()));
  });

  //stores
  $app->get("/stores", function() use ($app) {
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/stores/create", function() use ($app) {
    $new_store = new Store($_POST['name']);
    $new_store->save();
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/stores/delete", function() use ($app) {
    Store::deleteAll();
    return $app['twig']->render('stores.html.twig', array('brands' => Store::getAll()));
  });

  $app->get("/store/{id}", function($id) use ($app) {
    $this_store = Store::find($id);
    return $app['twig']->render('store.html.twig', array('store' => $this_store, 'brands'=>$this_store->getBrands()));
  });

  $app->patch("/store/{id}/edit", function($id) use ($app) {
    $this_store = Store::find($id);
    $new_name = $_POST['name'];
    $this_store->update($new_name);
    return $app['twig']->render('store.html.twig', array('store' => $this_store, 'brands'=>$this_store->getBrands()));
  });

  $app->delete("/store/{id}/delete", function($id) use ($app) {
    $this_store = Store::find($id);
    $this_store->delete();
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/store/{id}/addBrand", function($id) use ($app) {
    $this_store = Store::find($id);
    $this_brand = Brand::find($_POST['brand_id']);
    $this_store->addBrand($this_brand);
    return $app['twig']->render('store.html.twig', array('store' => $this_store, 'brands'=>$this_store->getBrands()));
  });

  return $app;
 ?>
