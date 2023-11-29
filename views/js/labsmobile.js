/*
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2020 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

$(document).ready(function() {
    $('.tpl_sms').each(function() {
        $(this).after('<div class="prompt_tpl_sms">' + promptTplSms($(this)) + '</div>');
    });
    $('.emo_sms').each(function() {
        $(this).after('<button type="button" class="btn prompt_emo_sms btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown"><span class="face">😀</span> &nbsp;&nbsp;<span class="caret"></span></button>\
        '+getEmoji()+'\
        ');
    });
    $('.tpl_sms').keyup(function(event) {
        $(this).parent().find('.prompt_tpl_sms').html(promptTplSms($(this)));
    });
    $('.tpl_sender').keyup(function(event) {
        $(this).val($(this).val().replace(/[^\_\sa-zA-Z\d]/g,''));
    });
    $(document).on('click', '#emojis i', function(){
        var value_str = $(this).parent().parent().find('.tpl_sms').val();
        $(this).parent().parent().find('.tpl_sms').val(value_str+$(this).text());
        $(this).parent().parent().find('.tpl_sms').keyup().focus();
    });
});

function formatDate(date) {

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
  
    return year + pad(month,2) + pad(day,2) + pad(hours,2) + pad(minutes,2) + pad(seconds,2);
  }

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

function promptTplSms(textareaSMS) {

    var num_chars = getNumChars(textareaSMS);
    var is_unicode = detectUnicode(textareaSMS);
    var num_messages = 0;
    var max_length1 = 160;
    var max_length2 = 153; 
    if(is_unicode) {
        max_length1 = 70;
        max_length2 = 67;
    }
    var num_left = max_length1;

    if(num_chars > 1) {
        if(num_chars > max_length1) {
            num_messages = Math.ceil(num_chars / max_length2);
            num_left = max_length2 * num_messages;
        } else {
            num_messages = 1;
        }
    }

    str_out = L_CHARACTERS + ': <strong>' + num_chars + '</strong>/' + num_left + ', ' + L_MESSAGES + ': <strong>' + num_messages + '</strong>';
    if(UNICODE_ACTIVE != 1) {
        str_out = str_out + ' ' + L_UNICODE;
    }
    return str_out;
}

function detectUnicode(textareaSMS) {
    return UNICODE_ACTIVE && 
    ($(textareaSMS).val().replace(/[^@£¥èéùìò´`¨˚ÇØøÅåΔΦΓΛΩΠΨΣΘΞÄÖÑÜ§äöñüà\s\_\^\|\{\}\[~\]€ÆæßÉ\!¡\/\\"#¤%&'\(\)\*\+,-\.|:;<=>\?¿a-zA-Z\d]/g,'').length != $(textareaSMS).val().length);
}

function getNumChars(textareaSMS) {

    var messageField_length;

    if(!UNICODE_ACTIVE) {
        var position_cursor = $(textareaSMS).getCursorPosition();
        $(textareaSMS).val($(textareaSMS).val().replace(/á/g,'a'));
        $(textareaSMS).val($(textareaSMS).val().replace(/ë/g,'e'));
        $(textareaSMS).val($(textareaSMS).val().replace(/í/g,'i'));
        $(textareaSMS).val($(textareaSMS).val().replace(/ï/g,'i'));
        $(textareaSMS).val($(textareaSMS).val().replace(/ó/g,'o'));
        $(textareaSMS).val($(textareaSMS).val().replace(/ú/g,'u'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Á/g,'A'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Ë/g,'E'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Í/g,'I'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Ï/g,'I'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Ó/g,'O'));
        $(textareaSMS).val($(textareaSMS).val().replace(/Ú/g,'U'));
        $(textareaSMS).val($(textareaSMS).val().replace(/ç/g,'Ç'));
        $(textareaSMS).val($(textareaSMS).val().replace(/[^@£¥èéùìò´`¨˚ÇØøÅåΔΦΓΛΩΠΨΣΘΞÄÖÑÜ§äöñüà\s\_\^\|\{\}\[~\]€ÆæßÉ\!¡\/\\"#¤%&'\(\)\*\+,-\.|:;<=>\?¿a-zA-Z\d]/g,''));
        messageField_length = $(textareaSMS).val().length + charCounterArray($(textareaSMS).val());
    } else {
        messageField_length = $(textareaSMS).val().length;
    }
    /*
    if($(textareaSMS).is(":focus")){
        var messageField_length_new = $(textareaSMS).val().length;
        if(messageField_length == messageField_length_new) {
            setSelectionRange($(textareaSMS)[0], position_cursor, position_cursor);
        } else {
            setSelectionRange($(textareaSMS)[0], position_cursor-1, position_cursor-1);
        }
    }*/
    return messageField_length;
}

