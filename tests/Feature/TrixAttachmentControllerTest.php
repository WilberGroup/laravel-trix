<?php

namespace Wilber\LaravelTrix\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Wilber\LaravelTrix\Models\TrixAttachment;
use Wilber\LaravelTrix\Tests\Models\Post;
use Wilber\LaravelTrix\Tests\TestCase;

class TrixAttachmentControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_store_attachment_request()
    {
        Storage::fake('fooDisk');

        $response = $this->json('POST', route('laravel-trix.store'), [
            'file' => UploadedFile::fake()->image('foo.jpg'),
            'modelClass' => Post::class,
            'field' => 'fooField',
            'disk' => 'fooDisk',
        ]);
        $this->assertTrue(
            TrixAttachment::where('attachment', basename($response->decodeResponseJson()->json('url')))
                ->where('is_pending', 1)
                ->exists()
        );
    }

    #[Test]
    public function it_destroy_attachment()
    {
        Storage::fake('fooDisk');

        TrixAttachment::create([
            'field' => 'content',
            'attachable_type' => Post::class,
            'attachment' => 'randomImage.jpg',
            'disk' => 'fooDisk',
        ]);

        $this->delete(route('laravel-trix.destroy', ['attachment' => 'randomImage.jpg']));

        $this->assertTrue(
            TrixAttachment::where('attachment', 'randomImage.jpg')
                ->doesntExist()
        );
    }
}
