<?php
    class ClockController extends Controller 
    {
        public function Index()
        {
            echo $this->loader->view("Clock", Settings::GetAllSettings($_GET['UniqueName']), "Clock");
        }
    }
?>