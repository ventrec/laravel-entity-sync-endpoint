<?php

return [
    /**
     * Specify the different entities you would like to sync with the camel case representation of the
     * class name.
     *
     * Example:
     * [
     *      'user' => \App\Models\User::class,
     * ]
     */
    'entities' => [],

    /**
     * The auth token that should be used to verify the request at the other end
     */
    'api_auth_token' => '',
];
