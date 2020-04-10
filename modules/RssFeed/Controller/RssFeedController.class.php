<?php
    class RssFeedController extends Controller 
    {
        public function Index()
        {
            echo $this->loader->view("RssFeed", Settings::GetAllSettings($_GET['UniqueName']), "RssFeed");
        }
    }
?>