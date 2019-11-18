<?php


class Site
{

    private $page;

    public function __construct($page){
        $this->page = $page;
        if (!file_exists("./components/".$page.".php")) $page = "404";
        include_once("./components/".$page.".php");

    }

    public function getpage(){
        return $this->page;
    }

    public function sitename(){
        return $_SESSION["sitename"];
    }

    public function gettitle(){

        $title = SITENAME . " | " . $_SESSION["sitename"] ;
        return $title;
    }
}