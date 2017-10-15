<?php

return [
    /*
     * Specify the different entities you would like to sync with the camel case representation of the
     * class name.
     *
     * Example:
     * [
     *      'user' => \App\Models\User::class,
     * ]
     */
    'entities' => [],

    /*
     * The auth token that should be used to verify the request at the other end
     */
    'api_auth_token' => '',

    /*
     * Define a prefix for your urls.
     * This should be an empty string if no prefix is used.
     */
    'routeUrlPrefix' => '',
];
