<?php namespace app\models;

use core\Cookie;
use core\Redirect;

class Article extends Model
{       
    public  $total,
            $articles,
            $limit = 7;

    public function create(array $fields) {
        
        if(!Cookie::exists('secret_posted')) {
            
            $stitle = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
        
            if ($this->where(['stitle', $stitle])->count())
                $this->create($fields);
        
            if($this->insert(array_merge($fields, ['stitle' => $stitle])))
                return Cookie::put('secret_posted', 1, 600);
        }

        return false;
    }

    public function vote($post_title, $type) {
        
        $article = $this->where(['stitle', $post_title]);
        $value = 0;
        
        if (!Cookie::exists("votes-{$post_title}")) {
            $value = 1;
        }
        else if (Cookie::get("votes-{$post_title}") != $type) {
            $value = 2;
        }

        if ($type === 1) {
            $votes = sprintf("%+d", $article->first()->votes + $value);
        } else {
            $votes = sprintf("%+d", $article->first()->votes - $value);
        }

        $article->update(['votes' => $votes]);

        echo $votes;

        return Cookie::put("votes-{$post_title}", $type, 63113904);
    }

    public function pagination($page, $total = false) {

        if ($page < 0) Redirect::to(404);
        
        $start = ($page > 1) ? ($page * $this->limit) - $this->limit : 0;
        
        if (!$total) $total = $this->where(['active', 1])->count();
        
        $this->total = ceil($total / $this->limit);
        $this->articles = $this->get("ORDER BY id DESC LIMIT {$start}, {$this->limit}");

        return $this;
    }

    public function search($query, $age, $gender) {

        $this->where(['active', 1]);
        $this->where(['content', 'LIKE', '%'.$query.'%']);
        
        if ($age > 1) $this->where(['age', $age]);
        if ($gender < 3) $this->where(['gender', ($gender == 1) ? 'm' : 'f']);
        
        return $this;       
    }

    public function get_mod() {
        
        $this->where(['active', 0]);

        $articles = $this->get('ORDER BY id DESC');

        foreach ($articles as $article) {
            if (!Cookie::exists("mod-{$article->stitle}")) return $article;
        }

        return false;
    }

    public function post_mod($title, $mode) {
        
        if (!Cookie::exists("mod-{$title}")) {
        
            $this->where(['stitle', $title]);

            $type = ($mode === 2) ? 'validity' : 'invalidity';
            $number = $this->first()->$type + 1;

            $this->update([$type => $number]);

            return Cookie::put("mod-{$title}", $mode, 63113904);
        }

    }
}