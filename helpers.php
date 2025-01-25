<?php


/**
 *  Get base path
 * @param string $path
 * @return string
 */

 function basePath($path = '') {
    // echo $path;
     return __DIR__ . '/' . $path;
 }