(function ($, undefined) {
    $.fn.getCursorPosition = function() {
        var el = $(this).get(0);
        var pos = 0;
        if('selectionStart' in el) {
            pos = el.selectionStart;
        } else if('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);

function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }
    else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    }
}

function charCounterArray(field){
    var str = field,
        hist = {};
    hist['['] = 0;
    hist[']'] = 0;
    hist['{'] = 0;
    hist['}'] = 0;
    hist['|'] = 0;
    hist['€'] = 0;
    hist['\\'] = 0;
    hist['~'] = 0;
    hist['^'] = 0;
    for (si in str) {
        hist[str[si]] = hist[str[si]] ? 1 + hist[str[si]] : 1;
    };
    return hist['[']+hist[']']+hist['{']+hist['}']+hist['|']+hist['€']+hist['\\']+hist['~']+hist['^'];
}

function humanizeSize(bytes) {
    if (typeof bytes !== 'number') {
        return '';
    }
    if (bytes >= 1000000000) {
        return (bytes / 1000000000).toFixed(2) + ' GB';
    }
    if (bytes >= 1000000) {
        return (bytes / 1000000).toFixed(2) + ' MB';
    }
    return (bytes / 1000).toFixed(2) + ' KB';
}

function maxSizeStr(text, maxsize) {
    if(text.length > maxsize) {
        return text.substr(0,maxsize-4)+'...';
    } else {
        return text;
    }
}

function getEmoji() {
    return '<div id="emojis" style="display:none;" class="dropdown-menu"><i>😀</i><i>😃</i><i>😄</i><i>😁</i><i>😆</i><i>😅</i><i>😂</i><i>🤣</i><i>😊</i><i>😇</i><i>🙂</i><i>🙃</i><i>😉</i><i>😌</i><i>😍</i><i>😘</i><i>😗</i><i>😙</i><i>😚</i><i>😋</i><i>😜</i><i>😝</i><i>😛</i><i>🤑</i><i>🤗</i><i>🤓</i><i>😎</i><i>🤡</i><i>🤠</i><i>😏</i><i>😒</i><i>😞</i><i>😔</i><i>😟</i><i>😕</i><i>🙁</i><i>☹️</i><i>😣</i><i>😖</i><i>😫</i><i>😩</i><i>😤</i><i>😠</i><i>😡</i><i>😶</i><i>😐</i><i>😑</i><i>😯</i><i>😦</i><i>😧</i><i>😮</i><i>😲</i><i>😵</i><i>😳</i><i>😱</i><i>😨</i><i>😰</i><i>😢</i><i>😥</i><i>🤤</i><i>😭</i><i>😓</i><i>😪</i><i>😴</i><i>🙄</i><i>🤔</i><i>🤥</i><i>😬</i><i>🤐</i><i>🤢</i><i>🤧</i><i>😷</i><i>🤒</i><i>🤕</i><i>😈</i><i>👿</i><i>👹</i><i>👺</i><i>💩</i><i>👻</i><i>💀</i><i>☠️</i><i>👽</i><i>👾</i><i>🤖</i><i>🎃</i><i>😺</i><i>😸</i><i>😹</i><i>😻</i><i>😼</i><i>😽</i><i>🙀</i><i>😿</i><i>😾</i><i>👐</i><i>🙌</i><i>👏</i><i>🙏</i><i>🤝</i><i>👍</i><i>👎</i><i>👊</i><i>✊</i><i>🤛</i><i>🤜</i><i>🤞</i><i>✌️</i><i>🤘</i><i>👌</i><i>👈</i><i>👉</i><i>👆</i><i>👇</i><i>☝️</i><i>✋</i><i>🤚</i><i>🖐</i><i>🖖</i><i>👋</i><i>🤙</i><i>💪</i><i>🖕</i><i>✍️</i><i>🤳</i><i>💅</i><i>🖖</i><i>💄</i><i>💋</i><i>👄</i><i>👅</i><i>👂</i><i>👃</i><i>👣</i><i>👁</i><i>👀</i><i>🗣</i><i>👤</i><i>👥</i><i>👶</i><i>👦</i><i>👧</i><i>👨</i><i>👩</i><i>👱‍♀️</i><i>👱</i><i>👴</i><i>👵</i><i>👲</i><i>👳‍♀️</i><i>👳</i><i>👮‍♀️</i><i>👮</i><i>👷‍♀️</i><i>👷</i><i>💂‍♀️</i><i>💂</i><i>🕵️‍♀️</i><i>🕵️</i><i>👩‍⚕️</i><i>👨‍⚕️</i><i>👩‍🌾</i><i>👨‍🌾</i><i>👩‍🍳</i><i>👨‍🍳</i><i>👩‍🎓</i><i>👨‍🎓</i><i>👩‍🎤</i><i>👨‍🎤</i><i>👩‍🏫</i><i>👨‍🏫</i><i>👩‍🏭</i><i>👨‍🏭</i><i>👩‍💻</i><i>👨‍💻</i><i>👩‍💼</i><i>👨‍💼</i><i>👩‍🔧</i><i>👨‍🔧</i><i>👩‍🔬</i><i>👨‍🔬</i><i>👩‍🎨</i><i>👨‍🎨</i><i>👩‍🚒</i><i>👨‍🚒</i><i>👩‍✈️</i><i>👨‍✈️</i><i>👩‍🚀</i><i>👨‍🚀</i><i>👩‍⚖️</i><i>👨‍⚖️</i><i>🤶</i><i>🎅</i><i>👸</i><i>🤴</i><i>👰</i><i>🤵</i><i>👼</i><i>🤰</i><i>🙇‍♀️</i><i>🙇</i><i>💁</i><i>💁‍♂️</i><i>🙅</i><i>🙅‍♂️</i><i>🙆</i><i>🙆‍♂️</i><i>🙋</i><i>🙋‍♂️</i><i>🤦‍♀️</i><i>🤦‍♂️</i><i>🤷‍♀️</i><i>🤷‍♂️</i><i>🙎</i><i>🙎‍♂️</i><i>🙍</i><i>🙍‍♂️</i><i>💇</i><i>💇‍♂️</i><i>💆</i><i>💆‍♂️</i><i>🕴</i><i>💃</i><i>🕺</i><i>👯</i><i>👯‍♂️</i><i>🚶‍♀️</i><i>🚶</i><i>🏃‍♀️</i><i>🏃</i><i>👫</i><i>👭</i><i>👬</i><i>💑</i><i>👩‍❤️‍👩</i><i>👨‍❤️‍👨</i><i>💏</i><i>👩‍❤️‍💋‍👩</i><i>👨‍❤️‍💋‍👨</i><i>👪</i><i>👨‍👩‍👧</i><i>👨‍👩‍👧‍👦</i><i>👨‍👩‍👦‍👦</i><i>👨‍👩‍👧‍👧</i><i>👩‍👩‍👦</i><i>👩‍👩‍👧</i><i>👩‍👩‍👧‍👦</i><i>👩‍👩‍👦‍👦</i><i>👩‍👩‍👧‍👧</i><i>👨‍👨‍👦</i><i>👨‍👨‍👧</i><i>👨‍👨‍👧‍👦</i><i>👨‍👨‍👦‍👦</i><i>👨‍👨‍👧‍👧</i><i>👩‍👦</i><i>👩‍👧</i><i>👩‍👧‍👦</i><i>👩‍👦‍👦</i><i>👩‍👧‍👧</i><i>👨‍👦</i><i>👨‍👧</i><i>👨‍👧‍👦</i><i>👨‍👦‍👦</i><i>👨‍👧‍👧</i><i>👚</i><i>👕</i><i>👖</i><i>👔</i><i>👗</i><i>👙</i><i>👘</i><i>👠</i><i>👡</i><i>👢</i><i>👞</i><i>👟</i><i>👒</i><i>🎩</i><i>🎓</i><i>👑</i><i>⛑</i><i>🎒</i><i>👝</i><i>👛</i><i>👜</i><i>💼</i><i>👓</i><i>🕶</i><i>🌂</i><i>☂️</i><i>👐🏻</i><i>🙌🏻</i><i>👏🏻</i><i>🙏🏻</i><i>👍🏻</i><i>👎🏻</i><i>👊🏻</i><i>✊🏻</i><i>🤛🏻</i><i>🤜🏻</i><i>🤞🏻</i><i>✌🏻</i><i>🤘🏻</i><i>👌🏻</i><i>👈🏻</i><i>👉🏻</i><i>👆🏻</i><i>👇🏻</i><i>☝🏻</i><i>✋🏻</i><i>🤚🏻</i><i>🖐🏻</i><i>🖖🏻</i><i>👋🏻</i><i>🤙🏻</i><i>💪🏻</i><i>🖕🏻</i><i>✍🏻</i><i>🤳🏻</i><i>💅🏻</i><i>👂🏻</i><i>👃🏻</i><i>👶🏻</i><i>👦🏻</i><i>👧🏻</i><i>👨🏻</i><i>👩🏻</i><i>👱🏻‍♀️</i><i>👱🏻</i><i>👴🏻</i><i>👵🏻</i><i>👲🏻</i><i>👳🏻‍♀️</i><i>👳🏻</i><i>👮🏻‍♀️</i><i>👮🏻</i><i>👷🏻‍♀️</i><i>👷🏻</i><i>💂🏻‍♀️</i><i>💂🏻</i><i>🕵🏻‍♀️</i><i>🕵🏻</i><i>👩🏻‍⚕️</i><i>👨🏻‍⚕️</i><i>👩🏻‍🌾</i><i>👨🏻‍🌾</i><i>👩🏻‍🍳</i><i>👨🏻‍🍳</i><i>👩🏻‍🎓</i><i>👨🏻‍🎓</i><i>👩🏻‍🎤</i><i>👨🏻‍🎤</i><i>👩🏻‍🏫</i><i>👨🏻‍🏫</i><i>👩🏻‍🏭</i><i>👨🏻‍🏭</i><i>👩🏻‍💻</i><i>👨🏻‍💻</i><i>👩🏻‍💼</i><i>👨🏻‍💼</i><i>👩🏻‍🔧</i><i>👨🏻‍🔧</i><i>👩🏻‍🔬</i><i>👨🏻‍🔬</i><i>👩🏻‍🎨</i><i>👨🏻‍🎨</i><i>👩🏻‍🚒</i><i>👨🏻‍🚒</i><i>👩🏻‍✈️</i><i>👨🏻‍✈️</i><i>👩🏻‍🚀</i><i>👨🏻‍🚀</i><i>👩🏻‍⚖️</i><i>👨🏻‍⚖️</i><i>🤶🏻</i><i>🎅🏻</i><i>👸🏻</i><i>🤴🏻</i><i>👰🏻</i><i>🤵🏻</i><i>👼🏻</i><i>🤰🏻</i><i>🙇🏻‍♀️</i><i>🙇🏻</i><i>💁🏻</i><i>💁🏻‍♂️</i><i>🙅🏻</i><i>🙅🏻‍♂️</i><i>🙆🏻</i><i>🙆🏻‍♂️</i><i>🙋🏻</i><i>🙋🏻‍♂️</i><i>🤦🏻‍♀️</i><i>🤦🏻‍♂️</i><i>🤷🏻‍♀️</i><i>🤷🏻‍♂️</i><i>🙎🏻</i><i>🙎🏻‍♂️</i><i>🙍🏻</i><i>🙍🏻‍♂️</i><i>💇🏻</i><i>💇🏻‍♂️</i><i>💆🏻</i><i>💆🏻‍♂️</i><i>🕴🏻</i><i>💃🏻</i><i>🕺🏻</i><i>🚶🏻‍♀️</i><i>🚶🏻</i><i>🏃🏻‍♀️</i><i>🏃🏻</i><i>🏋🏻‍♀️</i><i>🏋🏻</i><i>🤸🏻‍♀️</i><i>🤸🏻‍♂️</i><i>⛹🏻‍♀️</i><i>⛹🏻</i><i>🤾🏻‍♀️</i><i>🤾🏻‍♂️</i><i>🏌🏻‍♀️</i><i>🏌🏻</i><i>🏄🏻‍♀️</i><i>🏄🏻</i><i>🏊🏻‍♀️</i><i>🏊🏻</i><i>🤽🏻‍♀️</i><i>🤽🏻‍♂️</i><i>🚣🏻‍♀️</i><i>🚣🏻</i><i>🏇🏻</i><i>🚴🏻‍♀️</i><i>🚴🏻</i><i>🚵🏻‍♀️</i><i>🚵🏻</i><i>🤹🏻‍♀️</i><i>🤹🏻‍♂️</i><i>🛀🏻</i><i>🐶</i><i>🐱</i><i>🐭</i><i>🐹</i><i>🐰</i><i>🦊</i><i>🐻</i><i>🐼</i><i>🐨</i><i>🐯</i><i>🦁</i><i>🐮</i><i>🐷</i><i>🐽</i><i>🐸</i><i>🐵</i><i>🙊</i><i>🙉</i><i>🙊</i><i>🐒</i><i>🐔</i><i>🐧</i><i>🐦</i><i>🐤</i><i>🐣</i><i>🐥</i><i>🦆</i><i>🦅</i><i>🦉</i><i>🦇</i><i>🐺</i><i>🐗</i><i>🐴</i><i>🦄</i><i>🐝</i><i>🐛</i><i>🦋</i><i>🐌</i><i>🐚</i><i>🐞</i><i>🐜</i><i>🕷</i><i>🕸</i><i>🐢</i><i>🐍</i><i>🦎</i><i>🦂</i><i>🦀</i><i>🦑</i><i>🐙</i><i>🦐</i><i>🐠</i><i>🐟</i><i>🐡</i><i>🐬</i><i>🦈</i><i>🐳</i><i>🐋</i><i>🐊</i><i>🐆</i><i>🐅</i><i>🐃</i><i>🐂</i><i>🐄</i><i>🦌</i><i>🐪</i><i>🐫</i><i>🐘</i><i>🦏</i><i>🦍</i><i>🐎</i><i>🐖</i><i>🐐</i><i>🐏</i><i>🐑</i><i>🐕</i><i>🐩</i><i>🐈</i><i>🐓</i><i>🦃</i><i>🕊</i><i>🐇</i><i>🐁</i><i>🐀</i><i>🐿</i><i>🐾</i><i>🐉</i><i>🐲</i><i>🌵</i><i>🎄</i><i>🌲</i><i>🌳</i><i>🌴</i><i>🌱</i><i>🌿</i><i>☘️</i><i>🍀</i><i>🎍</i><i>🎋</i><i>🍃</i><i>🍂</i><i>🍁</i><i>🍄</i><i>🌾</i><i>💐</i><i>🌷</i><i>🌹</i><i>🥀</i><i>🌻</i><i>🌼</i><i>🌸</i><i>🌺</i><i>🌎</i><i>🌍</i><i>🌏</i><i>🌕</i><i>🌖</i><i>🌗</i><i>🌘</i><i>🌑</i><i>🌒</i><i>🌓</i><i>🌔</i><i>🌚</i><i>🌝</i><i>🌞</i><i>🌛</i><i>🌜</i><i>🌙</i><i>💫</i><i>⭐️</i><i>🌟</i><i>✨</i><i>⚡️</i><i>🔥</i><i>💥</i><i>☄️</i><i>☀️</i><i>🌤</i><i>⛅️</i><i>🌥</i><i>🌦</i><i>🌈</i><i>☁️</i><i>🌧</i><i>⛈</i><i>🌩</i><i>🌨</i><i>☃️</i><i>⛄️</i><i>❄️</i><i>🌬</i><i>💨</i><i>🌪</i><i>🌫</i><i>🌊</i><i>💧</i><i>💦</i><i>☔️</i><i>🍏</i><i>🍎</i><i>🍐</i><i>🍊</i><i>🍋</i><i>🍌</i><i>🍉</i><i>🍇</i><i>🍓</i><i>🍈</i><i>🍒</i><i>🍑</i><i>🍍</i><i>🥝</i><i>🥑</i><i>🍅</i><i>🍆</i><i>🥒</i><i>🥕</i><i>🌽</i><i>🌶</i><i>🥔</i><i>🍠</i><i>🌰</i><i>🥜</i><i>🍯</i><i>🥐</i><i>🍞</i><i>🥖</i><i>🧀</i><i>🥚</i><i>🍳</i><i>🥓</i><i>🥞</i><i>🍤</i><i>🍗</i><i>🍖</i><i>🍕</i><i>🌭</i><i>🍔</i><i>🍟</i><i>🥙</i><i>🌮</i><i>🌯</i><i>🥗</i><i>🥘</i><i>🍝</i><i>🍜</i><i>🍲</i><i>🍥</i><i>🍣</i><i>🍱</i><i>🍛</i><i>🍚</i><i>🍙</i><i>🍘</i><i>🍢</i><i>🍡</i><i>🍧</i><i>🍨</i><i>🍦</i><i>🍰</i><i>🎂</i><i>🍮</i><i>🍭</i><i>🍬</i><i>🍫</i><i>🍿</i><i>🍩</i><i>🍪</i><i>🥛</i><i>🍼</i><i>☕️</i><i>🍵</i><i>🍶</i><i>🍺</i><i>🍻</i><i>🥂</i><i>🍷</i><i>🥃</i><i>🍸</i><i>🍹</i><i>🍾</i><i>🥄</i><i>🍴</i><i>🍽</i><i>⚽️</i><i>🏀</i><i>🏈</i><i>⚾️</i><i>🎾</i><i>🏐</i><i>🏉</i><i>🎱</i><i>🏓</i><i>🏸</i><i>🥅</i><i>🏒</i><i>🏑</i><i>🏏</i><i>⛳️</i><i>🏹</i><i>🎣</i><i>🥊</i><i>🥋</i><i>⛸</i><i>🎿</i><i>⛷</i><i>🏂</i><i>🏋️‍♀️</i><i>🏋️</i><i>🤺</i><i>🤼‍♀️</i><i>🤼‍♂️</i><i>🤸‍♀️</i><i>🤸‍♂️</i><i>⛹️‍♀️</i><i>⛹️</i><i>🤾‍♀️</i><i>🤾‍♂️</i><i>🏌️‍♀️</i><i>🏌️</i><i>🏄‍♀️</i><i>🏄</i><i>🏊‍♀️</i><i>🏊</i><i>🤽‍♀️</i><i>🤽‍♂️</i><i>🚣‍♀️</i><i>🚣</i><i>🏇</i><i>🚴‍♀️</i><i>🚴</i><i>🚵‍♀️</i><i>🚵</i><i>🎽</i><i>🏅</i><i>🎖</i><i>🥇</i><i>🥈</i><i>🥉</i><i>🏆</i><i>🏵</i><i>🎗</i><i>🎫</i><i>🎟</i><i>🎪</i><i>🤹‍♀️</i><i>🤹‍♂️</i><i>🎭</i><i>🎨</i><i>🎬</i><i>🎤</i><i>🎧</i><i>🎼</i><i>🎹</i><i>🥁</i><i>🎷</i><i>🎺</i><i>🎸</i><i>🎻</i><i>🎲</i><i>🎯</i><i>🎳</i><i>🎮</i><i>🎰</i><i>🚗</i><i>🚕</i><i>🚙</i><i>🚌</i><i>🚎</i><i>🏎</i><i>🚓</i><i>🚑</i><i>🚒</i><i>🚐</i><i>🚚</i><i>🚛</i><i>🚜</i><i>🛴</i><i>🚲</i><i>🛵</i><i>🏍</i><i>🚨</i><i>🚔</i><i>🚍</i><i>🚘</i><i>🚖</i><i>🚡</i><i>🚠</i><i>🚟</i><i>🚃</i><i>🚋</i><i>🚞</i><i>🚝</i><i>🚄</i><i>🚅</i><i>🚈</i><i>🚂</i><i>🚆</i><i>🚇</i><i>🚊</i><i>🚉</i><i>🚁</i><i>🛩</i><i>✈️</i><i>🛫</i><i>🛬</i><i>🚀</i><i>🛰</i><i>💺</i><i>🛶</i><i>⛵️</i><i>🛥</i><i>🚤</i><i>🛳</i><i>⛴</i><i>🚢</i><i>⚓️</i><i>🚧</i><i>⛽️</i><i>🚏</i><i>🚦</i><i>🚥</i><i>🗺</i><i>🗿</i><i>🗽</i><i>⛲️</i><i>🗼</i><i>🏰</i><i>🏯</i><i>🏟</i><i>🎡</i><i>🎢</i><i>🎠</i><i>⛱</i><i>🏖</i><i>🏝</i><i>⛰</i><i>🏔</i><i>🗻</i><i>🌋</i><i>🏜</i><i>🏕</i><i>⛺️</i><i>🛤</i><i>🛣</i><i>🏗</i><i>🏭</i><i>🏠</i><i>🏡</i><i>🏘</i><i>🏚</i><i>🏢</i><i>🏬</i><i>🏣</i><i>🏤</i><i>🏥</i><i>🏦</i><i>🏨</i><i>🏪</i><i>🏫</i><i>🏩</i><i>💒</i><i>🏛</i><i>⛪️</i><i>🕌</i><i>🕍</i><i>🕋</i><i>⛩</i><i>🗾</i><i>🎑</i><i>🏞</i><i>🌅</i><i>🌄</i><i>🌠</i><i>🎇</i><i>🎆</i><i>🌇</i><i>🌆</i><i>🏙</i><i>🌃</i><i>🌌</i><i>🌉</i><i>🌁</i><i>⌚️</i><i>📱</i><i>📲</i><i>💻</i><i>⌨️</i><i>🖥</i><i>🖨</i><i>🖱</i><i>🖲</i><i>🕹</i><i>🗜</i><i>💽</i><i>💾</i><i>💿</i><i>📀</i><i>📼</i><i>📷</i><i>📸</i><i>📹</i><i>🎥</i><i>📽</i><i>🎞</i><i>📞</i><i>☎️</i><i>📟</i><i>📠</i><i>📺</i><i>📻</i><i>🎙</i><i>🎚</i><i>🎛</i><i>⏱</i><i>⏲</i><i>⏰</i><i>🕰</i><i>⌛️</i><i>⏳</i><i>📡</i><i>🔋</i><i>🔌</i><i>💡</i><i>🔦</i><i>🕯</i><i>🗑</i><i>🛢</i><i>💸</i><i>💵</i><i>💴</i><i>💶</i><i>💷</i><i>💰</i><i>💳</i><i>💎</i><i>⚖️</i><i>🔧</i><i>🔨</i><i>⚒</i><i>🛠</i><i>⛏</i><i>🔩</i><i>⚙️</i><i>⛓</i><i>🔫</i><i>💣</i><i>🔪</i><i>🗡</i><i>⚔️</i><i>🛡</i><i>🚬</i><i>⚰️</i><i>⚱️</i><i>🏺</i><i>🔮</i><i>📿</i><i>💈</i><i>⚗️</i><i>🔭</i><i>🔬</i><i>🕳</i><i>💊</i><i>💉</i><i>🌡</i><i>🚽</i><i>🚰</i><i>🚿</i><i>🛁</i><i>🛀</i><i>🛎</i><i>🔑</i><i>🗝</i><i>🚪</i><i>🛋</i><i>🛏</i><i>🛌</i><i>🖼</i><i>🛍</i><i>🛒</i><i>🎁</i><i>🎈</i><i>🎏</i><i>🎀</i><i>🎊</i><i>🎉</i><i>🎎</i><i>🏮</i><i>🎐</i><i>✉️</i><i>📩</i><i>📨</i><i>📧</i><i>💌</i><i>📥</i><i>📤</i><i>📦</i><i>🏷</i><i>📪</i><i>📫</i><i>📬</i><i>📭</i><i>📮</i><i>📯</i><i>📜</i><i>📃</i><i>📄</i><i>📑</i><i>📊</i><i>📈</i><i>📉</i><i>🗒</i><i>🗓</i><i>📆</i><i>📅</i><i>📇</i><i>🗃</i><i>🗳</i><i>🗄</i><i>📋</i><i>📁</i><i>📂</i><i>🗂</i><i>🗞</i><i>📰</i><i>📓</i><i>📔</i><i>📒</i><i>📕</i><i>📗</i><i>📘</i><i>📙</i><i>📚</i><i>📖</i><i>🔖</i><i>🔗</i><i>📎</i><i>🖇</i><i>📐</i><i>📏</i><i>📌</i><i>📍</i><i>📌</i><i>🎌</i><i>🏳️</i><i>🏴</i><i>🏁</i><i>🏳️‍🌈</i><i>✂️</i><i>🖊</i><i>🖋</i><i>✒️</i><i>🖌</i><i>🖍</i><i>📝</i><i>✏️</i><i>🔍</i><i>🔎</i><i>🔏</i><i>🔐</i><i>🔒</i><i>🔓</i><i>❤️</i><i>💛</i><i>💚</i><i>💙</i><i>💜</i><i>🖤</i><i>💔</i><i>❣️</i><i>💕</i><i>💞</i><i>💓</i><i>💗</i><i>💖</i><i>💘</i><i>💝</i><i>💟</i><i>☮️</i><i>✝️</i><i>☪️</i><i>🕉</i><i>☸️</i><i>✡️</i><i>🔯</i><i>🕎</i><i>☯️</i><i>☦️</i><i>🛐</i><i>⛎</i><i>♈️</i><i>♉️</i><i>♊️</i><i>♋️</i><i>♌️</i><i>♍️</i><i>♎️</i><i>♏️</i><i>♐️</i><i>♑️</i><i>♒️</i><i>♓️</i><i>🆔</i><i>⚛️</i><i>🉑</i><i>☢️</i><i>☣️</i><i>📴</i><i>📳</i><i>🈶</i><i>🈚️</i><i>🈸</i><i>🈺</i><i>🈷️</i><i>✴️</i><i>🆚</i><i>💮</i><i>🉐</i><i>㊙️</i><i>㊗️</i><i>🈴</i><i>🈵</i><i>🈹</i><i>🈲</i><i>🅰️</i><i>🅱️</i><i>🆎</i><i>🆑</i><i>🅾️</i><i>🆘</i><i>❌</i><i>⭕️</i><i>🛑</i><i>⛔️</i><i>📛</i><i>🚫</i><i>💯</i><i>💢</i><i>♨️</i><i>🚷</i><i>🚯</i><i>🚳</i><i>🚱</i><i>🔞</i><i>📵</i><i>🚭</i><i>❗️</i><i>❕</i><i>❓</i><i>❔</i><i>‼️</i><i>⁉️</i><i>🔅</i><i>🔆</i><i>〽️</i><i>⚠️</i><i>🚸</i><i>🔱</i><i>⚜️</i><i>🔰</i><i>♻️</i><i>✅</i><i>🈯️</i><i>💹</i><i>❇️</i><i>✳️</i><i>❎</i><i>🌐</i><i>💠</i><i>Ⓜ️</i><i>🌀</i><i>💤</i><i>🏧</i><i>🚾</i><i>♿️</i><i>🅿️</i><i>🈳</i><i>🈂️</i><i>🛂</i><i>🛃</i><i>🛄</i><i>🛅</i><i>🚹</i><i>🚺</i><i>🚼</i><i>🚻</i><i>🚮</i><i>🎦</i><i>📶</i><i>🈁</i><i>🔣</i><i>ℹ️</i><i>🔤</i><i>🔡</i><i>🔠</i><i>🆖</i><i>🆗</i><i>🆙</i><i>🆒</i><i>🆕</i><i>🆓</i><i>0️⃣</i><i>1️⃣</i><i>2️⃣</i><i>3️⃣</i><i>4️⃣</i><i>5️⃣</i><i>6️⃣</i><i>7️⃣</i><i>8️⃣</i><i>9️⃣</i><i>🔟</i><i>🔢</i><i>#️⃣</i><i>*️⃣</i><i>▶️</i><i>⏸</i><i>⏯</i><i>⏹</i><i>⏺</i><i>⏭</i><i>⏮</i><i>⏩</i><i>⏪</i><i>⏫</i><i>⏬</i><i>◀️</i><i>🔼</i><i>🔽</i><i>➡️</i><i>⬅️</i><i>⬆️</i><i>⬇️</i><i>↗️</i><i>↘️</i><i>↙️</i><i>↖️</i><i>↕️</i><i>↔️</i><i>↪️</i><i>↩️</i><i>⤴️</i><i>⤵️</i><i>🔀</i><i>🔁</i><i>🔂</i><i>🔄</i><i>🔃</i><i>🎵</i><i>🎶</i><i>➕</i><i>➖</i><i>➗</i><i>✖️</i><i>💲</i><i>💱</i><i>™️</i><i>©️</i><i>®️</i><i>〰️</i><i>➰</i><i>➿</i><i>🔚</i><i>🔙</i><i>🔛</i><i>🔝</i><i>✔️</i><i>☑️</i><i>🔘</i><i>⚪️</i><i>⚫️</i><i>🔴</i><i>🔵</i><i>🔺</i><i>🔻</i><i>🔸</i><i>🔹</i><i>🔶</i><i>🔷</i><i>🔳</i><i>🔲</i><i>▪️</i><i>▫️</i><i>◾️</i><i>◽️</i><i>◼️</i><i>◻️</i><i>⬛️</i><i>⬜️</i><i>🔈</i><i>🔇</i><i>🔉</i><i>🔊</i><i>🔔</i><i>🔕</i><i>📣</i><i>📢</i><i>👁‍🗨</i><i>💬</i><i>💭</i><i>🗯</i><i>♠️</i><i>♣️</i><i>♥️</i><i>♦️</i><i>🃏</i><i>🎴</i><i>🀄️</i><i>🕐</i><i>🕑</i><i>🕒</i><i>🕓</i><i>🕔</i><i>🕕</i><i>🕖</i><i>🕗</i><i>🕘</i><i>🕙</i><i>🕚</i><i>🕛</i><i>🕜</i><i>🕝</i><i>🕞</i><i>🕟</i><i>🕠</i><i>🕡</i><i>🕢</i><i>🕣</i><i>🕤</i><i>🕥</i><i>🕦</i><i>🕧</i><i>🤩</i><i>🤨</i><i>🤯</i><i>🤪</i><i>🤬</i><i>🤮</i><i>🤫</i><i>🤭</i><i>🧐</i><i>🧒</i><i>🧑</i><i>🧓</i><i>🧕</i><i>🧔</i><i>🤱</i><i>🧙‍♀️</i><i>🧙‍♂️</i><i>🧚‍♀️</i><i>🧚‍♂️</i><i>🧛‍♀️</i><i>🧛‍♂️</i><i>🧜‍♀️</i><i>🧜‍♂️</i><i>🧝‍♀️</i><i>🧝‍♂️</i><i>🧞‍♀️</i><i>🧞‍♂️</i><i>🧟</i><i>🧟‍♀️</i><i>🧟‍♂️</i><i>🧖</i><i>🧖‍♀️</i><i>🧖‍♂️</i><i>🧗‍♀️</i><i>🧗‍♂️</i><i>🧘‍♀️</i><i>🧘‍♂️</i><i>🤟</i><i>🤲</i><i>🧠</i><i>🧡</i><i>🧣</i><i>🧤</i><i>🧥</i><i>🧦</i><i>🧢</i><i>🦓</i><i>🦒</i><i>🦔</i><i>🦕</i><i>🦖</i><i>🦗</i><i>🥥</i><i>🥦</i><i>🥨</i><i>🥩</i><i>🥪</i><i>🥣</i><i>🥫</i><i>🥟</i><i>🥠</i><i>🥡</i><i>🥧</i><i>🥤</i><i>🥢</i><i>🛸</i><i>🛷</i><i>🥌</i></div>';
}
