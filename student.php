<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sam
 * Date: 10/23/15
 * Time: 22:02
 */

if (!function_exists('checkForceQuit')){
    die("You are detected as an unexpected intruder.");
}else{
    checkForceQuit();
}

?>
<!DOCTYPE HTML>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SAM, System of Assignment Management">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?> - Student</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <script src="/framework/js/jq.js"></script>
    <script src="/framework/js/form.js"></script>
    <script src="/framework/js/masonry.js"></script>
    <script src="/framework/js/material.js"></script>
    <style>
        <?php
            require $_SERVER['DOCUMENT_ROOT']."/framework/material/material.min.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/material/material-dashboard-styles.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/geodesic/base.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/geodesic/settings.css";
        ?>
        /*
            Desktop: 840px
            Tablet: 480px
        */
        @media (min-width: 840px){
            #percentageRings{
                position: fixed;
                top: 64px;
                right: 0px;
                height: calc(100% - 48px);
                height: -moz-calc(100% - 48px);
                height: -webkit-calc(100% - 48px);
                width: 200px;
                margin: 0;
            }
            #personalInfoPanel{
                position: fixed;
                top: 56px;
                right: 0px;
                height: calc(100% - 40px);
                width: 500px;
                margin: 0;
                overflow: scroll;
            }
            #todaySVG, #totalSVG{
                display: block;
                width: 100%;
            }
            #assignment-list-wrapper{
                width: calc(100% - 200px);
                width: -moz-calc(100% - 200px);
                width: -webkit-calc(100% - 200px);
            }
            #college-list{
                width: 100%;
            }
        }
        @media (max-width: 840px){
            #percentageRings{
                width: calc(100% - 0.1px);
                width: -moz-calc(100% - 0.1px);
                width: -webkit-calc(100% - 0.1px);
                margin: 0;
                height: auto;
                position: static;
            }
            #personalInfoPanel{
                position: fixed;
                top: 56px;
                right: 0px;
                height: calc(100% - 40px);
                width: calc(100% - 0.1px);
                width: -moz-calc(100% - 0.1px);
                width: -webkit-calc(100% - 0.1px);
                margin: 0;
                overflow: scroll;
            }
            #todaySVG, #totalSVG{
                width: 120px;
                height: 120px;
            }
            #assignment-list-wrapper, #activity-list-wrapper, #college-list{
                width: 100%;
            }
        }
        @media (min-width: 700px){
            .two-adjacent-pile{
                display: table-cell; width: 48%
            }
            #assignment-list-class{
                display: table; width: 100%
            }
        }
        #assignment-list, #assignment-list-class, #activity-list, #activity-comment-list{
            margin: 0 auto;
        }
    </style>
</head>
<script>
    function toggleModules(id){
        $('#right-part').hide();
        $('#mHome').hide();
        $('#left-tab-Home').css("background","").css("color","#eceff1");
        $('#mClasses').hide();
        $('#left-tab-Classes').css("background","").css("color","#eceff1");
        $('#mActivities').hide();
        $('#left-tab-Activities').css("background","").css("color","#eceff1");
        $('#mColleges').hide();
        $('#left-tab-Colleges').css("background","").css("color","#eceff1");
        $('#mPresentations').hide();
        $('#left-tab-Presentations').css("background","").css("color","#eceff1");
        $('#mSettings').hide();
        $('#left-tab-Settings').css("background","").css("color","#eceff1");
        $('#m'+id).show();
        $('#left-tab-'+id).css("background","#00BCD4").css("color","#37474F");
        $('#title').html(id);
        $('.demo-drawer').removeClass("is-visible");
    }
    <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/UID.php";
    ?>

    <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/base.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/floatBox.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/class.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/settings.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/waterfall.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/assignment.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/activity.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/college.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/presentation.js";
    ?>
