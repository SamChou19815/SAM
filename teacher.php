<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sam
 * Date: 10/24/15
 * Time: 17:20
 */
if (!function_exists('checkForceQuit')){
    die("You are detected as an unexpected intruder.");
}else{
    checkForceQuit();
}

?>
<!DOCTYPE html>
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
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $appName ?> - Teacher</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="shortcut icon" href="/favicon.ico" />
    <script src="/framework/js/jq.js"></script>
    <script src="/framework/js/form.js"></script>
    <script src="/framework/js/masonry.js"></script>
    <script src="/framework/js/material.js"></script>
    <script src="/framework/fix/safari/fixdateinput.js"></script>
    <style>
        <?php
            require $_SERVER['DOCUMENT_ROOT']."/framework/fix/safari/fixdateinput.css";

            require $_SERVER['DOCUMENT_ROOT']."/framework/material/material.min.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/material/material-dashboard-styles.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/geodesic/base.css";
            require $_SERVER['DOCUMENT_ROOT']."/framework/geodesic/settings.css";
        ?>
        #assignment-list{
            margin: 0 auto;
        }
    </style>
</head>
<body>
<script>
    function toggleModules(id){
        $('#right-part').hide();
        $('#mClasses').hide();
        $('#left-tab-Classes').css("background","").css("color","#eceff1");
        $('#mSettings').hide();
        $('#left-tab-Settings').css("background","").css("color","#eceff1");
        $('#m'+id).show();
        $('#left-tab-'+id).css("background","#00BCD4").css("color","#37474F");
        $('#title').html(id);
        $('.demo-drawer').removeClass("is-visible")
    }


    <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/base.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/class.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/assignment.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/waterfall.js";
        require $_SERVER['DOCUMENT_ROOT']."/template/scripts/settings.js";
    ?>

