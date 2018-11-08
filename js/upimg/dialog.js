function urlarray(str) {
    var newArray = new Array();
    var urlarrayStr = str.split("&");
    var valname = null;
    for (var i = 0; i < urlarrayStr.length; i++) {
        valname = urlarrayStr[i].split("=");
        newArray[valname[0]] = decodeURIComponent(valname[1]);
    }
    return newArray;
}

function addpicshow(filename, getbyid, iswidth,width,height) {
    var src_tex = filename;
	$("#" + getbyid).children('img').removeAttr("width");
	$("#" + getbyid).children('img').removeAttr("height");
	$("#" + getbyid).removeAttr("width");
	$("#" + getbyid).removeAttr("height");
	$("#" + getbyid).children('img').attr({
            src: src_tex,
			width: 150
            //height: height
        });
	$("#" + getbyid).children('img').css("width",width);
	$("#" + getbyid).children('img').css("height",height);
	$("#" + getbyid).css("width",width);
	$("#" + getbyid).css("height",height);
	//alert($("#" + getbyid).children('img'));
    /*if (iswidth == 1) {
        $("#" + getbyid).children('img').removeAttr("height");
        $("#" + getbyid).children('img').attr({
            src: src_tex,
            width: width
        })
    } else {
        $("#" + getbyid).children('img').removeAttr("width");
        $("#" + getbyid).children('img').attr({
            src: src_tex,
            height: height
        });
    }*/
}

function windowsdig(title, content, width, height, cssName, isclose, iftype) {
    var temp_float = "<div id=\"floatBoxBg\" style=\"height:" + $('body').height() + "px;filter:alpha(opacity=0);opacity:0;\"></div>";
    iftype = !iftype ? 'no': 'aoto';
    temp_float += "<div id=\"floatBox\" class=\"floatBox\"><div id=\"headtitle\">";
    if (isclose == false) {
        temp_float += "<div class=\"title\" id=\"titlediv\"><span id=\"icon\"></span><h4></h4><span></span></div>"
    } else {
        temp_float += "<div class=\"title\"><span id=\"icon\"></span><h4></h4><span><b><a title=\"关闭窗口\" id=\"iconclose\"></a></b></span></div>"
    }
    temp_float += "</div><div id=\"dialogcontentlist\" class=\"content\"></div>";
    temp_float += "</div>";
    $("body").append(temp_float);
    var w = parseInt(width) - 10;
    $("#floatBox .content").css({
        width: w
    });
    $("#floatBox .title a").click(function() {
        if (/msie/.test(navigator.userAgent.toLowerCase()) ){
            self.frames["diglogfirameclass"].location = 'javascript:false'
        }
        $("#floatBoxBg").remove();
        $("#floatBox").remove()
    });
    $("#floatBox .title h4").html(title);
    var contentType = content.substring(0, content.indexOf(":"));
    content = content.substring(content.indexOf(":") + 1, content.length);
    switch (contentType) {
    case "url":
        var content_array = content.split("?");
        $("#floatBox .content").ajaxStart(function() {
            $(this).html("loading...")
        });
        $.ajax({
            type: content_array[0],
            url: content_array[1],
            data: content_array[2],
            error: function() {
                $("#floatBox .content").html("error...")
            },
            success: function(html) {
                $("#floatBox .content").html(html)
            }
        });
        break;
    case "text":
        $("#floatBox .content").html(content);
        break;
    case "id":
        $("#floatBox .content").html($("#" + content + "").html());
        break;
    case "iframe":
        content = content + '&digheight=' + (parseInt(height) - 30);
        $("#dialogcontentlist").html("<iframe name=\"diglogfirameclass\" id=\"diglogfirameclass\" src=\"" + content + "\" width=\"100%\" height=\"520px" + (parseInt(height) - 30) + "px" + "\" scrolling=\"" + iftype + "\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>")
    }
    $("#floatBoxBg").show();
    $("#floatBoxBg").animate({
        opacity: "0.4"
    },
    "fast");
    $("#floatBox").show();
    var st = document.body.scrollTop ? document.body.scrollTop: document.documentElement.scrollTop;
    var box01 = ((document.documentElement.clientHeight - (parseInt(height) + 13)) / 2) + st;
    var client_width = document.body.clientWidth;
    var left = (client_width - (parseInt(width) + 2)) / 2;
    $("#floatBox").css({
        left: parseInt(left) + "px",
        top: parseInt(box01) + "px",
        width: width
    });
    $("#floatBox").attr("class", "floatBox " + cssName);
    var divdialog = document.getElementById('floatBox');
    var checkdialog = document.getElementById('headtitle');
    DragAndDrop.Register(divdialog, checkdialog)
}
function closeifram() {
    if (/msie/.test(navigator.userAgent.toLowerCase()) ){
        self.frames["diglogfirameclass"].location = 'javascript:false'
    }
    $("#floatBoxBg").remove();
    $("#floatBox").remove()
}