</script>
<body>
<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <span id="title" class="mdl-layout-title">Home</span>
        </div>
    </header>
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="/framework/material-images/user.png" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span style="display: block; margin-top: 0.5em"><?= $username ?></span>
            </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
            <a id="left-tab-Home" onclick="toggleModules('Home')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Assignments</a>
            <a id="left-tab-Classes" onclick="toggleModules('Classes')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">folder</i>Classes</a>
            <a id="left-tab-Colleges" onclick="toggleModules('Colleges')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">school</i>CollegeChoice</a>
            <!--
            <a id="left-tab-Activities" onclick="toggleModules('Activities')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Activities</a>
            -->
            <a id="left-tab-Presentations" onclick="toggleModules('Presentations')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">message</i>Presentations</a>
            <a id="left-tab-Settings" onclick="toggleModules('Settings')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Settings</a>
        </nav>
    </div>
    <main class="mdl-layout__content mdl-color--grey-100">
        <div id="loading" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="left: 240px;top: 30px;width: 100%;height: auto;"></div>
        <div id="mHome">
            <div id="percentageRings" class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <svg id="todaySVG" fill="currentColor" width="150px" height="150px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop" style="margin: 1em auto; position: relative">
                    <use xlink:href="#todayCircleChart" mask="url(#piemask)" />
                    <text x="0.5" y="0.55" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">
                        <tspan dy="0" font-size="0.3" id="todayPercentage">0</tspan><tspan dy="-0.09" font-size="0.15">%</tspan>
                    </text>
                    <text x="0.5" y="0.65" font-size="0.1" fill="#888" text-anchor="middle" dy="0.1">
                        <tspan dy="0" font-size="0.1" id="todayItemsDone">0</tspan><tspan dy="0" font-size="0.08"> OUT OF </tspan><tspan dy="0" font-size="0.1" id="todayTotalItems">0</tspan>
                    </text>
                    <text x="0.5" y="0.75" font-size="0.1" fill="#888" text-anchor="middle" dy="0.1">TODAY</text>
                </svg>
                <svg id="totalSVG" fill="currentColor" width="150px" height="150px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop" style="margin: 1em auto; position: relative">
                    <use xlink:href="#totalCircleChart" mask="url(#piemask)" />
                    <text x="0.5" y="0.55" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">
                        <tspan dy="0" font-size="0.3" id="totalPercentage">0</tspan><tspan dy="-0.09" font-size="0.15">%</tspan>
                    </text>
                    <text x="0.5" y="0.65" font-size="0.1" fill="#888" text-anchor="middle" dy="0.1">
                        <tspan dy="0" font-size="0.1" id="totalItemsDone">0</tspan><tspan dy="0" font-size="0.08"> OUT OF </tspan><tspan dy="0" font-size="0.1" id="totalTotalItems">0</tspan>
                    </text>
                    <text x="0.5" y="0.75" font-size="0.1" fill="#888" text-anchor="middle" dy="0.1">ALL</text>
                </svg>
            </div>
            <div id="assignment-list-wrapper">
                <div id="assignment-list"></div>
            </div>
        </div>
        <div id="mClasses">
            <div id="classList" class="mdl-grid demo-content"></div>
        </div>
        <div id="mColleges" style="position: relative;">
            <div id="personalInfoPanel" class="mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid" style="background: #EAEAEA; display: none; z-index: 5000; box-shadow: -3px 0px 3px rgba(40,40,40,0.3);">
                <div class="demo-cards" style="width: 100%; margin: 0px; position: relative">
                    <div class="demo-updates mdl-card mdl-shadow--2dp" style="margin: 0; width: 100%; position: absolute;">
                        <div class="mdl-card__title mdl-card--expand mdl-color--green-300" style="position: relative">
                            <h2 class="mdl-card__title-text"><span class="material-icons">help</span> About Scores</h2>
                        </div>
                        <div class="mdl-card__supporting-text mdl-color-text--grey-600" style="overflow: visible">
                                <div style="line-height: 1.5;" id="assignment-list-content-744">
                                <div>
                                    You may choose to report your scores here. It is not mandatory.
                                </div>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-color-text--grey-600" style="overflow: visible">
                            <div>IB Score (in 42)</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-ibScore" name="ibScore" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-ibScore">Your IB Score</label>
                            </div>
                            <div>SAT (in 2400)</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-satScore" name="satScore" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-satScore">Your SAT Score</label>
                            </div>
                            <div>ACT (in 36)</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-actScore" name="actScore" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-actScore">Your ACT Score</label>
                            </div>
                            <div>TOEFL (in 120)</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-toeflScore" name="toeflScore" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-toeflScore">Your TOEFL Score</label>
                            </div>
                            <div>IELTS (in 9)</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-ieltsScore" name="ieltsScore" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-ieltsScore">Your IETLS Score</label>
                            </div>
                            <div>Number of awards</div>
                            <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                <input class="mdl-textfield__input" style="background: white" type="text" id="personal-info-numberOfAwards" name="numberOfAwards" value="0"/>
                                <label class="mdl-textfield__label" for="personal-info-numberOfAwards">Number of awards you received</label>
                            </div>
                            <div style="text-align: center">
                                <input type="submit" value="Submit" id="submit_btn_personal_info" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" onclick="new ManipulateCollege().updateScores()"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="college-list"></div>
            <button id="add-activity-button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--pink-300" style="position: fixed; right: 1em; bottom: 1em; z-index:5001" onclick="new ManipulateCollege().togglePersonalInfoPanel()">
                <i class="material-icons" id="personalInfoPanelTogglerButton">add</i>
            </button>
        </div>
        <div id="mActivities">
            <button id="add-activity-button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--pink-300" style="position: fixed; right: 1em; bottom: 1em; z-index:100" onclick="new ManipulateActivity().addActivityButtonClick()">
                <i class="material-icons">add</i>
            </button>
            <div id="activity-list-wrapper">
                <div id="activity-list" class="mdl-grid demo-content"></div>
            </div>
        </div>
        <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/pages/presentations.html";
        ?>
        <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/pages/settings.html";
        ?>
    </main>
    <div id="right-part" class="mdl-layout--fixed-header" style="display:none">
        <div id="right-part-view-class" style="display: none;">
            <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600" style="display: flex">
                <div class="mdl-layout__header-row" style="padding-left: 1em; cursor: pointer" onclick="$('#right-part').hide()">
                        <span class="mdl-layout-title" style="display: flex; flex-direction: row">
                            <span class="material-icons" style="display: flex">close</span>
                            <span id="right-part-title" style="display: flex">Manage Class</span>
                        </span>
                </div>
            </header>
            <div id="assignment-list-class">
                <div id="assignment-list-class-assignment-pile" class="two-adjacent-pile"></div>
                <div id="assignment-list-class-information-pile" class="two-adjacent-pile"></div>
            </div>
        </div>
        <div id="right-part-view-activity" style="display: none">
            <div id="right-part-view-activity-id" style="display: none;"></div>
            <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600" style="display: flex">
                <div class="mdl-layout__header-row" style="padding-left: 1em; cursor: pointer" onclick="$('#right-part').hide()">
                        <span class="mdl-layout-title" style="display: flex; flex-direction: row">
                            <span class="material-icons" style="display: flex">close</span>
                            <span style="display: flex">Discussion</span>
                        </span>
                </div>
            </header>
            <button id="add-activity-comment-button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--pink-300" style="position: fixed; right: 1em; bottom: 1em; z-index:100" onclick="new ManipulateActivity().addActivityCommentButtonClick()">
                <i class="material-icons">add</i>
            </button>
            <div id="activity-comment-list"></div>
        </div>
    </div>
    <?php
    require $_SERVER['DOCUMENT_ROOT']."/template/pages/floatBoxWrapperStart.html";
    ?>
    <div id="floatBox-content">
        <div id="floatBox-add-activity">
            <form id="submit_form_add_activity" action='/modules/activity/addActivity.php' method="post" enctype="multipart/form-data">
                <div style="display: table; width: 100%; border-top: 1px solid #CCC">
                    <div style="display: table-cell; min-width: 70px; max-width: 70px; vertical-align: middle">Name</div>
                    <div class="mdl-textfield mdl-js-textfield" style="display: table-cell; vertical-align: middle">
                        <input class="mdl-textfield__input" style="background: white" type="text" id="add-activity-form-name" name="name" />
                        <label class="mdl-textfield__label" for="add-activity-form-name">Name your activity</label>
                    </div>
                </div>
                <div style="display: table; width: 100%; border-top: 1px solid #CCC">
                    <div style="display: table-cell; min-width: 70px; max-width: 70px; vertical-align: middle">Benefit</div>
                    <div class="mdl-textfield mdl-js-textfield" style="display: table-cell; vertical-align: middle">
                        <input class="mdl-textfield__input" style="background: white" type="text" id="add-activity-form-deal" name="deal" />
                        <label class="mdl-textfield__label" for="add-activity-form-deal">What can others get?</label>
                    </div>
                </div>
                <div style="border-top: 1px solid #CCC">Description</div>
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%">
                    <textarea class="mdl-textfield__input" style="background: white" type="text" rows="4" id="add-activity-form-description" name="description" ></textarea>
                    <label class="mdl-textfield__label" for="add-activity-form-description">Input the description for the activity</label>
                </div>
                <div style="border-top: 1px solid #CCC">
                    <div style="display:inline-block">Add attachment (optional)</div>
                    <button id="add-activity-form-file-button-1" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5">Add More Files</button>
                </div>
                <div class="mdl-textfield mdl-js-textfield" style='display: block; padding: 10px 0; width: 100%'>
                    <div id="add-activity-form-file-input-list">
                        <input class="mdl-textfield__input" style="background: white" id="add-activity-form-file" name="attachment[]" type="file" multiple />
                    </div>
                    <label class="mdl-textfield__label" for="add-activity-form-file"></label>
                </div>
                <progress id='progress_activity_1' value="0" max='100' style="width: 100%; display: none"></progress>
                <div style="text-align: center; margin-top: 1em">
                    <input type="submit" value="Submit" id="submit_btn_add_activity" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" />
                </div>
            </form>
        </div>
        <div id="floatBox-add-activity-comment">
            <form id="submit_form_add_activityComment" action='/modules/activity/addActivityComment.php' method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="add-activityComment-form-id" />
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%">
                    <textarea class="mdl-textfield__input" style="background: white" type="text" rows="4" id="add-activityComment-form-comment" name="comment" ></textarea>
                    <label class="mdl-textfield__label" for="add-activityComment-form-comment">Input your comment</label>
                </div>
                <div style="border-top: 1px solid #CCC">
                    <div style="display:inline-block">Add attachment (optional)</div>
                    <button id="add-activityComment-form-file-button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5">Add More Files</button>
                </div>
                <div class="mdl-textfield mdl-js-textfield" style='display: block; padding: 10px 0; width: 100%'>
                    <div id="add-activityComment-form-file-input-list">
                        <input class="mdl-textfield__input" style="background: white" id="add-activityComment-form-file" name="attachment[]" type="file" multiple />
                    </div>
                    <label class="mdl-textfield__label" for="add-activity-form-file"></label>
                </div>
                <progress id='progress_activity_2' value="0" max='100' style="width: 100%; display: none"></progress>
                <div style="text-align: center; margin-top: 1em">
                    <input type="submit" value="Submit" id="submit_btn_add_activityComment" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" />
                </div>
            </form>
        </div>
        <div id="floatBox-view-activity-members">
            <div id="floatBox-view-activity-members-list"></div>
        </div>
    </div>
    <?php
    require $_SERVER['DOCUMENT_ROOT']."/template/pages/floatBoxWrapperEnd.html";
    ?>
