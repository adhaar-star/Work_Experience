/**
 * Helper functions.
 */

/**
 * Create a cookie in client.
 * 
 * @param {string} name
 * @param {mixed} value
 * @param {int} days
 */
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

/**
 * Read cookie from client.
 * 
 * @param {string} name
 * @returns {mixed}
 */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/**
 * Delete cookie from client.
 * 
 * @param {string} name
 */
function eraseCookie(name) {
    createCookie(name, "", -1);
}

/**
 * Set token header for api requests
 * 
 * @param {xhr} xhr
 */

function setHeader(xhr) {

    var token = readCookie('token');
    xhr.setRequestHeader('token', token);

}

var MonthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];


/**
 * Get current date time of selected timezone
 * @author Raman Kumar 
 * @date 10 Feb, 2018
 */
function getCurrentDateTimeByTimezoneId(data) {

    return requestApi({
        url: Routes.getCurrentDateTimeByTimezoneId,
        verb: 'POST',
        data: JSON.stringify(data.body),
    });
}


/**
 *
 *  Function is login user api call
 * @author Loveleen 
 * @date 9 Jan, 2018
 */
function login(data) {

    return requestApi({
        url: Routes.Api.login,
        verb: 'POST',
        data: JSON.stringify(data.body),
        mainSelector: '.modal-content'
    });
}

/**
 *
 *  Function is regenrate user password
 * @author Loveleen 
 * @date 9 Jan, 2018
 */
function regeneratePassword(data) {

    return requestApi({
        url: Routes.Api.regeneratePassword,
        verb: 'POST',
        data: JSON.stringify(data.body),
        mainSelector: '.modal-content'
    });
}

/**
 *
 *  Function to reset password
 * @author Loveleen 
 * @date 10 Jan, 2018
 */
function resetPassword(data) {

    return requestApi({
        url: Routes.Api.resetPassword,
        verb: 'POST',
        data: JSON.stringify(data.body),
        mainSelector: '.modal-content'
    });
}

// Function for user logout
function logout(data) {

    return requestApi({
        url: Routes.Api.logout,
        verb: 'GET',
        data: JSON.stringify(data),
    });
}

/**
 *
 *  Function is admin login api call
 * @author Loveleen 
 * @date 10 Jan, 2018
 */
function adminLogin(data) {

    return requestApi({
        url: Routes.Api.adminlogin,
        verb: 'POST',
        data: JSON.stringify(data.body),
    });
}

