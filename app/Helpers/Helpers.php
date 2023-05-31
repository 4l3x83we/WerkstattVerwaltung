<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Helpers.php
 * User: aguth
 * Date: 21.Mai.2023
 * Time: 07:17
 */

use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

if (! function_exists('canonical_url')) {
    function canonical_url(): array|string
    {
        if (\Illuminate\Support\Str::startsWith($current = url()->current(), 'https://www')) {
            return str_replace('https://www.', 'https://', $current);
        }

        return str_replace('https://', 'https://www.', $current);
    }
}

function profilImage($images, $user)
{
    if (! $images) {
        return null;
    }
    $userName = replaceBlank($user->name);
    $path = 'images/profil/'.$userName;
    $img = ImageManagerStatic::make($images['image'])->encode('webp', 75);
    $name = replaceBlank(substr(uniqid(rand(), true), 8, 8).' '.replaceImagesDatei($images['image']->getClientOriginalName().'.webp'));

    if (File::exists(public_path($path))) {
        File::delete(public_path($path));
    }

    if (! File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true, true);
    }

    $image = Image::make($images['image']->getRealPath())->encode('webp', 75)->orientate()->resize(null, 400, function ($c) {
        $c->aspectRatio();
        $c->upsize();
    });
    $image->stream();
    File::put(public_path($path.'/'.$name), $image);

    return $path.'/'.$name;
}

function initials($query)
{
    $name = explode(' ', trim($query->name));

    $first = $name[0];
    $last = $name[count($name) - 1];

    return mb_substr($first[0], 0, 1).''.mb_substr($last[0], 0, 1);
}

function bytesToHuman($bytes): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    $step = 1024;
    $i = 0;
    while (($bytes / $step) > 0.9) {
        $bytes /= $step;
        $i++;
    }

    return round($bytes, 2).' '.$units[$i];
}

function allFileSize($path)
{
    $fileSize = 0;
    foreach (File::allFiles(public_path($path)) as $file) {
        $fileSize += $file->getSize();
    }

    return bytesToHuman($fileSize);
}

function replaceStrToLower($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtolower(str_replace($search, $replace, $item));
}

function replaceStrToUpper($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtoupper(str_replace($search, $replace, $item));
}

function replaceBlank($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return str_replace($search, $replace, $item);
}

function replaceBlankMinus($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '-', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', ' ', '-'];

    return str_replace($search, $replace, $item);
}

function replaceImagesDatei($item): string
{
    $search = ['.jpg', '.jpeg', '.gif', '.png', '.tiff', '.raw', '.psd', '.JPG', '.JPEG', '.GIF', '.PNG', '.TIFF', '.RAW', '.PSD'];
    $replace = [''];

    return str_replace($search, $replace, $item);
}

function password_generate($chars)
{
    $data = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';

    return substr(str_shuffle($data), 0, $chars);
}
