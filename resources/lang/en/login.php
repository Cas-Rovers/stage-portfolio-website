<?php

return [
    'title' => 'Login',
    'inputs' => [
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Enter your email address here...',
            'aria_label' => 'The field to enter your email address.',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Enter your password here...',
            'aria_label' => 'The field to enter your password.',
        ],
        'remember-me' => [
            'label' => 'Remember me',
            'aria_label' => 'Checkbox to remember the user.',
        ],
    ],
    'actions' => [
        'submit' => [
            'content' => 'Sign in',
            'aria_label' => 'The button to login.',
        ],
    ],
];
