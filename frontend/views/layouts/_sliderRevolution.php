<?php
use webcreator\revslider\Widget as Slider;

    Slider::begin([
        "clientOptions" => [
            "delay" => 9000,
            "startwidth"  => 1170,
            "startheight" => 250,
            "fullWidth"   => "on",
            "fullScreen"  => "off",
            "hideCaptionAtLimit" => "",
            "dottedOverlay" => "twoxtwo",
            //"navigationStyle" => "preview4",
            "fullScreenOffsetContainer" => "",
            "hideTimerBar" => "on"
        ],
        "items" => [[
            "id" => 1,
            "title" => "Slide title",
            "bgImg" => yii::getAlias('@sliderImagesWeb').'/1.png',
            "bgImgTitle" => "Alt title for background image",
            "masterspeed" => 2000,
            "enabled" => 1,
            "transition" => "slidehorizontal",
            "slotamount" => 5,
            "slides" => [[
                "enabled" => 1,
                "slideNumber" => 1,
                "options" => [
                    //"img" => yii::getAlias('@sliderImagesWeb').'/1.png',
                    "imgTitle" => "Alt title for image"
                ],
                "data" => [
                    "hoffset" => 0,
                    "x" => 600,
                    "y" => 54,
                    "speed" => 800,
                    "start" => 1100,
                    "easing" => "Back.easeInOut",
                    "endeasing" => 300,
                    "endspeed" => 300
                ],
            ],
            [
                "slideNumber" => 2,
                "enabled" => 1,
                "options" => ["title" => "Title","subtitle" => "Subtitle"],
                "data" => [
                    "hoffset" => 0,
                    "y" => 54,
                    "speed" => 800,
                    "start" => 1200,
                    "easing" => "Back.easeInOut",
                    "endspeed" => 300
                ],
            ],
            [
                    "slideNumber" => 3,
                    "options" => [
                        "title" => "Title"
                    ],
                    "data" => [
                        "hoffset" => 0,
                        "y" => 380,
                        "speed" => 800,
                        "start" => 1300,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 4,
                    "options" => [
                        "link" => "link to page"
                    ],
                    "data" => [
                        "hoffset" => 0,
                        "y" => 420,
                        "speed" => 800,
                        "start" => 1400,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ]
            ]
        ],
        [
            "id" => 2,
            "title" => "Slide title",
            "bgImg" => yii::getAlias('@sliderImagesWeb').'/2.png',
            "bgImgTitle" => "Alt title for background image",
            "masterspeed" => 2000,
            "enabled" => 1,
            "transition" => "slidehorizontal",
            "slotamount" => 5,
            "slides" => [
                [
                    "slideNumber" => 1,
                    "options" => [
                        "img" => "path to image",
                        "imgTitle" => "Alt title for image"
                    ],
                    "data" => [
                        "x" => 0,
                        "y" => 54,
                        "speed" => 800,
                        "start" => 1100,
                        "easing" => "Back.easeInOut",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 2,
                    "options" => [
                        "title" => "Title",
                    ],
                    "data" => [
                        "x" => 410,
                        "y" => 54,
                        "speed" => 800,
                        "start" => 1200,
                        "easing" => "Back.easeInOut",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 3,
                    "options" => [
                        "title" => "Title",
                        "subtitle" => "Subtitle"
                    ],
                    "data" => [
                        "x" => 410,
                        "y" => 100,
                        "speed" => 800,
                        "start" => 1300,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 4,
                    "options" => [
                        "link" => "link to page"
                    ],
                    "data" => [
                        "x" => 860,
                        "y" => 400,
                        "speed" => 800,
                        "start" => 1400,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ]
            ]
        ],
        [
            "id" => 3,
            "title" => "Slide title",
            "bgImg" => "path to background image",
            "bgImgTitle" => "Alt title for background image",
            "masterspeed" => 2000,
            "enabled" => 1,
            "transition" => "slidehorizontal",
            "slotamount" => 5,
            "slides" => [
                [
                    "slideNumber" => 1,
                    "options" => [
                        "img" => yii::getAlias('@sliderImagesWeb').'/1.png',
                        "imgTitle" => "alt image title"
                    ],
                    "data" => [
                        "x" => 0,
                        "y" => 54,
                        "speed" => 800,
                        "start" => 1100,
                        "easing" => "Back.easeInOut",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 2,
                    "options" => [
                        "title" => "Title",
                        "subtitle" => "Subtitle"
                    ],
                    "data" => [
                        "hoffset" => 0,
                        "x" => 410,
                        "y" => 54,
                        "speed" => 800,
                        "start" => 1200,
                        "easing" => "Back.easeInOut",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 3,
                    "options" => [
                        "title" => "Title",
                    ],
                    "data" => [
                        "hoffset" => 0,
                        "x" => 410,
                        "y" => 300,
                        "speed" => 800,
                        "start" => 1300,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ],
                [
                    "slideNumber" => 4,
                    "options" => [
                        "link" => "link to page"
                    ],
                    "data" => [
                        "x" => 800,
                        "y" => 360,
                        "speed" => 800,
                        "start" => 1400,
                        "easing" => "Power4.easeInOut",
                        "endeasing" => "Power1.easeIn",
                        "captionHidden" => "off",
                        "endspeed" => 300
                    ],
                    "enabled" => 1
                ]
            ]
        ]
    ]
]);
Slider::end();
?>
