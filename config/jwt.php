<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Secret Key
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, as it will be used to sign
    | your tokens. A helper command is provided for this:
    | `php artisan jwt:secret`
    |
    */

    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | JWT Keys
    |--------------------------------------------------------------------------
    |
    | The public and private keys should be set in your .env file. The keys
    | should be base64 encoded. You can generate them using the following:
    | `openssl genrsa -out private.pem 2048`
    | `openssl rsa -in private.pem -pubout -out public.pem`
    |
    */

    'keys' => [
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
        'passphrase' => env('JWT_PASSPHRASE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | JWT time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 1 hour.
    |
    | You can also set this to null, to yield an indefinite token.
    |
    */

    'ttl' => env('JWT_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Refresh time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token can be refreshed.
    | Defaults to 2 weeks.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | JWT hashing algorithm
    |--------------------------------------------------------------------------
    |
    | Specify the hashing algorithm that will be used to sign the token.
    |
    | The allowed options are: 'HS256', 'HS384', 'HS512', 'RS256', 'RS384',
    | 'RS512', 'ES256', 'ES384', 'ES512'
    |
    */

    'algo' => env('JWT_ALGO', 'HS256'),

    /*
    |--------------------------------------------------------------------------
    | Required Claims
    |--------------------------------------------------------------------------
    |
    | Specify the claims that must be present in the token. You can add any
    | custom claims here.
    |
    */

    'required_claims' => ['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'],

    /*
    |--------------------------------------------------------------------------
    | Persistent Claims
    |--------------------------------------------------------------------------
    |
    | The claims that will be persisted in the token when it is refreshed.
    |
    */

    'persistent_claims' => [],

    /*
    |--------------------------------------------------------------------------
    | Lock Subject
    |--------------------------------------------------------------------------
    |
    | Lock the subject (sub claim) to the user's id. If set to true, the token
    | will throw an exception when trying to use a different user id.
    |
    */

    'lock_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Leeway
    |--------------------------------------------------------------------------
    |
    | This option gives you the ability to mitigate the nbf claim attack by
    | setting a leeway. This will cause the nbf claim to be interpreted as
    | being n seconds in the past rather than exactly as stated in the token.
    |
    | This is expressed in seconds.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | Blacklist Enabled
    |--------------------------------------------------------------------------
    |
    | In order to invalidate tokens, you must enable the blacklist.
    |
    | If enabled, the token will be added to the blacklist when it is logged out
    | or when the refresh method is called.
    |
    */

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Blacklist Grace Period
    |--------------------------------------------------------------------------
    |
    | If enabled, the blacklist will not enforce the grace period when adding
    | tokens to the blacklist. This is useful for high-volume applications
    | where tokens are frequently refreshed.
    |
    | This is expressed in seconds.
    |
    */

    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    /*
    |--------------------------------------------------------------------------
    | Decoding
    |--------------------------------------------------------------------------
    |
    | Specify the decoding options.
    |
    */

    'decoding' => [
        'require_iat' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    |
    | Specify the validation options.
    |
    */

    'validation' => [
        'validate_iss' => true,
        'validate_iat' => true,
        'validate_exp' => true,
        'validate_nbf' => true,
        'validate_sub' => true,
        'validate_jti' => true,
    ],

];