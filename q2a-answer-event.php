<?php
/**
 * Created by PhpStorm.
 * User: Sshucchi
 * Date: 01/05/2017
 * Time: 13:19
 */
class q2a_answer_event{

    function process_event($event, $userid, $handle, $cookieid, $params) {
        require_once QA_INCLUDE_DIR.'app/users.php';
        if($event=='a_post'){
            if(qa_get_logged_in_level()>=QA_USER_LEVEL_EXPERT){
                define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/php-graph-sdk/src/Facebook/');
                require_once(FACEBOOK_SDK_V4_SRC_DIR.'autoload.php');
                $fb = new Facebook\Facebook([
                    'app_id' => qa_opt('facebook_app_id'),
                    'app_secret' => qa_opt('facebook_app_secret'),
                    'default_graph_version' => 'v2.9',
                ]);
                $pageAccessToken =qa_opt('fb_page_access_token');

                $title = $params['parent']['title'];
                $body = $params['parent']['content'];
                $handle = $params['parent']['handle'];
                $answer = $params['content'];
                $postId = $params['parentid'];
                $message = str_replace('^1',$handle,qa_lang_html('plugin_answer_sharing/question_from'));
                //$message.=str_replace('^1',qa_get_logged_in_handle(),qa_lang_html('plugin_answer_sharing/answer_from'));
                //$message.='"'.substr($answer,0,100).'..." ↓↓↓';
                $message=$body;

                $link = qa_opt('site_url').$postId;

                $linkData = [
                    'link' => $link,
                    'message' => $message
                    /*
                    "picture" => "https://i.imgur.com/OzWgkf9.jpg",
                    "name" => $title,
                    "caption" => qa_opt('site_title'),
                    "description" => $body
                    */
                ];

                try {
                    $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returnfed an error: '.$e->getMessage();
                    exit;
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: '.$e->getMessage();
                    exit;
                }
                $graphNode = $response->getGraphNode();
            }
        }
        else{

        }
    }
    function admin_form(&$qa_content)
    {

        // Process form input

        $ok = null;

        if (qa_clicked('fb_share_save')) {
            qa_opt('facebook_app_id', qa_post_text('facebook_app_id'));
            qa_opt('facebook_app_secret', qa_post_text('facebook_app_secret'));
            qa_opt('fb_page_access_token', qa_post_text('fb_page_access_token'));

            $ok = qa_lang('admin/options_saved');
        }


        // Create the form for display


        $fields = array();

        $fields[] = array(
            'label' => 'Facebook App id',
            'tags' => 'NAME="facebook_app_id"',
            'value' => qa_opt('facebook_app_id'),
            'type' => 'text');

        $fields[]= array(
            'label' => 'Facebook App secret',
            'tags' => 'NAME="facebook_app_secret"',
            'value' => qa_opt('facebook_app_secret'),
            'type' => 'text',
        );

        $fields[]= array(
            'label' => 'Facebook Page Permanent token',
            'tags' => 'NAME="fb_page_access_token"',
            'value' => qa_opt('fb_page_access_token'),
            'type' => 'text',
        );

        return array(
            'ok' => ($ok && !isset($error)) ? $ok : null,

            'fields' => $fields,

            'buttons' => array(
                array(
                    'label' => qa_lang_html('main/save_button'),
                    'tags' => 'NAME="fb_share_save"',
                ),
            ),
        );
    }
}