</script>
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
            <a id="left-tab-Classes" onclick="toggleModules('Classes')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">school</i>Classes</a>
            <a id="left-tab-Settings" onclick="toggleModules('Settings')" class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Settings</a>
        </nav>
    </div>
    <main class="mdl-layout__content mdl-color--grey-100">
        <div id="loading" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="width: auto;"></div>
        <div id="mClasses">
            <div id="classList" class="mdl-grid demo-content"></div>
            <div class="card" style="text-align:center" onclick="new Class('', '').addClass()">Add Class</div>
        </div>
        <?php
        require $_SERVER['DOCUMENT_ROOT']."/template/pages/settings.html";
        ?>
    </main>
    <div id="right-part" class="mdl-layout--fixed-header" style="display:none">
        <div style="display: none;" id="right-part-class-id"></div>
        <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row" style="padding-left: 1em; cursor: pointer" onclick="$('#assignment-list').empty();$('#right-part').hide()">
                    <span class="mdl-layout-title" style="display: flex; flex-direction: row">
                        <span class="material-icons" style="display: flex">close</span>
                        <span id="right-part-title" style="display: flex">Manage Class</span>
                    </span>
                    <span class="mdl-layout-title" style="display: flex; flex-direction: row; text-indent: 5em" onclick="new Class('', '').deleteClass()">
                        <span class="material-icons"style="display: flex">delete</span>
                        <span style="display: flex">Delete Class</span>
                    </span>
            </div>
        </header>
        <div id="assignment-list"></div>
    </div>
    <div id="shadow" style="display: none;">
        <div style="display:table-cell;vertical-align: middle">
            <div style="display:table;margin-left:auto;margin-right: auto;">
                <div id="floatBox">
                    <div id="floatBox-close" onclick="$('#shadow').hide()">Close</div>
                    <div class="settings_title_bar" style="padding: 0;">
                        <div id="floatBox-title" style="margin: 0.3em"></div>
                    </div>
                    <div id="floatBox-content">
                        <div id="floatBox-update-card">
                            <div>
                                <div>Content:</div>
                                <div style="display: none" id="update-card-content-id"></div>
                                <div class="mdl-textfield mdl-js-textfield" style="width: 100%">
                                    <textarea class="mdl-textfield__input" style="background: white" type="text" name="content" rows="5" id="update-card-content-ta" ></textarea>
                                    <label class="mdl-textfield__label" for="update-card-content-ta"></label>
                                </div>
                            </div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" onclick="new ManipulateAssignment('').sendUpdateAssignment()">
                                Update
                            </button>
                        </div>
                        <div id="floatBox-view-members">
                            <div id="floatBox-view-members-list"></div>
                        </div>
                        <div id="floatBox-add-card">
                            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                <div class="mdl-tabs__tab-bar">
                                    <a href="#add-panel-1" class="mdl-tabs__tab is-active"><span class='material-icons'>assignment</span> Assignment</a>
                                    <a href="#add-panel-2" class="mdl-tabs__tab"><span class='material-icons'>book</span> Information</a>
                                </div>

                                <div class="mdl-tabs__panel is-active" id="add-panel-1">
                                    <form id="submit_form_node" action='/modules/assignment/addAssignment.php' method="post" enctype="multipart/form-data">
                                        <input id="add-card-class-id" type="hidden" name="class" />
                                        <input type="hidden" name="type" value="1" />
                                        <div>Content:</div>
                                        <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                            <textarea class="mdl-textfield__input" style="background: white" type="text" rows="5" id="add-card-form-content" name="content" ></textarea>
                                            <label class="mdl-textfield__label" for="add-card-form-content">Input the illustration for the assignment</label>
                                        </div>
                                        <div>Estimated Duration (in minutes):</div>
                                        <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                            <input class="mdl-textfield__input" style="background: white" type="text" id="add-card-form-duration" name="duration" />
                                            <label class="mdl-textfield__label" for="add-card-form-duration">Estimated Duration (in minutes)</label>
                                        </div>
                                        <div>Due:</div>
                                        <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                            <input class="mdl-textfield__input" style="background: white" type="text" id="add-card-form-dueday" name="dueday" data-format="yyyy-MM-dd" />
                                            <label class="mdl-textfield__label" for="add-card-form-dueday"></label>
                                        </div>
                                        <div>Add attachment (optional):</div>
                                        <div class="mdl-textfield mdl-js-textfield" style='display: block; padding: 10px 0; width: 100%'>
                                            <input class="mdl-textfield__input uploadfile1" style="background: white" id="add-card-form-file" name="attachment[]" type="file" multiple />
                                            <label class="mdl-textfield__label" for="add-card-form-file"></label>
                                        </div>
                                        <button id="add-card-form-file-button-1" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5; display: block" >Add More Files</button>
                                        <div style="text-align: center; margin-top: 1em">
                                            <input type="submit" value="Submit" id="submit_btn_add_card" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" />
                                        </div>
                                    </form>
                                </div>
                                <div class="mdl-tabs__panel" id="add-panel-2">
                                    <form id="submit_form_node_2" class="dropzone" action='/modules/assignment/addAssignment.php' method="post" enctype="multipart/form-data">
                                        <input id="add-card-class-id-2" type="hidden" name="class" />
                                        <input type="hidden" name="type" value="2" />
                                        <div>Content:</div>
                                        <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                            <textarea class="mdl-textfield__input" style="background: white" type="text" rows="5" id="add-card-form-content-2" name="content" ></textarea>
                                            <label class="mdl-textfield__label" for="add-card-form-content-2">Input the illustration for the assignment</label>
                                        </div>
                                        <div>Expire (leave it blank to keep it permanently):</div>
                                        <div class="mdl-textfield mdl-js-textfield" style="padding: 15px 0; width: 100%">
                                            <input class="mdl-textfield__input" style="background: white" type="text" id="add-card-form-dueday-2" name="dueday" data-format="yyyy-MM-dd" />
                                            <label class="mdl-textfield__label" for="add-card-form-dueday-2"></label>
                                        </div>
                                        <div>Add attachment (optional):</div>
                                        <div class="mdl-textfield mdl-js-textfield" style='display: block; padding: 10px 0; width: 100%'>
                                            <input class="mdl-textfield__input uploadfile2" style="background: white" id="add-card-form-file-2" name="attachment[]" type="file" multiple />
                                            <label class="mdl-textfield__label" for="add-card-form-file-2"></label>
                                        </div>
                                        <button id="add-card-form-file-button-2" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5; display: block" >Add More Files</button>
                                        <div style="text-align: center">
                                            <input type="submit" value="Submit" id="submit_btn_add_card-2" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="floatBox-update-scores">
                            <div id="floatBox-update-scores-assignment-id" style="display: none"></div>
                            <div id="floatBox-update-scores-assignment-num" style="display: none"></div>
                            <div id="floatBox-update-scores-dynamic-inputs"></div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: #3f51b5" onclick="new ManipulateAssignment($('#floatBox-update-scores-assignment-id').html()).updateScores( parseInt($('#floatBox-update-scores-assignment-num').html()))">
                                Update Score
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    $(function() {
        $('#add-card-form-dueday').datepick();
        $('#add-card-form-dueday-2').datepick();
    });

    function isNull(t){
        if (t == null || t == ""){return true}
        return false;
    }
    function getToday() {
        var today = new Date(), dd = today.getDate(), mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {dd = '0' + dd}
        if (mm < 10) {mm = '0' + mm}
        today = yyyy + "-" + mm + "-" + dd;
        return today;
    }
    function validDate(dateStr) {
        var d1 = Date.parse(getToday()), d2 = Date.parse(dateStr);
        if (d1 > d2) {return false}
        return true;
    }
    function hasFile(id){
        //if there is a value, return true, else: false;
        return $('#'+id).val() ? true: false;
    }

    function validateInputs(type){
        var suffix;
        if (type == 'assignment'){
            suffix = "";
        }else if (type == 'information'){
            suffix = "-2";
        }

        if ( isNull($('#add-card-form-content'+suffix).val()) ){
            alert("Content is empty!");
            return false;
        }
        if ( !validDate($('#add-card-form-dueday'+suffix).val()) ){
            if (type == "assignment"){
                alert("Due day is invalid");
            }else if (type == "information"){
                alert("Expire day is invalid!");
            }
            return false;
        }

        if (type == 'assignment'){
            if ( isNull($('#add-card-form-duration').val()) ){
                alert("Duration is empty!");
                return false;
            }
            if ( isNaN($('#add-card-form-duration').val()) ){
                alert("Duration is not a number!");
                return false;
            }else{
                if ( parseFloat($('#add-card-form-duration').val()) <=0  ){
                    alert("Duration should be greater than zero!");
                    return false;
                }else if ( parseFloat($('#add-card-form-duration').val()) > 1000  ){
                    alert("It is inappropriate to give students so much homework to do!");
                    return false;
                }
            }
            if ( isNull($('#add-card-form-dueday').val()) ){
                alert("Due day is empty!");
                return false;
            }
        }

        var fileCondition = true;
        if (type == 'assignment'){
            fileCondition = parseInt(localStorage.filesize1) > 200;
        }else if (type == 'information'){
            fileCondition = parseInt(localStorage.filesize2) > 200;
        }
        if (fileCondition){
            alert("File size in total should not exceed 200MB.");
            return false;
        }

        return true;
    }
    $('#submit_form_node').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                if (!validateInputs('assignment')){
                    return false;
                }
                $('#submit_btn_add_card').prop('disabled',true).val("Sending...");
                return true;
            },
            clearForm: true,
            data:{hasAttachment: hasFile('add-card-form-file')},
            success: function(content,textStatus,xhr,$form){
                if (content == "Success"){
                    alert(content);
                    localStorage.filesize1 = 0;
                }
                $('#submit_btn_add_card').prop('disabled',false).val("Submit");
                $('#shadow').hide();
                new Class($('#add-card-class-id').val(), '').loadAssignment(1, function(){
                    $('#assignment-list').html("");
                })
            }
        });
        return false;
    });
    $('#submit_form_node_2').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                if (!validateInputs('information')){
                    return false;
                }
                $('#submit_btn_add_card-2').prop('disabled',true).val("Sending...");
                return true;
            },
            clearForm: true,
            data:{hasAttachment: hasFile('add-card-form-file-2')},
            success: function(content,textStatus,xhr,$form){
                if (content == "Success"){
                    alert(content);
                    localStorage.filesize2 = 0;
                }
                $('#submit_btn_add_card-2').prop('disabled',false).val("Submit");
                $('#shadow').hide();
                new Class($('#add-card-class-id-2').val(), '').loadAssignment(1, function(){
                    $('#assignment-list').html("");
                })
            }
        });
        return false;
    });

    $('#add-card-form-file-button-1').click(function(e){
        e.preventDefault();
        var html = "<div class='mdl-textfield mdl-js-textfield' style='display: block; padding: 10px 0; width: 100%'><input class='mdl-textfield__input uploadfile1' style='margin-top: 0.5em; background: white' name='attachment[]' type='file' multiple /></div>";
        $(this).before(html);
    });
    $('#add-card-form-file-button-2').click(function(e){
        e.preventDefault();
        var html = "<div class='mdl-textfield mdl-js-textfield' style='display: block; padding: 10px 0; width: 100%'><input class='mdl-textfield__input uploadfile2' style='margin-top: 0.5em; background: white' name='attachment[]' type='file' multiple /></div>";
        $(this).before(html);
    });
    $('.uploadfile1').bind('change', function() {
        var temp = 0;
        for (var i = 0; i < this.files.length; i++){
            temp += this.files[i].size/1024/1024;
        }
        localStorage.filesize1 = parseInt(localStorage.filesize1) + temp;
    });
    $('.uploadfile2').bind('change', function() {
        var temp = 0;
        for (var i = 0; i < this.files.length; i++){
            temp += this.files[i].size/1024/1024;
        }
        localStorage.filesize2 = parseInt(localStorage.filesize2) + temp;
    });
    localStorage.filesize1 = 0;
    localStorage.filesize2 = 0;

    toggleModules("Classes");
    new Class('', '').loadClass(2, function(){});

</script>
