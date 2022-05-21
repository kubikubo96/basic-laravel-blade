<?php

namespace App\Services;

use Elasticsearch\ClientBuilder;

class testService
{
    private $id, $type;

    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function test()
    {
        $client = ClientBuilder::create()->build();
        $check = $this->find($this->id);

        $type = $this->type;
        if ($check) {
            $type = 1;
        }
        switch ($type) {
            case 1:
                $post = Post::find($this->id)->toArray();
                $params = [
                    'index' => 'my_post',
                    'body' => [
                        'post' => $post
                    ]
                ];
                $client->index($params);
                break;
            case 2:
                $post = Post::find($this->id)->toArray();
                $params = [
                    'index' => 'my_post',
                    'body' => [
                        'post' => $post
                    ]
                ];
                $client->update($params);
                break;
        }
    }

    public function create()
    {
        $params = [
            'index' => 'my_post',
            'type' => 'my_post',
            'body' => [
                'id' => "id",
                'user_id' => "user_id",
                'title' => "title",
                'title_link' => "title_link",
                'content_post' => "content_post",
                'image' => "image",
                'delete_at' => "delete_at",
                'created_at' => "created_at",
                'updated_at' => "updated_at",

            ]
        ];

        $this->client->index($params);
    }

    public function search($index, $string = ''): array
    {
        if ($string) {
            $fields = ['title'];
            $params = [
                'index' => $index,
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $string,
                            'fields' => $fields
                        ]
                    ]
                ]
            ];
        } else {
            $params = [
                'index' => $index,
                'body' => [
                    'query' => [
                        'match_all' => (object)[],
                    ]
                ]
            ];
        }
        $data = $this->client->search($params);

        $res['data'] = collect($data['hits']['hits'])->pluck('_source')->toArray();
        $res['total'] = $data['hits']['total'];

        return $res;
    }

    public function find($index, $id)
    {
        $params = [
            'index' => $index,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => ['id' => $id]
                            ],
                        ],
                    ]
                ],
            ]
        ];

        return $this->client->search($params);
    }
}