function windowsclass(clikeclass, opendivclass, clikeclass02, opendivclass02, vallist, taplen, stylename, overstylename) {
    $(clikeclass).removeClass(overstylename).addClass(stylename);
    $(opendivclass).show();
    var openid = '';
    var opendivid = '';
    for (i = 1; i <= taplen; i++) {
        if (i != vallist) {
            openid = openid + '#' + clikeclass02 + i + ',';
            opendivid = opendivid + '#' + opendivclass02 + i + ','
        }
    }
    openid = openid + '#neiow';
    opendivid = opendivid + '#neiow';
    $(opendivid).hide();
    $(openid).removeClass(stylename).addClass(overstylename)
}


var DragAndDrop = function() {
    var _clientWidth;
    var _clientHeight;
    var _controlObj;
    var _dragObj;
    var _flag = false;
    var _dragObjCurrentLocation;
    var _mouseLastLocation;
    var getElementDocument = function(element) {
        return element.ownerDocument || element.document
    };
    var dragMouseDownHandler = function(evt) {
        if (_dragObj) {
            evt = evt || window.event;
            _clientWidth = document.body.clientWidth;
            _clientHeight = document.documentElement.scrollHeight;
            _flag = true;
            _dragObjCurrentLocation = {
                x: $(_dragObj).offset().left,
                y: $(_dragObj).offset().top
            };
            _mouseLastLocation = {
                x: evt.screenX,
                y: evt.screenY
            };
            $(document).bind("mousemove", dragMouseMoveHandler);
            $(document).bind("mouseup", dragMouseUpHandler);
            if (evt.preventDefault) {
                evt.preventDefault()
            } else {
                evt.returnValue = false
            }
        }
    };
    var dragMouseMoveHandler = function(evt) {
        if (_flag) {
            evt = evt || window.event;
            var _mouseCurrentLocation = {
                x: evt.screenX,
                y: evt.screenY
            };
            _dragObjCurrentLocation.x = _dragObjCurrentLocation.x + (_mouseCurrentLocation.x - _mouseLastLocation.x);
            _dragObjCurrentLocation.y = _dragObjCurrentLocation.y + (_mouseCurrentLocation.y - _mouseLastLocation.y);
            _mouseLastLocation = _mouseCurrentLocation;
            $(_dragObj).css("left", _dragObjCurrentLocation.x + "px");
            $(_dragObj).css("top", _dragObjCurrentLocation.y + "px");
            if (evt.preventDefault) {
                evt.preventDefault()
            } else {
                evt.returnValue = false
            }
        }
    };
    var dragMouseUpHandler = function(evt) {
        if (_flag) {
            evt = evt || window.event;
            cleanMouseHandlers();
            _flag = false
        }
    };
    var cleanMouseHandlers = function() {
        if (_controlObj) {
            $(_controlObj.document).unbind("mousemove");
            $(_controlObj.document).unbind("mouseup")
        }
    };
    return {
        Register: function(dragObj, controlObj) {
            _dragObj = dragObj;
            _controlObj = controlObj;
            $(_controlObj).bind("mousedown", dragMouseDownHandler)
        }
    }
} ();