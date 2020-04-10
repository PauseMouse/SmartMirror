<?php
    class BuienradarController extends Controller 
    {
        public function Index()
        {
            echo $this->loader->view("Buienradar", null, "Buienradar");
        }

        public function Week()
        {
            echo $this->loader->view("Buienradarweek", null, "Buienradar");
        }
    }
?>