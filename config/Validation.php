<?php
return [
    'sign_up' => [
        'validation_rules' => [

            'username' => 'required',
            'email' => 'email|required|unique:api_users,email',
            'password' => 'required|min:6',
        ]
    ],
    'login' => [
        'validation_rules' => [
//            'username' => 'required|email',
            'password' => 'required',
            'grant_type' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]
    ],
    'refresh_token' => [
        'validation_rules' => [
            'grant_type' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
            'refresh_token' => 'required',
        ]
    ],


    'forgot_password' => [
        'validation_rules' => [
            'email' => 'required|email'
        ]
    ],
    'activate_code' => [
        'validation_rules' => [
            'new-password' => 'required',
//            'code' => 'required|invalid'
        ]
    ],

    'reset_password' => [
        'validation_rules' => [
            'old-password' => 'required',
            'new-password' => 'required'
        ]
    ],


    'fingerprint' => [
        'validation_rules' => [
            'username' => 'required',
            'grant_type' => 'required',

        ]
    ],

    'change_password' => [
        'validation_rules' => [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'


        ]

    ],
    'forgot_set_password' => [
        'validation_rules' => [
            'token' => 'required',
            'password' => 'required',


        ],
    ]


];