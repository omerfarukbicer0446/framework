<?php 
// Bu script @omerfarukbicer tarafından Cibza için yapılmıştır ve halka açık bir şekilde sunulmuştur.
use Jenssegers\Blade\Blade;

// class Route
// {
    
// }

class Route
{
  /**
   * Mevcut yolu tutar
   * @var string
   */
  protected $actualPath;

  /**
   * Mevcut istek metodunu tutar
   * @var string
   */
  protected $actualMethod;

  /**
   * Tanımlanmış rotaları tutar
   * @var array
   */
  protected $routes = [];

  /**
   * 404 Sayfasını tutar
   * @var \Closure|string
   */
  protected $notFound;

  /**
   * Rotacıyı başlatır
   * @param string $currentPath Mevcut yol
   * @param string $currentMethod Mevcut istek metodu
   */
  public function __construct($currentPath = '', $currentMethod = '')
  {
    $currentPath = $_SERVER['REQUEST_URI'];
    $currentMethod = $_SERVER['REQUEST_METHOD'];
    
    $this->actualPath = $currentPath;
    $this->actualMethod = $currentMethod;

    // Sayfa bulunamadı rotasını ayarlayalım
    $this->notFound = function(){
      http_response_code(404);
      require 'core/static/404.php';
      exit();
    };
  }

  /**
   * Yeni bir GET rotası yaratır
   * @param string $path İstek yolu
   * @param \Closure|string $callback Geri çağırım işlevi
   * @return void 
   */
  public function get($path, $callback)
  {
    $this->routes[] = ['GET', $path, $callback];
  }

  /**
   * Yeni bir POST rotası yaratır
   * @param string $path İstek yolu
   * @param \Closure|string $callback Geri çağırım işlevi
   * @return void
   */
  public function post($path, $callback)
  {
    $this->routes[] = ['POST', $path, $callback];
  }

  /**
   * Rotalar tanımlandıktan sonra eşleşen rotayı bulup çalıştırır
   * @return mixed
   */
  public function run()
  {
    foreach ($this->routes as $route) {
      list($method, $path, $callback) = $route;

      $checkMethod = $this->actualMethod == $method;
      $checkPath = preg_match("~^{$path}$~ixs", $this->actualPath, $params);

      if ($checkMethod && $checkPath) {
        array_shift($params);
        return call_user_func_array($callback, $params);
      }
    }

    return call_user_func($this->notFound);
  }

  /*
    * @param $parameters array
    * @param $file string
    */
    public static function view($file, $parameters = []){
      if (file_exists('app/views/'.$file.'.blade.php')) {
          $blade = new Blade('app/views', 'core/cache');
          echo $blade->make($file, $parameters)->render();
      }else{
          http_response_code(404);
          
      }
  }
  /*
  * @param $parameters array
  * @param $file string
  */
  public static function controller($road, $parameters = []){
      $road = array_filter(explode('@',$road));
      $class = $road[0];
      if (isset($road[1]) && !empty($road[1])) {
          $function = $road[1];
      }else {
          $function = 'index';
      }
      if (file_exists('app/controllers/'.strtolower($class).'.php')) {
          require 'app/controllers/'.strtolower($class).'.php';
          call_user_func_array([new $class, $function], $parameters);
      }else{
          http_response_code(404);
          require 'core/static/404.php';
          exit();
      }
  }
  /*
  * @param $parameters array
  * @param $file string
  */
  public static function model($road, $parameters = []){
      $road = array_filter(explode('@',$road));
      $class = $road[0];
      if (isset($road[1]) && !empty($road[1])) {
          $function = $road[1];
      }else {
          $function = 'getAll';
      }
      if (file_exists('app/models/'.strtolower($class).'.php')) {
          require 'app/models/'.strtolower($class).'.php';
          call_user_func_array([new $class, $function], $parameters);
      }else{
          http_response_code(404);
          require 'core/static/404.php';
          exit();
      }
  }
}