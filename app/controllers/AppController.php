<?php namespace app\controllers;

use core\Input;
use app\models\Article;

class AppController extends Controller
{
	public function index() {

        $articles = new Article();
        $articles = $articles->pagination(1);
        
        $this->display('index', [
            'articles' => $articles->articles,
            'total' => $articles->total,
            'current' => 1
        ]);
    }
    
    public function show($stitle) {

    	$articles = new Article();
        $articles = $articles->where(['stitle', $stitle])->get();

    	$this->display('single', ['articles' => $articles]);
    }

    public function create() {   
        
        if (Input::exists()) {
            
            $content = escape(Input::get('form_message'));
            $age = (Input::get('age') > 80) ? 80 : (int) Input::get('age');
            $gender = (Input::get('gender') == 1) ? 'm' : 'f';

            $article = new Article();

            $article->create([
                'content' => $content,
                'age' => $age,
                'gender' => $gender
            ]);
        }
    }

    public function vote() {

        if (Input::exists()) {
            
            $post_title = Input::get('post_title');
            $type = (int) Input::get('type');

            $article = new Article();

            $article->vote($post_title, $type);
        }
    }

    public function pages($id) {

        $articles = new Article();
        $articles = $articles->pagination((int) $id);

        $this->display('index', [
            'articles' => $articles->articles,
            'total' => $articles->total,
            'current' => $id
        ]);
    }

    public function search($query, $age, $gender, $page) {
        
        $articles = new Article();
        $articles = $articles->search($query, $age, $gender);

        $articles = $articles->pagination($page, $articles->count());

        $this->display('index', [
            'articles' => $articles->articles,
            'total' => $articles->total,
            'current' => $page,
            'query' => $query
        ]);
    }
}