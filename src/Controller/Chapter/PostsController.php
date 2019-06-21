<?php


namespace App\Controller\Chapter;


use App\Model\ChapterManager;

class PostsController
{
   public function chapters()
    {
        $chapter = new ChapterManager();
        $lastChapter = $chapter->getLastChapter();
        $firstChapter = $chapter->getFirstChapter();
        $allChapters = $chapter->getAllChapters();
        $lastThreeChapters = $chapter->getLastThreeChapters();
        require 'src/View/chapters.php';
    }
}