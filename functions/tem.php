<?php
namespace SW\Function;

require_once($_SERVER["DOCUMENT_ROOT"].'/functions/config.php');

use SW\Function\configs;

class tem_massage {

    public function tem_register_student ($replyTonken, $background, $profile, $name, $url_project , $class){

      $data = [
        "replyToken" => $replyTonken,
        "messages" => [
            [
              "type" => "flex",
              "altText" => "ยินดีต้อนรับ", 
              "contents" => [
                "type" => "bubble",
                "size" => "giga",
                "body" => [
                    "type" => "box",
                    "layout" => "vertical",
                    "spacing" => "none",
                    "contents" => [
                        [
                            "type" => "image",
                            "url" => $background,
                            "size" => "full",
                            "aspectRatio" => "12:6",
                            "aspectMode" => "cover",
                            "animated" => true,
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "image",
                                    "url" => $profile,
                                    "size" => "full",
                                ],
                            ],
                            "width" => "180px",
                            "height" => "180px",
                            "cornerRadius" => "180px",
                            "position" => "absolute",
                            "offsetStart" => "90px",
                            "offsetTop" => "70px",
                            "borderWidth" => "2px",
                            "borderColor" => "#F5B6FF",
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "spacing" => "xs",
                            "contents" => [
                                [
                                    "type" => "separator",
                                    "margin" => "xs",
                                    "color" => "#000000",
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "baseline",
                                    "contents" => [
                                        [
                                            "type" => "icon",
                                            "url" =>
                                                "https://media-public.canva.com/Kt-FM/MADIT2Kt-FM/2/tl.png",
                                            "offsetTop" => "5px",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ชื่อ - นามสกุล",
                                            "weight" => "bold",
                                            "margin" => "sm",
                                            "flex" => 0,
                                            "color" => "#000000",
                                            "size" => "lg",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $name,
                                            "align" => "end",
                                            "color" => "#000000",
                                            "weight" => "bold",
                                            "size" => "lg",
                                        ],
                                    ],
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "baseline",
                                    "contents" => [
                                        [
                                            "type" => "icon",
                                            "url" =>
                                                "https://media-public.canva.com/AwS70/MAE0wAAwS70/1/tl.png",
                                            "offsetTop" => "6px",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" =>
                                                "นักเรียนระดับชั้น",
                                            "weight" => "bold",
                                            "margin" => "lg",
                                            "flex" => 0,
                                            "color" => "#000000",
                                            "size" => "lg",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ม.".$class,
                                            "align" => "center",
                                            "color" => "#000000",
                                            "weight" => "bold",
                                        ],
                                    ],
                                ],
                                ["type" => "separator", "color" => "#000000"],
                            ],
                            "margin" => "xs",
                            "offsetTop" => "90px",
                        ],
                        [
                            "type" => "text",
                            "text" =>
                                "ยินดีต้องรับสู่ line chatbot for school พัฒนาโดย SW127 Team",
                            "color" => "#000000",
                            "align" => "start",
                            "gravity" => "center",
                            "size" => "sm",
                            "wrap" => true,
                            "margin" => "xl",
                            "offsetTop" => "90px",
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "button",
                                    "style" => "primary",
                                    "color" => "#F5B6FF",
                                    "action" => [
                                        "type" => "uri",
                                        "label" => "Website project 🎉",
                                        "uri" => $url_project,
                                    ],
                                    "height" => "sm",
                                ],
                            ],
                            "maxWidth" => "190px",
                            "offsetStart" => "70px",
                            "margin" => "sm",
                            "spacing" => "xs",
                            "offsetTop" => "105px",
                        ],
                    ],
                    "paddingAll" => "10px",
                    "backgroundColor" => "#C8F7FE",
                    "margin" => "xxl",
                    "height" => "450px",
                ],
              ],
            ],
        ],
    ];

      return json_encode($data);
    }

    public function tem_register_teacher ($replyTonken, $background, $profile, $name, $url_project, $course){

      $data = [
        "replyToken" => $replyTonken,
        "messages" => [
            [
              "type" => "flex",
              "altText" => "ยินดีต้อนรับ", 
              "contents" => [
                "type" => "bubble",
                "size" => "giga",
                "body" => [
                    "type" => "box",
                    "layout" => "vertical",
                    "spacing" => "none",
                    "contents" => [
                        [
                            "type" => "image",
                            "url" => $background,
                            "size" => "full",
                            "aspectRatio" => "12:6",
                            "aspectMode" => "cover",
                            "animated" => true,
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "image",
                                    "url" => $profile,
                                    "size" => "full",
                                ],
                            ],
                            "width" => "180px",
                            "height" => "180px",
                            "cornerRadius" => "180px",
                            "position" => "absolute",
                            "offsetStart" => "90px",
                            "offsetTop" => "70px",
                            "borderWidth" => "2px",
                            "borderColor" => "#F5B6FF",
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "spacing" => "xs",
                            "contents" => [
                                [
                                    "type" => "separator",
                                    "margin" => "xs",
                                    "color" => "#000000",
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "baseline",
                                    "contents" => [
                                        [
                                            "type" => "icon",
                                            "url" =>
                                                "https://media-public.canva.com/Kt-FM/MADIT2Kt-FM/2/tl.png",
                                            "offsetTop" => "5px",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => "ชื่อ - นามสกุล",
                                            "weight" => "bold",
                                            "margin" => "sm",
                                            "flex" => 0,
                                            "color" => "#000000",
                                            "size" => "lg",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $name,
                                            "align" => "end",
                                            "color" => "#000000",
                                            "weight" => "bold",
                                            "size" => "lg",
                                        ],
                                    ],
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "baseline",
                                    "contents" => [
                                        [
                                            "type" => "icon",
                                            "url" =>
                                                "https://media-public.canva.com/AwS70/MAE0wAAwS70/1/tl.png",
                                            "offsetTop" => "6px",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" =>
                                                "เป็นครูกลุ่มสาระการเรียนรู้",
                                            "weight" => "bold",
                                            "margin" => "lg",
                                            "flex" => 0,
                                            "color" => "#000000",
                                            "size" => "lg",
                                        ],
                                        [
                                            "type" => "text",
                                            "text" => $course,
                                            "align" => "center",
                                            "color" => "#000000",
                                            "weight" => "bold",
                                        ],
                                    ],
                                ],
                                ["type" => "separator", "color" => "#000000"],
                            ],
                            "margin" => "xs",
                            "offsetTop" => "90px",
                        ],
                        [
                            "type" => "text",
                            "text" =>
                                "ยินดีต้องรับสู่ line chatbot for school พัฒนาโดย SW127 Team",
                            "color" => "#000000",
                            "align" => "start",
                            "gravity" => "center",
                            "size" => "sm",
                            "wrap" => true,
                            "margin" => "xl",
                            "offsetTop" => "90px",
                        ],
                        [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "button",
                                    "style" => "primary",
                                    "color" => "#F5B6FF",
                                    "action" => [
                                        "type" => "uri",
                                        "label" => "Website project 🎉",
                                        "uri" => $url_project,
                                    ],
                                    "height" => "sm",
                                ],
                            ],
                            "maxWidth" => "190px",
                            "offsetStart" => "70px",
                            "margin" => "sm",
                            "spacing" => "xs",
                            "offsetTop" => "105px",
                        ],
                    ],
                    "paddingAll" => "10px",
                    "backgroundColor" => "#C8F7FE",
                    "margin" => "xxl",
                    "height" => "450px",
                ],
              ],
            ],
        ],
    ];

      return json_encode($data);
    }

    public function generate_board($data){
        
        $config_func = new configs();
        $name_url = $config_func->line_liff("board");

        $array = [];
        $array['type'] = "carousel";

        $i = 0;
        foreach($data as $list){

            $array['contents'][$i]["type"] = "bubble";
            $array['contents'][$i]["size"] = "mega";

            $array['contents'][$i]["hero"]["type"] = "image";
            $array['contents'][$i]["hero"]["url"] = $config_func->domain().$list['banner_course'];
            $array['contents'][$i]["hero"]["size"] = "full";
            $array['contents'][$i]["hero"]["aspectRatio"] = "16:9";
            $array['contents'][$i]["hero"]["aspectMode"] = "cover";

            $array['contents'][$i]["body"]["type"] = "box";
            $array['contents'][$i]["body"]["layout"] = "vertical";

            $array['contents'][$i]["body"]["contents"][0]["type"] = "text";
            $array['contents'][$i]["body"]["contents"][0]["text"] = $list['name_course'];
            $array['contents'][$i]["body"]["contents"][0]["weight"] = 'bold';
            $array['contents'][$i]["body"]["contents"][0]["size"] = 'xl';

            $array['contents'][$i]["body"]["contents"][1]["type"] = "box";
            $array['contents'][$i]["body"]["contents"][1]["layout"] = "vertical";
            $array['contents'][$i]["body"]["contents"][1]["margin"] = 'lg';
            $array['contents'][$i]["body"]["contents"][1]["spacing"] = 'sm';
            $array['contents'][$i]["body"]["contents"][1]["contents"][0]["type"] = 'text';
            $array['contents'][$i]["body"]["contents"][1]["contents"][0]["text"] = $list['about_course'];

            $array['contents'][$i]["footer"]["type"] = "box";
            $array['contents'][$i]["footer"]["layout"] = "vertical";
            $array['contents'][$i]["footer"]["spacing"] = "sm";

            $array['contents'][$i]["footer"]["contents"][0]["type"] = "button";
            $array['contents'][$i]["footer"]["contents"][0]["style"] = "primary";
            $array['contents'][$i]["footer"]["contents"][0]["height"] = "md";

            $array['contents'][$i]["footer"]["contents"][0]["action"]["type"] = "uri";
            $array['contents'][$i]["footer"]["contents"][0]["action"]["label"] = "ข้อมูลเพิ่มเติม";
            $array['contents'][$i]["footer"]["contents"][0]["action"]["uri"] ="$name_url?type=student&subject=".$list['course']."&timestamp=".strtotime("now");

            $array['contents'][$i]["footer"]["contents"][1]["type"] = "box";
            $array['contents'][$i]["footer"]["contents"][1]["layout"] = "vertical";
            $array['contents'][$i]["footer"]["contents"][1]["contents"] = [];
            $array['contents'][$i]["footer"]["contents"][1]["margin"] = 'sm';

            $array['contents'][$i]["footer"]['flex'] = 0;

            $i += 1;
        }

        return $array;
    }

    public function generate_media($data, $grade, $class){
        
        $config_func = new configs();
        $name_url = $config_func->line_liff("media");

        $array = [];
        $array['type'] = "carousel";

        $i = 0;
        foreach($data as $list){

            $array['contents'][$i]["type"] = "bubble";
            $array['contents'][$i]["size"] = "mega";

            $array['contents'][$i]["hero"]["type"] = "image";
            $array['contents'][$i]["hero"]["url"] = $config_func->domain().$list['banner_course'];
            $array['contents'][$i]["hero"]["size"] = "full";
            $array['contents'][$i]["hero"]["aspectRatio"] = "16:9";
            $array['contents'][$i]["hero"]["aspectMode"] = "cover";

            $array['contents'][$i]["body"]["type"] = "box";
            $array['contents'][$i]["body"]["layout"] = "vertical";

            $array['contents'][$i]["body"]["contents"][0]["type"] = "text";
            $array['contents'][$i]["body"]["contents"][0]["text"] = $list['name_course'];
            $array['contents'][$i]["body"]["contents"][0]["weight"] = 'bold';
            $array['contents'][$i]["body"]["contents"][0]["size"] = 'xl';

            $array['contents'][$i]["body"]["contents"][1]["type"] = "box";
            $array['contents'][$i]["body"]["contents"][1]["layout"] = "vertical";
            $array['contents'][$i]["body"]["contents"][1]["margin"] = 'lg';
            $array['contents'][$i]["body"]["contents"][1]["spacing"] = 'sm';
            $array['contents'][$i]["body"]["contents"][1]["contents"][0]["type"] = 'text';
            $array['contents'][$i]["body"]["contents"][1]["contents"][0]["text"] = $list['about_course'];

            $array['contents'][$i]["footer"]["type"] = "box";
            $array['contents'][$i]["footer"]["layout"] = "vertical";
            $array['contents'][$i]["footer"]["spacing"] = "sm";

            $array['contents'][$i]["footer"]["contents"][0]["type"] = "button";
            $array['contents'][$i]["footer"]["contents"][0]["style"] = "primary";
            $array['contents'][$i]["footer"]["contents"][0]["height"] = "md";

            $array['contents'][$i]["footer"]["contents"][0]["action"]["type"] = "uri";
            $array['contents'][$i]["footer"]["contents"][0]["action"]["label"] = "ดูสื่อการสอน";
            $array['contents'][$i]["footer"]["contents"][0]["action"]["uri"] ="$name_url?type=student&subject=".$list['course']."&grade=".$grade."&class=".$class."&timestamp=".strtotime("now");

            $array['contents'][$i]["footer"]["contents"][1]["type"] = "box";
            $array['contents'][$i]["footer"]["contents"][1]["layout"] = "vertical";
            $array['contents'][$i]["footer"]["contents"][1]["contents"] = [];
            $array['contents'][$i]["footer"]["contents"][1]["margin"] = 'sm';

            $array['contents'][$i]["footer"]['flex'] = 0;

            $i += 1;
        }

        return $array;
    }

    public function teacher_board($replyToken, $course){

        $config_func = new configs();

        $data = [
            "replyToken" => $replyToken,
            "messages" => [
                [
                    "type" => "imagemap",
                    "baseUrl" => $config_func->image_template("teacher_board"),
                    "altText" => "เมนู ข่าวประชาสัมพันธ์",
                    "baseSize" => ["width" => 1040, "height" => 701],
                    "actions" => [
                        [
                            "type" => "message",
                            "area" => [
                                "x" => 47,
                                "y" => 73,
                                "width" => 417,
                                "height" => 538,
                            ],
                            "text" => "ดูข่าวประชาสัมพันธ์สำหรับครู",
                        ],
                        [
                            "type" => "uri",
                            "area" => [
                                "x" => 574,
                                "y" => 73,
                                "width" => 417,
                                "height" => 540,
                            ],
                            "linkUri" =>
                                "https://liff.line.me/1657429942-9NqWgW4a?type=teacher&subject=".$course."&timestamp=".strtotime("now"),
                        ],
                    ],
                ],
            ],
        ];

        return $data;
    }

    public function teacher_media($replyToken, $course, $line_userid){
        $config_func = new configs();

        $data = [
            "replyToken" => $replyToken,
            "messages" => [
                [
                    "type" => "imagemap",
                    "baseUrl" => $config_func->image_template("teacher_media"),
                    "altText" => "เมนูสื่อการสอนสำหรับครู",
                    "baseSize" => ["width" => 1040, "height" => 701],
                    "actions" => [
                        [
                            "type" => "uri",
                            "area" => [
                                "x" => 47,
                                "y" => 73,
                                "width" => 416,
                                "height" => 546,
                            ],
                            "linkUri" =>
                                "https://liff.line.me/1657429942-BxZMoMgJ?type=teacher&line_id=".$line_userid."&timestamp=".strtotime("now"),
                        ],
                        [
                            "type" => "uri",
                            "area" => [
                                "x" => 575,
                                "y" => 76,
                                "width" => 416,
                                "height" => 541,
                            ],
                            "linkUri" =>
                                "https://liff.line.me/1657429942-BxZMoMgJ?type=teacher_post&subject=".$course."&timestamp=".strtotime("now"),
                        ],
                    ],
                ],
            ],
        ];

        return $data;
    }
}
?>