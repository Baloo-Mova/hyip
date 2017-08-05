<?php

function is_error( $field_name )
{
    $errors = session('errors');

    if( $errors && $errors->first($field_name) ) {
        return true;
    }

    return false;
}

function generate_file_name($extension)
{
    return time() . substr( md5(microtime()), 0, rand(5, 12) ) . $extension;
}