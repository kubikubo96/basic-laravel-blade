<?php

namespace App\Http\Controllers\API;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\ColearnCrawler;
use App\Services\Debug\TelegramService;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function all()
    {
        $res['total'] = ColearnCrawler::count();
        $res['data'] = ColearnCrawler::whereNotNull('image_names')->get();
        return Response::data($res);
    }

    public function store(Request $request): array
    {
        try {
            $data = $request->all();
            ColearnCrawler::create($data);
            return Response::data();
        } catch (\Exception $e) {
            TelegramService::sendError($e);
            return Response::data($e->getMessage(), 400);
        }
    }

    public function update(Request $request)
    {
        $id = 2853;
        $qa = ColearnCrawler::find($id);
        try {
            $data = $request->all();
            $data['image_question'] = json_encode($data['image_question']);
            $data['option'] = json_encode($data['option']);
            $data['name_subject'] = $qa['name_subject'];
            $data['title_subject'] = $qa['title_subject'];
            $data['name_topic'] = $qa['name_topic'];
            $qa->update($data);
            return Response::data();
        } catch (\Exception $e) {
            TelegramService::sendError($e);
            return Response::data($e->getMessage(), 400);
        }
    }
}
