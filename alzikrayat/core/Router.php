<?php
/**
 * Core Manual Router Engine
 * Maps parameterized URLs to Controllers using Regular Expressions[cite: 1].
 */
class Router {
    private $routes = [];

    // Register a route with method, path pattern, and controller action array
    public function add($method, $path, $controllerAction) {
        // Convert route placeholders like {id} into regex capture groups ([^/]+)
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '([^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'action' => $controllerAction
        ];
    }

    // Dispatch the current URL request to the matching controller method
    public function dispatch($uri, $method) {
        $method = strtoupper($method);
        
        // Remove query strings from URI if any exist
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                // Remove the first full match element, leaving only captured parameters
                array_shift($matches);

                [$controllerName, $methodName] = $route['action'];

                $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerName();

                    // Call controller method dynamically and pass parameters (e.g., photo ID)
                    return call_user_func_array([$controller, $methodName], $matches);
                } else {
                    echo "Controller file not found: " . $controllerName;
                    return;
                }
            }
        }

        // Handle 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page Not Found";
    }
}
?>