<?php

namespace App\Services;

use Illuminate\Support\Str;

class Service {

    /**
     * @param $image
     * @param $path
     * @return string
     */
    public static function handleUploadedImage($image,$path){
        $imageName = self::generateFileName($image);
        $image->storeAs('public/images/'.$path, $imageName);
        
        return $imageName;
    }

    /**
     * 
     * Get current time.
     */
    public static function currentTime(){
        $localTime = new \DateTime("now", new \DateTimeZone('Asia/Jakarta'));
        $currentTime = $localTime->format('Y-m-d H:i:s');

        return $currentTime;
    }

    /**
     * 
     * Generate file name.
     */
    public static function generateFileName($file): string {
        return rand() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * 
     * Generate token.
     */
    public static function generateToken() {
        return Str::random(8);
    }

    /**
     * generate array from string
     * @return mixed
     */
    public static function generateNameArray($data, $propertyName) {
        $items = [];
        $stringToArray = explode(", ", $data);

        foreach ($stringToArray as $item) {
            $items[] = [$propertyName => $item];
        }

        return $items;
    }

}