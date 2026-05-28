<?php

return [
    'storage_disk' => env('LARAVEL_TRIX_STORAGE_DISK', 'public'),

    'store_attachment_action' => Wilber\LaravelTrix\Http\Controllers\TrixAttachmentController::class.'@store',

    'destroy_attachment_action' => Wilber\LaravelTrix\Http\Controllers\TrixAttachmentController::class.'@destroy',
];
