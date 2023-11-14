<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ReplaceStringsInFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:replace-in-file {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        if (File::exists($filename)) {
            $contents = File::get($filename);

            // Use regular expressions to search and replace the desired string
            $replacedContents = preg_replace('/(\w+)(@)(\w+)/', "[$1::class,'$3']", $contents);

            if ($replacedContents !== null) {
                File::put($filename, $replacedContents);
                $this->info("Replaced the string in the file: $filename");
            } else {
                $this->error('Pattern not found in the file.');
            }
        } else {
            $this->error('File not found.');
        }
    }
}
