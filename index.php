<?php

    require_once ("./src/required.php");
    require_once ("./db.php");
    
    const css_master = "./css/master.css";
    const css_hljs = "//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css";
    const js_hljs = "//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js";
    const js_jquery = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
    const cmd_hljs = "hljs.highlightAll();";
    
    const page_icon = "./img/tv.png";
    const img_close = "./img/close.png";
    
    const txt_aboutme = "./text/aboutme.txt";
    const txt_aboutscs = "./text/aboutscs.txt";
    const txt_aboutnetm = "./text/aboutnetmatters.txt";
    const txt_abouttree = "./text/abouttreehouse.txt";
    
    const face_link = "https://www.facebook.com/vargata77";
    const git_link = "https://github.com/vargata?tab=repositories";
    const you_link = "https://www.youtube.com/channel/UCZWUSLs4NT5tGBc5fIYplIA";
    const tree_link = "https://teamtreehouse.com/profiles/tamasvarga2";
    
    const content = array(
        "content1" => array(
            "link" => "http://netmatters.tamas-varga.netmatters-scs.co.uk/",
            "title" => "NetMatters website clone"
        ),
        "content2" => array(
            "link" => "https://tamas-varga.netmatters-scs.co.uk/jsarray/index.html",
            "title" => "JS-Array reflection"
        ),
        "content3" => array(
            "link" => "https://vargata.github.io/bestmovies/index.html",
            "title" => "SQL challenge"
        ),
        "content4" => array(
            "link" => "#",
            "title" => "Coming Soon"
        ),
        "content5" => array(
            "link" => "#",
            "title" => "Coming Soon"
        ),
        "content6" => array(
            "link" => "#",
            "title" => "Coming Soon"
        ) 
    );
    
    //fetching subjects from database
    
    if($_SERVER["HTTP_HOST"] == "localhost")
        $db = new db("localhost", "contact_user", "contactpwd", "db_portfolio");
    else
        $db = new db("138.68.136.139", "tamasvar_contact_user", "dU91Sc&Y0E5J", "tamasvar_db_portfolio");
    
    $subjects = array();
    if($db->connect_db()){
        $db->add_query("getSubjects", "SELECT * FROM tbl_subjects");
        $subjects = $db->get_Data("getSubjects");
        $db->close_db();
    }
    
    //end fetching data
    
    $page = new page("My portfolio");{
        $page->lang = "en";
        $page->setIcon(page_icon);
        $page->addStylesheet(css_master);
        $page->addStylesheet(css_hljs);
        $page->addScript(script_type::HEADLINK, js_hljs);        
        $page->addScript(script_type::HEADLINK, js_jquery);
        $page->addScript(script_type::BODYLINK, "js/pfclick.js");
        $page->addScript(script_type::BODYLINK, "js/matrix.js");
        $page->addScript(script_type::BODYLINK, "js/showpage.js");
        $page->addScript(script_type::BODYLINK, "js/titleanim.js");
        $page->addScript(script_type::BODYLINK, "js/countchar.js");
        $page->addScript(script_type::BODYLINK, "js/mobilemenu.js");
        $page->addScript(script_type::BODYLINK, "js/formhandler.js");
        $page->addScript(script_type::RUNCMD, cmd_hljs);
    }
    
    $page->addContent($charset = new meta());{
        $charset->setCharset(charset::UTF8);
    }
    
    $page->addContent($mobile = new meta());{
        $mobile->setName("viewport");
        $mobile->addContent("width=device-width");
        $mobile->addContent("initial-scale=1.0");
    }
    
    $page->addContent($hidden_overlay = new div());{
        $hidden_overlay->setId("hidden_overlay");
    }
    
//---------------------------------------------- mobile menu button ----------------------------------------------------    
    
    $btn_mobile_menu = new url_link("javascript: showMenu();");{
        $btn_mobile_menu->addClass("mobile_bg");
        
        $mobile_menu = new div();
        $mobile_menu->addClass("mobile_menu");
        $mobile_menu->addContent(new text("&#9002;&#9002;&#9002;"));
        
        $btn_mobile_menu->addContent($mobile_menu);
        
        $page->addContent($btn_mobile_menu);
    }
    
