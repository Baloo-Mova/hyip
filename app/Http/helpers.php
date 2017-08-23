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

/**
 * Get count users`s referrals
 *
 * @param $user_id
 * @param $users
 * @return int
 */
function get_referrals_count($user_id, $users)
{
    $count = 0;
    foreach ($users as $user) {
        if ($user->referral_id == $user_id) {
            $count++;
        }
    }

    return $count;
}

function get_referral_level($user_id, $users, $level = 1)
{
    $ref_level  = [];
    foreach ($users as $user) {
        if ($user_id == $user->referral_id) {
            if (!empty($ref_level['level ' . $level])) {
                $ref_level['level ' . $level] = $ref_level['level ' . $level] + 1;
            } else {
                $ref_level['level ' . $level] = 1;
            }
            $ref = get_referral_level($user->id, $users, $level + 1);
            $ref_level = array_merge($ref_level, $ref);
        }
    }

    return $ref_level;
}

