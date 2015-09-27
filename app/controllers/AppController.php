<?php namespace app\controllers;

use core\Input;
use core\Cookie;
use app\models\Article;

class AppController extends Controller
{
	public function index($page = 1)
    {
        $articles = new Article();

        $articles = $articles->pagination((int) $page);
        
        $this->display('index', [
            'articles' => $articles->articles,
            'total' => $articles->total,
            'current' => $page
        ]);
    }
    
    public function show($stitle)
    {
    	$article = new Article();
        $article = $article->where(['stitle', $stitle])->first();

    	$this->display('single', ['article' => $article]);
    }

    public function create()
    {       
        if (Input::exists()) {
            
            $content = escape(Input::get('form_message'));
            $age = (int) Input::get('age');
            $gender = (Input::get('gender') == 1) ? 'm' : 'f';

            if ($age < 14) Redirect::to(404);

            $article = new Article();

            $article->create([
                'content' => $content,
                'age' => $age,
                'gender' => $gender
            ]);
        }
    }

    public function vote()
    {
        if (Input::exists()) {
            
            $post_title = Input::get('post_title');
            $type = (int) Input::get('type');

            $article = new Article();

            $article->vote($post_title, $type);
        }
    }

    public function search($query, $age, $gender, $page = 1)
    {    
        $articles = new Article();

        $articles = $articles->search($query, $age, $gender);

        $articles = $articles->pagination((int) $page, $articles->count());

        $this->display('index', [
            'articles' => $articles->articles,
            'total' => $articles->total,
            'current' => (int) $page,
            'query' => $query
        ]);
    }

    public function mod()
    {    
        $article = new Article();
        $article = $article->get_mod();

        $this->display('mod', ['article' => $article]);
    }

    public function post_mod()
    {    
        if (Input::exists()) {
            
            $title = Input::get('title');
            $mode = (int) Input::get('mode');

            $article = new Article();
            $article->post_mod($title, $mode);
        }
    }

    public function hot($page = 1) {
        
        $articles = new Article();

        $articles = $articles->where(['active', 1]);
        $articles = $articles->where(['is_hot', 1]);
        $articles = $articles->pagination((int) $page);

        dd($articles->articles);
    }
}