//-------------------------------------------- about me ---------------------------------------------------------------    
    
    $page->addContent($about = new div());{
        $about->setId("about");
        $about->addClass("hide");        
        $about->addContent($about_wrap = new div());{
            $about_wrap->addContent($about_text = new text(""));{
                $about_text->getFromURL(txt_aboutme);
                $about_text->preformat();
            }
        }
        
        $btn_hide_about = new url_link("javascript: hide('about');");{
            $btn_hide_about->setTitle("Back to main page");
            $btn_hide_about->addContent(new image(img_close, "Close"));
                $btn_hide_about->addContent(new div());
            $about->addContent($btn_hide_about);
        }
    }
    
//--------------------------------------- code samples --------------------------------------------------------    
    
    $sql_code = new code("");{
        $sql_code->getFromURL("./text/sql.txt");
        $sql_code->addClass("language-sql");
        $sql_code->preformat();
    }
    
    $php_code = new code("");{
        $php_code->getFromURL("./text/php.txt");
        $php_code->addClass("language-php");
        $php_code->preformat();
    }
    
    $js_code = new code("");{
        $js_code->getFromURL("./text/js.txt");
        $js_code->addClass("language-js");
        $js_code->preformat();
    }
    
    $page->addContent($code = new div());{
        $code->setId("code");
        $code->addClass("hide");
        $code->addContent($code_wrap = new div(null));{
            $code_wrap->addContent($sql_code);
            $code_wrap->addContent($php_code);
            $code_wrap->addContent(new image("./img/js_sample.gif", "js animation"));
            $code_wrap->addContent($js_code);
        }
        $code->addContent($btn_hide_code = clone $btn_hide_about);
        $btn_hide_code->setUrl("javascript: hide('code');");
    }
    
//--------------------------------------------- scion window -----------------------------------------------------    
    
    $hd_scion = new heading(1);{
        $hd_scion->addContent(new text("Introduction to Scion Coalition Scheme"));
    }
    
    $p_scion = new paragraph();{
        $p_scion->addContent($txt_pscion = new text(""));
            $txt_pscion->getFromURL(txt_aboutscs);
    }
    
    $hd_tree = new heading(2);{
        $hd_tree->addContent(new text("Treehouse"));
    }
    
    $p_tree = new paragraph();{
        $p_tree->addContent($txt_ptree = new text(""));
        $txt_ptree->getFromURL(txt_abouttree);
    }
    
    $hd_netmatters = new heading(2);{
        $hd_netmatters->addContent(new text("About Netmatters"));
    }
    
    $txt_netm = new text("");{
        $txt_netm->getFromURL(txt_aboutnetm);
        $txt_netm->preformat();
    }
    
    $score = null;
    preg_match("/<h1>([0-9]{1,3},[0-9]{3})<\/h1>/", file_get_contents(tree_link), $score);
    
    $p_score = new paragraph();{
        $p_score->addContent(new text("Total Score " . (($score[1]) ? $score[1] : "12,509")));
    }
    
    $link_tree = new url_link(tree_link);{
        $link_tree->setTarget(link_target::NEWPAGE);
        $link_tree->setTitle("My Treehouse profile");
        $link_tree->addContent(new text("My treehouse profile"));
        $link_tree->addContent(new div());
    }
    
    $page->addContent($scs = new div());{
        $scs->setId("scs");
        $scs->addClass("hide");
        $scs->addContent($scs_wrap = new div());{
            $scs_wrap->addContent($hd_scion);
            $scs_wrap->addContent($p_scion);
            $scs_wrap->addContent($hd_tree);
            $scs_wrap->addContent($p_tree);
            $scs_wrap->addContent($p_score);
            $scs_wrap->addContent($link_tree);
            $scs_wrap->addContent($hd_netmatters);
            $scs_wrap->addContent($txt_netm);
        }
        
        $scs->addContent($btn_hide_scs = clone $btn_hide_about);
        $btn_hide_scs->setUrl("javascript: hide('scs');");
    }
    
//--------------------------------------- page container ------------------------------------------------------------
    
    $page->addContent($page_container = new div());{
        $page_container->addClass("page_container");
    }
    
