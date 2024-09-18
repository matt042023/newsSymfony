<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Entities\News as NewsEntities;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        
        $data = [
            'news'  => $model->getAllNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function show($slug = null)
    {
        $model = model(NewsModel::class);


        $data = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }
        // $entity = new NewsEntities($data['news']['id'], $data['news']['title'], $data['news']['slug'],$data['news']['body']);
        // $data['news'] = $entity;
        // $data['title'] = $entity->getTitle();

        return view('templates/header', [
            'news' => $data,
            'title'=> $data->getTitle()
        ])
            . view('news/view')
            . view('templates/footer');
    }
}