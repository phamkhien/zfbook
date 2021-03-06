<?php

class Admin_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract {

    /**
     * Using view partial to separeted logic get data from db and repesent data on html mockup
     * 
     * @author TienVm
     * @link http://framework.zend.com/manual/1.12/en/zend.view.helpers.html#zend.view.helpers.initial.partial
     * 
     * @return string
     */
    public function flashMessenger() {
        $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');

        if ($flashMessenger->hasMessages('add-false')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('add-false') as $msg):
                $html .= "<div class='info-box bg-yellow'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-exclamation-triangle'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }

        if ($flashMessenger->hasMessages('add-successful')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('add-successful') as $msg):
                $html .= "<div class='info-box bg-green'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-thumbs-o-up'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }
        
         if ($flashMessenger->hasMessages('edit-false')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('edit-false') as $msg):
                $html .= "<div class='info-box bg-yellow'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-exclamation-triangle'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }

        if ($flashMessenger->hasMessages('edit-successful')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('edit-successful') as $msg):
                $html .= "<div class='info-box bg-green'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-thumbs-o-up'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }

        if ($flashMessenger->hasMessages('delete-successful')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('delete-successful') as $msg):
                $html .= "<div class='info-box bg-green'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-thumbs-o-up'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }
        if ($flashMessenger->hasMessages('delete-false')) {
            $html = "<div class= 'message success'> ";
            foreach ($flashMessenger->getMessages('delete-false') as $msg):
                $html .= "<div class='info-box bg-yellow'>";
                $html .= "<span class='info-box-icon'><i class='fa fa-exclamation-triangle'></i></span>";
                $html .= "<div class='info-box-content'>";
                $html .= "<p> $msg </p>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= " </div>";
            return $html;
        }

    }

}
