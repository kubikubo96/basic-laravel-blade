<?php

namespace App\Console\Commands;

use App\Models\ColearnCrawler;
use Illuminate\Console\Command;

class ConvertCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     **
     * @return mixed
     */
    public function handle()
    {
        ColearnCrawler::chunk(20, function ($questions) {
            foreach ($questions as $qa) {
                if (!empty($qa['image_question'])) {
                    $image_questions = [];
                    foreach ($qa['image_question'] as $key => $img) {
                        $filename = $qa['href'] . "-" . $key . "-" . $qa['id'] . ".jpg";
                        $image = file_get_contents($img['src']);
                        file_put_contents(public_path('questions/' . $filename), $image);
                        $image_questions[] = $filename;
                    }
                    $data['image_names'] = $image_questions;
                    $qa->update($data);
                }
            }
        });
    }
}
