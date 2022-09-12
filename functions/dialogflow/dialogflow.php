<?php
namespace SW\Function;

include_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\Intent_TrainingPhrase_Part;
use Google\Cloud\Dialogflow\V2\Intent_TrainingPhrase;
use Google\Cloud\Dialogflow\V2\Intent_Message_Text;
use Google\Cloud\Dialogflow\V2\Intent_Message;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\Context;
use Google\Cloud\Dialogflow\V2\ContextsClient;

use SW\Function\configs;
class dialogflow {
    
    public function detect_intent_texts($projectId, $text, $sessionId, $languageCode = 'th'){

        $config_func = new configs();
        // new session
        $test = array('credentials' => $_SERVER["DOCUMENT_ROOT"].'/config/dialogflow_key/'.$config_func->dialogflow("serect_key_flie"));
        $sessionsClient = new SessionsClient($test);
        $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

        // create text input
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        // create query input
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        // get response and relevant info
        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();
        $queryText = $queryResult->getQueryText();
        $intent = $queryResult->getIntent();

        $displayName = $intent->getDisplayName();

        $confidence = $queryResult->getIntentDetectionConfidence();
        $fall = $intent->getIsFallback();

        $fulfilmentText = $queryResult->getFulfillmentText();
        $sessionsClient->close();

        //ตรวจว่า dialog เข้าใจหรือไม่
        if($fall == true){
            $return_data = array("status" => "not_confidence", "get_text" => $fulfilmentText, "confidence" => $confidence);
            return $return_data;
        }else{
            $return_data = array("status" => "is_confidence", "get_text" => $fulfilmentText, "confidence" => $confidence);
            return $return_data;
        }
    }

    private function parseOutputContexts($contexts, $project_id, $lifespan = 5){
        $newContexts = array();
 
        foreach ($contexts as $context) {

           $newContexts[] = new Context(
               [
                   'name' => 'projects/' . $project_id . '/agent/sessions/123456/contexts/' . $context,
                   'lifespan_count' => $lifespan
               ]
           );
        }
       
        return $newContexts;
    }

    public function add_intent($Name, $text_input, $text_output){
        $config_func = new configs();

        $test = array('credentials' => $_SERVER["DOCUMENT_ROOT"].'/config/dialogflow_key/'.$config_func->dialogflow("serect_key_flie"));
        $intentsClient = new IntentsClient($test);
        /** Create Intent **/
        $disaplayName = $Name;
        
        // prepare training phrases for intent
        $utterances = ["$text_input"];
        $trainingPhrases = [];
        foreach ($utterances as $trainingPhrasePart) {
        $part = new Intent_TrainingPhrase_Part();
        $part->setText($trainingPhrasePart);
        // create new training phrase for each provided part
        $trainingPhrase = new Intent_TrainingPhrase();
        $trainingPhrase->setParts([$part]);
        $trainingPhrases[] = $trainingPhrase;
        }

        // prepare messages for intent
        $text = new Intent_Message_Text();
        $text->setText([$text_output]);
        $message = new Intent_Message();
        $message->setText($text);
        $createIntentObject = $intentsClient->projectAgentName($config_func->dialogflow("project_id"));
        // prepare intent
        $intent = new Intent();
        $intent->setDisplayName($disaplayName);
        $intent->setTrainingPhrases($trainingPhrases);
        $intent->setMessages([$message]);
        
        // $intent->getOutputContexts('test');
        //dd($intent);
        $response = $intentsClient->createIntent($createIntentObject, $intent);

        $intentsClient->close();
        
        return $response->getName();

    }

    public function remove_intent($name_intent){
        $config_func = new configs();
        $test = array('credentials' => $_SERVER["DOCUMENT_ROOT"].'/config/dialogflow_key/'.$config_func->dialogflow("serect_key_flie"));
        $intentsClient = new IntentsClient($test);
        $intentsClient->deleteIntent($name_intent);
    }
}
?>