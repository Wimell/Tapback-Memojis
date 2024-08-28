<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Geometry\Factories\CircleFactory;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    protected string $imagesPath = 'images/avatars/v1/';

    protected int $totalImages = 58;

    protected array $colors = [
        '#F794E9', // Red/Pink
        '#FF93B6', // Pink
        '#F5A67E', // Orange
        '#F9C584', // Yellow
        '#A5ED9A', // Light Green
        '#6CF2A2', // Green
        '#5FECEE', // Cyan
        '#87C6ED', // Light Blue
        '#AAC7DE', // Sky Blue
        '#B3E0E0', // Light Cyan
        '#C8B7FA', // Light Violet
        '#C7B8D2', // Lavender
        '#C7C0B7', // Beige/Grey
        '#969CA8', // Grayish Blue
        '#C1D2BD', // Pale Greenish
        '#DCACA8', // Pale Pinkish
        '#DFC39E', // Light Tan
        '#5B5B5B', // Dark Gray
    ];

    public function generate(string $name = null)
    {
        $colorIndex = request()->get('color') ?? null;

        if ($colorIndex < 0 || $colorIndex > count($this->colors) - 1) {
            $colorIndex = null;
        }

        if (!$name) {
            $name = Str::random(6);
            return redirect()->route('avatar.generate', ['name' => $name, 'colorIndex' => $colorIndex]);
        }

        $hash = md5($name);

        $imageIndex = hexdec(substr($hash, 0, 8)) % $this->totalImages;
        $selectedImage = $this->imagesPath . ($imageIndex + 1) . '.png';

        if (!$colorIndex) {
            $colorIndex = hexdec(substr($hash, 8, 8)) % count($this->colors);
        }
        $selectedColor = $this->colors[$colorIndex];

        $fileName = "{$hash}_{$colorIndex}.webp";
        $filePath = storage_path("app/public/avatars/{$fileName}");

        if (file_exists($filePath)) {
            return response()->file($filePath)
                ->header('Content-Type', 'image/webp')
                ->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        $manager = new ImageManager(Driver::class);

        $canvas = $manager->create(1024, 1024);

        $canvas->drawCircle(512, 512, function (CircleFactory $circle) use ($selectedColor) {
            $circle->radius(511);
            $circle->background($selectedColor);
        });

        try {
            $selectedImage = $manager->read($selectedImage);
            $selectedImage->resize(920, 920);
        } catch (\Exception $e) {
            dd($selectedImage);
        }

        $canvas->place($selectedImage, 'center', 0, 10);

        if (hexdec(substr($hash, 16, 8)) % 2 == 0) {
            $canvas->flop();
        }


        $canvas->scale(128, 128)->sharpen(2);
        $webp = $canvas->toWebp(100);

        Storage::disk('public')->put("avatars/generated/{$fileName}", $webp);

        return response($webp)
            ->header('Content-Type', 'image/webp')
            ->header('Content-Disposition', 'inline; filename="avatar.webp"')
            ->header('Cache-Control', 'public, max-age=31536000, immutable');
    }
}
