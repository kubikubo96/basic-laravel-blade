<?php

namespace App\Console\Commands;

use App\Models\ColearnCrawler;
use File;
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
        $this->addClass();
    }

    public function addClass()
    {
        ColearnCrawler::chunk(200, function ($questions) {
            foreach ($questions as $qa) {
                $data['class_name'] = '12';
                $data['class_id'] = 'fc5af818-26f9-4d77-a0cb-91794b84bdd8';
                $qa->update($data);
            }
        });
        echo "SUCCESS";
    }

    public function addCategoryId()
    {
        ColearnCrawler::chunk(200, function ($questions) {
            foreach ($questions as $qa) {
                $data['category_id'] = 'a3df661c-4a1d-48e4-a544-2772b74364f7';
                $qa->update($data);
            }
        });
        echo "SUCCESS";
    }

    public function convertImage()
    {
        $path = 'images-crawler/' . date("dmy");
//        File::makeDirectory(public_path($path), 777, true, true);
        ColearnCrawler::chunk(200, function ($questions) use ($path) {
            foreach ($questions as $qa) {
                if (!empty($qa['image_question'] && is_array($qa['image_question']))) {
                    $image_questions = [];
                    foreach ($qa['image_question'] as $key => $img) {
                        $filename = $qa['href'] . "-" . $key . "-" . $qa['id'] . ".jpg";
                        $image = file_get_contents($img['src']);
                        file_put_contents(public_path($path . '/' . $filename), $image);
                        $image_questions[] = $path . '/' . $filename;
                    }
                    $data['image_names'] = $image_questions;
                    $qa->update($data);
                }
            }
        });
        echo "SUCCESS";
    }
}
