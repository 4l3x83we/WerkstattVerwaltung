<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ClearLivewireTmpCommand.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 06:47
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Livewire\FileUploadConfiguration;

class ClearLivewireTmpCommand extends Command
{
    protected $signature = 'clear:livewire-tmp';

    protected $description = 'Deleting the temporary files from the upload with Livewire';

    public function handle(): void
    {
        $storage = FileUploadConfiguration::storage();
        foreach ($storage->allFiles(FileUploadConfiguration::path()) as $filePathname) {
            if (! $storage->exists($filePathname)) {
                continue;
            }

            $yesterdaysStamp = now()->subHour()->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
}