//--------------------------------------- left menu -------------------------------------------------------------------
    
    $left_menu = new div();{
        $left_menu->addClass("leftmenu_container");
        $page_container->addContent($left_menu);
    }
    
    $leftmenu_header = new  div();{
        $leftmenu_header->addClass("leftmenu_header");
        $leftmenu_header->addContent(new image(page_icon, "tv"));
        
        $left_menu->addContent($leftmenu_header);
    }
    
    $leftmenu_content = new div();{
        $leftmenu_content->addClass("leftmenu_content");
        $leftmenu_content->addContent($lm_wrap = new div());
        
        $left_menu->addContent($leftmenu_content);
    }
    
    $about_link = new url_link("./about.html");{
        $about_link->addEvent("onclick", "show('about'); return false;");
        $about_link->setTitle("READ ALL ABOUT ME");
        $about_link->addContent(new text("ABOUT&nbsp;ME"));
        $about_link->addContent(new div());
        
        $lm_wrap->addContent($about_link);
    }
    
    $code_link = new url_link("./code.html");{
        $code_link->addEvent("onclick", "show('code'); return false;");
        $code_link->setTitle("CHECK OUT CODING EXAMPLES FROM ME");
        $code_link->addContent(new text("EXAMPLES"));
        $code_link->addContent(new div());
        
        $lm_wrap->addContent($code_link);
    }
    
    $scs_link = new url_link("./scs.html");{
        $scs_link->addEvent("onclick", "show('scs'); return false;");
        $scs_link->setTitle("READ ABOUT THE SCION COALITION SCHEME");
        $scs_link->addContent(new text("SCS&nbsp;SCHEME"));
        $scs_link->addContent(new div());
        
        $lm_wrap->addContent($scs_link);
    }
    
    $scs_link = new url_link("#portfolio");{
        $scs_link->setTitle("TAKE A LOOK AT MY PORTFOLIO");
        $scs_link->addContent(new text("PORTFOLIO"));
        $scs_link->addContent(new div());
        
        $lm_wrap->addContent($scs_link);
    }
    
    $scs_link = new url_link("#contact");{
        $scs_link->setTitle("LEAVE ME A MESSAGE");
        $scs_link->addContent(new text("CONTACT"));
        $scs_link->addContent(new div());
        
        $lm_wrap->addContent($scs_link);
    }
    
    $leftmenu_footer = new div();{
        $leftmenu_footer->addClass("leftmenu_footer");
        $leftmenu_footer->addContent($git_link = new url_link(git_link));
            $git_link->addContent(new image("./img/github-mark.png", "Git"));
            $git_link->setTitle("My Github");
            $git_link->setTarget(link_target::NEWPAGE);
            
        $leftmenu_footer->addContent($you_link = new url_link(you_link));
            $you_link->addContent(new image("./img/youtube_social_circle_red.png", "Youtube"));            
            $you_link->setTitle("My youtube channel");
            $you_link->setTarget(link_target::NEWPAGE);

        $left_menu->addContent($leftmenu_footer);
    }
    
