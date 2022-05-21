<?php

namespace App\Jobs;

use App\Library\CGlobal;
use App\Post;
use Elasticsearch\ClientBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ElasticSearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id, $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->queue = 'Elasticsearch';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $check_exist = $this->find($this->id);
        $type = $this->type;
        if (!$check_exist) {
            $type = CGlobal::ELASTIC_CREATE;
        }
        switch ($type) {
            case CGlobal::ELASTIC_CREATE:
                $this->create($this->id);
                break;
            case CGlobal::ELASTIC_UPDATE:
                $this->update($this->id);
                break;
            case  CGlobal::ELASTIC_DELETE:
                $this->delete($this->id);
                break;
        }
    }

    private function find($id)
    {
        $client = ClientBuilder::create()->build();
        $check_exits = $client->indices()->exists(['index' => CGlobal::INDEX_ELASTIC_POST]);
        if (!$check_exits) {
            return 0;
        }
        $params = [
            'index' => CGlobal::INDEX_ELASTIC_POST,
            'type' => CGlobal::INDEX_ELASTIC_POST,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => ['_id' => $id]
                            ],
                        ],
                    ]
                ],
            ]
        ];

        $data = $client->search($params);

        return $data['hits']['total'];
    }

    private function create($id)
    {
        $client = ClientBuilder::create()->build();
        $data = Post::find($id)->toArray();
        $params = [
            'index' => CGlobal::INDEX_ELASTIC_POST,
            'type' => CGlobal::INDEX_ELASTIC_POST,
            'id' => $id,
            'body' => [
                'post' => $data
            ]
        ];
        $client->index($params);
    }

    private function update($id)
    {
        $client = ClientBuilder::create()->build();
        $data = Post::find($id)->toArray();
        $params = [
            'index' => CGlobal::INDEX_ELASTIC_POST,
            'type' => CGlobal::INDEX_ELASTIC_POST,
            'id' => $id,
            'body' => [
                'doc' => [
                    'post' => $data
                ]
            ]
        ];
        $client->update($params);
    }

    private function delete($id)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => CGlobal::INDEX_ELASTIC_POST,
            'type' => CGlobal::INDEX_ELASTIC_POST,
            'id' => $id,
        ];
        $client->delete($params);
    }
}
