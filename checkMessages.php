<?php

    require_once 'db.php';
    require_once './src/required.php';

    $messages = null;
    
    $db= new db();
    if($db->connect_db()){
        $db->add_query("getMessages",
            "SELECT c.contact_name as 'Name',
            c.contact_company as 'Company',
            c.contact_email as 'EMail',
            c.contact_phone as 'Phone',
            s.subject_text as 'Subject',
            m.msg_content as 'Message'
            FROM tbl_contacts c
            JOIN tbl_messages m
            JOIN tbl_subjects s
            ON m.contact_id=c.contact_id
            AND m.subject_id=s.subject_id");
        
        if($messages = $db->get_Data("getMessages")){
            
            $page = new page("Messages");
            $page->setIcon("./img/tv.png");
            $page->addStylesheet("./css/checkMessages.css");
            
            $table = new div();
            $table->setId("table");
            
            $row = new div();
            $row->setId("row");
            foreach ($messages["row0"] as $name => $value){
                $cell = new div();
                $cell->setId("cell");
                $cell->addContent(new text($name));
                $row->addContent(clone $cell);
            }
            $table->addContent(clone $row);
            
            foreach ($messages as $data){
                $row = new div();
                $row->setId("row");
                foreach ($data as $value){
                    $cell = new div();
                    $cell->setId("cell");
                    $cell->addContent(new text($value));
                    $row->addContent(clone $cell);
                }
                $table->addContent(clone $row);
            }
            $page->addContent($table);
            $page->Show();
        }
    }

?>