//-------------------------------------- main content ----------------------------------------------------------------
    
    $content_container = new div();{
        $page_container->addContent($content_container);
        $content_container->addClass("content_container");
        $content_container->addContent($content_overlay = new div());{
            $content_overlay->setId("conent_overlay");
        }        
        $content_container->addContent($background = new canvas());{
            $background->setId("background");
        }
        
//-------------------------------------- header ------------------------------------------------------------------------
        
        $content_container->addContent($content_header = new div());{
            $content_header->setId("top");
            $content_header->addClass("content_header");
            $content_header->addContent($head_wrap = new div());{
                $head_wrap->addContent($s1 = new span());{
                    $s1->addClass("titletext");
                    $s1->addContent(new text("Welcome&nbsp;to&nbsp;my&nbsp;portfolio"));
                }
                $head_wrap->addContent($s2 = new span());{
                    $s2->addClass("titletext");
                    $s2->addContent(new text("My&nbsp;name&nbsp;is&nbsp;Tamas&nbsp;Varga"));
                }
                $head_wrap->addContent($s3 = new span());{
                    $s3->addClass("titletext");
                    $s3->addContent(new text("I&nbsp;am&nbsp;a&nbsp;webdeveloper"));
                }
            }
        }
        
//------------------------------------------ portfolio ------------------------------------------------------------------
        
        $content_container->addContent($portfolio = new div());{
            $portfolio->setId("portfolio");
            $portfolio->addClass("content");
            
            foreach (content as $name => $content){                
                $portfolio->addContent($$name = new div());{
                    $$name->addClass($name);
                    $span = $name . "_span";
                    $$name->addContent($$span = new span());{
                        $$span->setId($name);
                        $link = $name . "_link";
                        $$span->addContent($$link = new url_link($content["link"]));{
                            $$link->setTitle($content["title"]);
                            $$link->setTarget(link_target::NEWPAGE);
                            $$link->addContent(new text("FIND&nbsp;OUT&nbsp;MORE"));
                        }
                    }
                }
            }
        }
        
//--------------------------------------- contact -------------------------------------------------------------------------
        $content_container->addContent($form_container = new div());{
            $form_container->addClass("contact_form");
            $form_container->addContent($contact_msg = new div());{
                $contact_msg->setId("contact");
                $contact_msg->addClass("contact_message");
                $contact_msg->addContent(new image("./img/getintouch.png", "Get intouch"));
                $contact_msg->addContent($contact_text = new paragraph());{
                    $contact_text->addContent(new text("Please feel free to contact me by telephone or email and I will be sure to get back to you as soon as possible."));                    
                }
                $contact_msg->addContent($tel = new url_link("tel:+447868517309"));{
                    $tel->addContent(new text("07868517309"));
                }
                $contact_msg->addContent(new br());
                $contact_msg->addContent($email = new url_link("mailto:vargatam@yahoo.com"));{
                    $email->addContent(new text("vargatam@yahoo.com"));
                }
            }
            
//------------------------------------------------- form ------------------------------------------------------------------
            
            $form_container->addContent($form = new form());{
                $form->setId("contact_form");
                $form->setMethod(form_method::POST);
                $form->setAction("contact.php");
                //$form->addEvent(form_events::SUBMIT, "validateForm(); return false;");
                $form->autocomplete = false;
                
                $form->addContent($response_container = new div());{
                    $response_container->addClass("response_container");{
                        $response_container->addContent($response_div = new div());{
                            $response_div->setId("resultdiv");
                            $response_div->addClass("resultdiv");
                        }
                        $response_container->addContent(new text("Required fields: *"));
                    }
                }
                $form->addContent($name = new input(form_input_type::TEXT));{
                    $name->setId("name");
                    $name->setName("name");
                    $name->addClass("input");
                    $name->setPlaceholder("Full name *");
                }
                $form->addContent($co = new input(form_input_type::TEXT));{
                    $co->setId("company");
                    $co->setName("company");
                    $co->addClass("input");
                    $co->setPlaceholder("Company");
                }                
                $form->addContent($email = new input(form_input_type::TEXT));{
                    $email->setId("email");
                    $email->setName("email");
                    $email->addClass("input");
                    $email->setPlaceholder("EMail address *");
                }
                $form->addContent($phone = new input(form_input_type::TEL));{
                    $phone->setId("phone");
                    $phone->setName("phone");
                    $phone->addClass("input");
                    $phone->setPlaceholder("Phone number *");
                }
                $form->addContent($selSubject = new select());{
                    $selSubject->setId("subject");
                    $selSubject->setName("subject");
                    $selSubject->addClass("select");
                    $selSubject->required = true;
                    $selSubject->addElement($option0 = new option("", "Select subject... *"));{
                        $option0->select();
                        $option0->disable();
                    }
                    foreach($subjects as $subject){
                        $selSubject->addElement(new option($subject["subject_id"],$subject["subject_text"]));
                    }
                }
                $form->addContent($msg = new textarea());{
                    $msg->setId("msg");
                    $msg->setName("message");
                    $msg->addClass("texta");
                    $msg->setPlaceholder("Enter message... *");
                    $msg->setMinMaxLen(15, 500);
                }
                $form->addContent($submit = new input(form_input_type::SUBMIT));{
                    $submit->setId("submit");
                    $submit->setName("submit");
                    $submit->addClass("submit");
                    $submit->value = "Submit";
                }
                $form->addContent($charcount = new label());{
                    $charcount->setId("charcount");
                    $charcount->addContent(new text("0/500"));
                }
            }
            
//--------------------------------------------- footer ---------------------------------------------------------------------

            $content_container->addContent($footer_container = new div());{
                $footer_container->addClass("content_footer");
                $footer_container->addContent(new text("&copy; Copyright"));
                $footer_container->addContent($social_footer = new div());{
                    $social_footer->addClass("socialmedia_footer");
                    $social_footer->addContent($facebook = new url_link(face_link));{
                        $facebook->setTitle("My personal facebook page");
                        $facebook->setTarget(link_target::NEWPAGE);
                        $facebook->addContent(new image("./img/f_logo_RGB-Blue_58.png", "f"));
                    }
                    $social_footer->addContent($git_link);
                    $social_footer->addContent($you_link);
                }
            }
        }
    }
    
//------------------------------------- render page --------------------------------------------------------------------
    
    $page->Show();
?>