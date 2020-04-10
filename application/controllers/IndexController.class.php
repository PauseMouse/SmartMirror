<?php
    class IndexController extends Controller 
    {
        public function __construct()
        {
            parent::__construct(false);
        }

        public function Index()
        {
            echo $this->loader->view('Index', Settings::GetAllSettings());
        }
    }
?>