</div>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
    <defs>
        <mask id="piemask" maskContentUnits="objectBoundingBox">
            <circle cx=0.5 cy=0.5 r=0.49 fill="white" />
            <circle cx=0.5 cy=0.5 r=0.40 fill="black" />
        </mask>
        <g id="todayCircleChart">
            <circle cx=0.5 cy=0.5 r=0.5 />
            <path id="todayCircle" d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 1 1 0.5 0 z" stroke="none" fill="rgba(255, 255, 255, 0.75)" />
        </g>
        <g id="totalCircleChart">
            <circle cx=0.5 cy=0.5 r=0.5 />
            <path id="totalCircle" d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 1 1 0.5 0 z" stroke="none" fill="rgba(255, 255, 255, 0.75)" />
        </g>
    </defs>
</svg>
</body>
</html>
<script>
    var featureList = ["add-activity", "add-activity-comment", "view-activity-members"];
    var floatBox = new FloatBox(featureList);

    function loadAssignment(func){
        $.get("/modules/assignment/studentLoadAssignment.php",function(data){
            func();

            data = JSON.parse(data);

            var todayDoneTime = 0, todayTotalTime = 0, totalDoneTime = 0, totalTotalTime = 0;
            var todayDoneItems = 0, todayTotalItems = 0, totalDoneItems = 0, totalTotalItems = 0;

            for (var i = 0; i < data.length; i++){
                var row = data[i];
                var subject = convertSubject(row.subject);
                if (row.type == "1"){
                    var date = row.dueday;
                    var daysLeft = DateDiff.inDays(new Date(), new Date(date));
                    var singleTime = parseFloat(parseFloat(row.duration).toFixed(1));
                    if (daysLeft == 1){
                        if (row.finished == true){
                            todayDoneTime += singleTime;
                            todayDoneItems++;
                        }
                        todayTotalTime += singleTime;
                        todayTotalItems++;
                    }
                    if (row.finished == true){
                        totalDoneTime += singleTime;
                        totalDoneItems++;
                    }
                    totalTotalTime += singleTime;
                    totalTotalItems++;
                }
                var assignment = new Assignment("student", row.id, row.type, row.content, row.attachment, row.publish, row.dueday, subject, row.duration, row.finished);
                $('#assignment-list').append(assignment.getHTML());
            }

            if (todayTotalTime == 0){
                todayDoneTime = 1;
                todayTotalTime = 1;
            }
            if (totalTotalTime == 0){
                totalDoneTime = 1;
                totalTotalTime = 1;
            }

            function ProcessPercentage(percentage){
                if (percentage < 0.01){
                    return 0.001;
                }
                return percentage;
            }

            var todayPercentage = ProcessPercentage(parseFloat(parseFloat(todayDoneTime / todayTotalTime)).toFixed(2));
            var totalPercentage = ProcessPercentage(parseFloat(parseFloat(totalDoneTime / totalTotalTime)).toFixed(2));

            function changeCircle(id, percentage, itemDone, itemTotal){
                var deg = (1 - percentage) * 360;
                function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
                    var angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;
                    return {
                        x: centerX + (radius * Math.cos(angleInRadians)),
                        y: centerY + (radius * Math.sin(angleInRadians))
                    };
                }
                function describeArc(x, y, radius, endAngle){
                    var end = polarToCartesian(x, y, radius, endAngle), val = endAngle < 180 ? 0: 1;
                    var d = ["M", 0.5, 0.5, 0.5, 0, "A", 0.5, 0.5, 0, val, 1, end.x, end.y, "z"].join(" ");
                    return d;
                }
                $('#' + id + 'Circle').attr("d", describeArc(0.5, 0.5, 0.5, deg));
                if (percentage == 0.01){
                    percentage = 0;
                }
                var updatedText = parseInt(percentage * 100).toString();
                $('#' + id + 'Percentage').html(updatedText);
                $('#' + id + 'ItemsDone').html(itemDone.toString());
                $('#' + id + 'TotalItems').html(itemTotal.toString());
            }

            changeCircle("today", todayPercentage, todayDoneItems, todayTotalItems);
            changeCircle("total", totalPercentage, totalDoneItems, totalTotalItems);
        });
    }

    function isNull(t){
        return (t == null || t == "");
    }
    function hasFile(id){
        //if there is a value, return true, else: false;
        return $('#'+id).val() ? true: false;
    }

    $('#submit_form_add_activity').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                if (isNull($("#add-activity-form-name").val())){
                    alert("Name of the activity cannot be empty!");
                    return false;
                }
                if (isNull($("#add-activity-form-description").val())){
                    alert("Description of the activity cannot be empty!");
                    return false;
                }

                $('#submit_btn_add_activity').prop('disabled',true).val("Sending...");
                $("#progress_activity_1").show();
                return true;
            },
            uploadProgress: function(event, position, total, percentComplete) {
                $('#progress_activity_1').attr("value", percentComplete);
            },
            clearForm: true,
            data:{hasAttachment: hasFile('add-activity-form-file')},
            success: function(content,textStatus,xhr,$form){
                if (content == "Success"){
                    alert(content);
                }
                $('#submit_btn_add_activity').prop('disabled',false).val("Submit");
                $('#shadow').hide();
                $("#progress_activity_1").hide();
                new ManipulateActivity().loadActivities(function(){
                    $('#activity-list').html("");
                })
            }
        });
        return false;
    });
    $('#submit_form_add_activityComment').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                if (isNull($("#add-activityComment-form-comment").val())){
                    alert("Comment cannot be empty!");
                    return false;
                }

                $('#submit_btn_add_activityComment').prop('disabled',true).val("Sending...");
                $("#progress_activity_2").show();
                return true;
            },
            uploadProgress: function(event, position, total, percentComplete) {
                $('#progress_activity_2').attr("value", percentComplete);
            },
            clearForm: true,
            data:{hasAttachment: hasFile('add-activityComment-form-file')},
            success: function(content,textStatus,xhr,$form){
                if (content == "Success"){
                    alert(content);
                }
                $('#submit_btn_add_activityComment').prop('disabled',false).val("Submit");
                $('#shadow').hide();
                $("#progress_activity_2").hide();

                var id = $('#right-part-view-activity-id').html();
                new Activity(id, "", "", "", "", "", "", "", [], []).loadComments(function(){
                    $('#activity-comment-list').html("");
                });
            }
        });
        return false;
    });
    $('#add-activity-form-file-button-1').click(function(e){
        e.preventDefault();
        var html = "<div class='mdl-textfield mdl-js-textfield' style='display: block; padding: 10px 0; width: 100%'><input class='mdl-textfield__input uploadfile1' style='margin-top: 0.5em; background: white' name='attachment[]' type='file' multiple /></div>";
        $("#add-activity-form-file-input-list").append(html);
    });
    $('#add-activityComment-form-file-button').click(function(e){
        e.preventDefault();
        var html = "<div class='mdl-textfield mdl-js-textfield' style='display: block; padding: 10px 0; width: 100%'><input class='mdl-textfield__input uploadfile1' style='margin-top: 0.5em; background: white' name='attachment[]' type='file' multiple /></div>";
        $("#add-activityComment-form-file-input-list").append(html);
    });

    toggleModules('Home');

    loadAssignment(function(){
        $('#assignment-list').html("");
    });
    new ManipulateActivity().loadActivities(function(){
        $('#activity-list').html("");
    });
    new ManipulateCollege().loadColleges(function(){
        $('#college-list').html("");
    });
    new Class('', '').loadClass(1, function(){
        $('#classList').html("");
    });
    new ManipulatePresentation().loadPresentations(1);


</script>