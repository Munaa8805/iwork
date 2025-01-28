<?php


/**
 *  Get base path
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    // echo $path;
    return __DIR__ . '/' . $path;
}

/**
 * Load a view 
 * @param string $name
 * @return void
 */

function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    // inspect($name);
    // inspect($viewPath);


    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found";
    }
}
function loadPartial($name)
{
    $partialPath =  basePath("App/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found";
    }
}

/**
 * Inspect a value
 * @param mixed $value  
 * @return void
 */

function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

function formatSalary($salary)
{
    return '$' . number_format($salary, 0, '.', ',');
    // return '$' . number_format(floatval($salary), 0, '.', ',');
}
/**
 * Sanitize Data
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