function candidateregister(data) {

    return requestApi({
        url: Routes.Api.candidateregister,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function candidateupdate(data) {

    return requestApi({
        url: Routes.Api.candidateupdate,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function candidateEditVideo(data) {

    return requestApi({
        url: Routes.Api.candidatevideo,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

 function applywithgist(data){
    return requestApi({
        url: Routes.Api.candidateAutoApply,
        verb: 'POST',
        data: JSON.stringify(data.body),
        mainSelector: '.modal-content'
    });

}

function candidateChangeQues(data){
    return requestApi({
        url: Routes.Api.candidateChangeQues,
        verb: 'POST',
        data: JSON.stringify(data.body),
        mainSelector: '.modal-content'
    });

}

function employerRegisteration(data){
    return requestApi({
        url: Routes.Api.employerRegisteration,
        verb: 'POST',
        data: JSON.stringify(data.body),
       // mainSelector: '.modal-content'
    });

}

function employerCreatePdf(data){
    return requestApi({
        url: Routes.Api.employerCreatePdf,
        verb: 'POST',
        data: JSON.stringify(data.body),
       // mainSelector: '.modal-content'
    });

}

function filterCandidates(data){
    return requestApi({
        url: Routes.Api.filterCandidates,
        verb: 'POST',
        data: JSON.stringify(data.body),
        async: false
       // mainSelector: '.modal-content'
    });

}

function updateVideoViews(data) {

    return requestApi({
        url: Routes.Api.updateVideoViews,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function updateVideoSaves(data) {

    return requestApi({
        url: Routes.Api.updateVideoSaves,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function updateVideoShares(data) {

    return requestApi({
        url: Routes.Api.updateVideoShares,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function createResumePdf(data) {

    return requestApi({
        url: Routes.Api.createResumePdf,
        verb: 'POST',
        data: JSON.stringify(data.body),
        //mainSelector: '.modal-content'
    });
}

function requestView(params) {

    if (params.mainSelector != null) {

        showLoader(params.mainSelector);
    }

    return $.ajax({
        url: params.url,
        type: params.verb,
        data: params.data,
        success: function (view) {

        },
        error: function () {

            hideLoader(params.mainSelector);
            toastr.error('Server error: Try again later.');
        }
    });

}

function requestFormApi(params) {

    if (params.mainSelector != null) {

        showLoader(params.mainSelector);

    }

    return $.ajax({
        url: params.url,
        type: params.verb,
        dataType: 'json',
        data: params.data,
        contentType: false,
        processData: false,
        success: function (jsonObj) {

            if (!jsonObj.meta.success) {

                if (jsonObj.data.errors.type == 'validation') {

                    var errors = '';
                    $(jsonObj.data.errors.array).each(function (i, t) {
                        for (var key in t) {
                            if (t.hasOwnProperty(key)) {
                                $(t[key]).each(function (index, item) {
                                    errors += item + '<br \>';
                                });
                            }
                        }
                    });
                    toastr.error(errors, 'Error: ', {timeOut: 10000});
                } else {
                    toastr.error(jsonObj.data.errors.message, 'Error: ', {timeOut: 10000});
                }

                hideLoader(params.mainSelector);
            }
        },
        error: function () {

            hideLoader(params.mainSelector);
            toastr.error('Server error: Try again later.');
        }
    });

}

function requestApi(params) {

    if (params.mainSelector != null) {

        showLoader(params.mainSelector);

    }

    return $.ajax({
        url: params.url,
        type: params.verb,
        dataType: 'json',
        data: params.data,
        async: (typeof(params.async) != "undefined" && params.async !== null) ? params.async : true,
        jsonp: false,
        success: function (jsonObj) {

            if (!jsonObj.meta.success) {

                if (jsonObj.data.errors.type == 'validation') {

                    var errors = '';
                    $(jsonObj.data.errors.array).each(function (i, t) {
                        for (var key in t) {
                            if (t.hasOwnProperty(key)) {
                                $(t[key]).each(function (index, item) {
                                    errors += item + '<br \>';
                                });
                            }
                        }
                    });
                   console.log("aaaa") 
                    toastr.error(errors, 'Error: ', {timeOut: 10000});
                } else {
                    console.log(jsonObj) 
                    toastr.error(jsonObj.data.errors.message, 'Error: ', {timeOut: 10000});
                }

                hideLoader(params.mainSelector);
            }
        },
        error: function () {

            hideLoader(params.mainSelector);
            toastr.error('Server error: Try again later.');
        }
    });

}

function requestApiForGet(params) {

    if (params.mainSelector != null) {

        showLoader(params.mainSelector);

    }

    return $.ajax({
        url: params.url,
        type: params.verb,
        dataType: 'json',
        jsonp: false,
        success: function (jsonObj) {

            if (!jsonObj.meta.success) {

                toastr.error(jsonObj.data.errors.message, 'Error: ', {timeOut: 10000});

                hideLoader(params.mainSelector);
            }
        },
        error: function () {

            hideLoader(params.mainSelector);
            toastr.error('Server error: Try again later.');
        }
    });

}

function showLoader(selector) {

    var loaderHtml;
    //$(selector).css({'height': '100%', 'position': 'relative', 'min-height': '80px'});
    loaderHtml = '<div class="loader_box">';
    loaderHtml += '<div class="vertical_align_table">';
    loaderHtml += '<div class="vertical_align_table_inner">';
    loaderHtml += '<div class="loader loader-5">';
    loaderHtml += '</div>';
    //loaderHtml += '<p>Please be patience...</p>';
    loaderHtml += '</div>';
    loaderHtml += '</div>';
    loaderHtml += '</div>';

    $('.loader_box').remove();
    $(selector).append(loaderHtml);
    $(selector + ' .loader_box').fadeIn();
}

function hideLoader(selector) {
    $(selector + ' .loader_box').fadeOut();
}


var decodeEntities = (function () {
    // this prevents any overhead from creating the object each time
    var element = document.createElement('div');

    function decodeHTMLEntities(str) {
        if (str && typeof str === 'string') {
            // strip script/html tags
            str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
            str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
            element.innerHTML = str;
            str = element.textContent;
            element.textContent = '';
        }

        return str;
    }

    return decodeHTMLEntities;
})();
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
var _e = function (string) {

    return htmlEntities(string.trim());
}
$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
$.fn.scrollView = function () {
    return this.each(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top
        }, 1000);
    });
}

function abbreviateNumber(value) {
    var newValue = value;
    if (value >= 1000) {
        var suffixes = ["", "k", "m", "b", "t"];
        var suffixNum = Math.floor(("" + value).length / 3);
        var shortValue = '';
        for (var precision = 2; precision >= 1; precision--) {
            shortValue = parseFloat((suffixNum != 0 ? (value / Math.pow(1000, suffixNum)) : value).toPrecision(precision));
            var dotLessShortValue = (shortValue + '').replace(/[^a-zA-Z 0-9]+/g, '');
            if (dotLessShortValue.length <= 2) {
                break;
            }
        }
        if (shortValue % 1 != 0)
            shortNum = shortValue.toFixed(1);
        newValue = shortValue + suffixes[suffixNum];
    }
    return newValue;
}

function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

