<?php
return [
    [
        'GET',
        '/',
        'SocialNews\FrontPage\Presentation\FrontPageController#show'
    ],
    [
        'GET',
        '/submit',
        'SocialNews\Submission\Presentation\SubmissionController#show'
    ],
    [
        'POST',
        '/submit',
        'SocialNews\Submission\Presentation\SubmissionController#submit'
    ]
];