<?php

/**
 * Check for error for Validator errors into templates
 *
 * @param string $field_name
 *
 * @return bool
 */
function is_error( $field_name )
{
    $errors = session('errors');

    if( $errors && $errors->first($field_name) ) {
        return true;
    }

    return false;
}

/**
 * Create random file name
 *
 * @param $extension
 * @return string
 */
function generate_file_name($extension)
{
    return time() . substr( md5(microtime()), 0, rand(5, 12) ) . $extension;
}