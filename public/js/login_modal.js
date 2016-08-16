/**
 * Created by dusan_cvetkovic on 7/13/16.
 */
/* #####################################################################
 #
 #   Project       : Modal Login with jQuery Effects
 #   Author        : Rodrigo Amarante (rodrigockamarante)
 #   Version       : 1.0
 #   Created       : 07/29/2015
 #   Last Change   : 08/04/2015
 #
 ##################################################################### */

$(function() {

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    function indicateErrorField($field) {
        $field.addClass('error');
        setTimeout(function () {
            $field.removeClass('error');
        }, $msgShowTime);
    }

    $("form").submit(function () {
        switch(this.id) {
            case "login-form":
                makeAjaxReq(API_LOGIN, this.id, 'login');
                return false;
                break;
            case "lost-form":
                var $ls_email=$('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var regExSfsuEmail = /[0-9a-zA-Z]+@(mail.)*sfsu.edu/i;
                if (!regExSfsuEmail.test($("#register_email").val()))
                {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'),
                        "error", "glyphicon-remove",
                        "Your email should be from SFSU domain");
                    indicateErrorField($('#register_email'));
                    return false;
                }
                if ($("#register_sfsu_id").val()<1) {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'),
                        "error", "glyphicon-remove", "SFSU ID cannot be negative!");
                    indicateErrorField($('#register_sfsu_id'));
                    return false;
                }
                if (!$("#register_terms_conditions").is(":checked")) {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'),
                        "error", "glyphicon-remove", "You have to read terms and conditions!");
                    return false;
                }
                makeAjaxReq(API_ADD_USER, this.id, 'register');
                return false;
                break;
            default:
                return false;
        }
        return false;
    });

    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });

    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }

    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
            // alert($divClass !== 'error'  ? "success" : "error");
            if ($divClass !== 'error'){
                login();
                $('#login-modal').modal('hide');
                location.reload();
            }
        }, $msgShowTime);
    }

    function makeAjaxReq(apiCall, formId, formName) {
        var myjson = {};
        $.each($('#'+formId+' .modal-body input'), function () {
            myjson[this.id] = this.value;
        });
        var data = JSON.stringify(myjson);
        console.log(data);
        $.post(url + apiCall, data, function (response) {
            console.log(response);
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.error) {
                msgChange($('#div-'+formName+'-msg'), $('#icon-'+formName+'-msg'), $('#text-'+formName+'-msg'), "error", "glyphicon-remove", jsonResponse.error);
            } else {
                msgChange($('#div-'+formName+'-msg'), $('#icon-'+formName+'-msg'), $('#text-'+formName+'-msg'), "success", "glyphicon-ok", jsonResponse.success);
            }
        });
    }
});

