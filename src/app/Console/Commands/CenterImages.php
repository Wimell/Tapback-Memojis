<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Imagick;
use ImagickPixel;

class CenterImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:center {directory=/images/avatars/v1/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Centers all images in the specified directory within their frames.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directory = public_path($this->argument('directory'));


        // Get all PNG files in the directory
        $images = glob($directory . '/*.png');

        if (empty($images)) {
            $this->error('No PNG images found in the specified directory.');
            return 1;
        }

        foreach ($images as $imagePath) {
            $this->centerImage($imagePath);
            $this->info("Centered image: {$imagePath}");
        }

        $this->info("All images in {$directory} have been centered.");

        return 0;
    }

    /**
     * Center the image within its frame.
     *
     * @param string $imagePath
     * @return void
     */
    protected function centerImage(string $imagePath)
    {
        $image = new Imagick($imagePath);

        // Get the image dimensions
        $width = $image->getImageWidth();
        $height = $image->getImageHeight();

        // Find the bounding box of the non-transparent pixels
        $image->trimImage(0);

        // Get the dimensions of the trimmed image
        $trimmedWidth = $image->getImageWidth();
        $trimmedHeight = $image->getImageHeight();

        // Calculate the offset to center the image
        $xOffset = ($width - $trimmedWidth) / 2;
        $yOffset = ($height - $trimmedHeight) / 2;

        // Create a new blank canvas with the original dimensions
        $canvas = new Imagick();
        $canvas->newImage($width, $height, new ImagickPixel('transparent'));
        $canvas->setImageFormat('png');

        // Composite the trimmed image onto the center of the canvas
        $canvas->compositeImage($image, Imagick::COMPOSITE_OVER, $xOffset, $yOffset);

        // Write the image back to the file
        $canvas->writeImage($imagePath);

        // Clean up
        $image->clear();
        $image->destroy();
        $canvas->clear();
        $canvas->destroy();
    }
}
