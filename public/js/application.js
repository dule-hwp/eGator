function displayItems(jsonRes, $itemContainer) {
    // var $items = $('#items');
    $itemContainer.empty();
    var $product = $('#hidden_product');

    $.each(jsonRes, function (idx, item) {
        // console.log(url + item.image);
        $product.find('.thumbnail').attr('id', item.item_id);
        $product.removeClass('hidden');
        $product.find('.img-thumbnail').attr("src", IMAGE_FOLDER_PATH + item.thumbnail);
        $product.find('.caption h4').html(item.item_name);
        // $product.find('.caption p').html(item.description);
        $product.find('.caption .row p').html("$" + item.price);
        $product.find('.btn-success').attr('id', item.item_id);
        // $.each($product.find('.view-item'), function () {
        //     // this.href = url + API_VIEW_ITEM + item.item_id;
        // });

        $itemContainer.append($product.html());
    });
    $product.addClass('hidden');
}

function sanitizeString(str) {
    str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim, "");
    return str.trim();
}

function getFilterDataJson() {
    var search = $('#main-search').val();
    search = sanitizeString(search);
    $('#main-search').val(search);

    var cat_id = $('#side-filter-category-id').length > 0 ? $('#side-filter-category-id').val() : "-1";
    var price_from = $('#price_from').length > 0 ? $('#price_from').val() : '';
    var price_to = $('#price_to').length > 0 ? $('#price_to').val() : '';

    var jsonFilterData = {};
    jsonFilterData.searchTerm = search;
    jsonFilterData.category_id = cat_id;
    jsonFilterData.price_from = price_from === '' ? -1 : price_from;
    jsonFilterData.price_to = price_to === '' ? -1 : price_to;

    return jsonFilterData;
}

function filterItems() {

    var jsonFilterData = getFilterDataJson();

    if ($('#items').length !== 1) {
        submit_post(url + POST_ITEMS_HOME, jsonFilterData, 'post');
        return;
    }

    var data = JSON.stringify(jsonFilterData);
    // console.log(data);
    // return;
    $.post(url + API_SEARCH_ITEMS, data)
        .done(function (result) {
            var jsonRes = JSON.parse(result);
            displayItems(jsonRes, $("#items"));
            $("#display-items-num strong").html("Displaying " + jsonRes.length + " items");
            $("#welcome-message").addClass("hide");
        })
        .fail(function () {
            // this will be executed if the ajax-call had failed
            alert('error in ' + API_SEARCH_ITEMS + " api call");
        })
        .always(function () {
            // this will ALWAYS be executed, regardless if the ajax-call was success or not
        });
}


function viewItem(itemId) {
    console.log(itemId);
}

function logout() {
    $.ajax(url + API_LOGOUT)
        .done(function (result) {
            // console.log('logged out.. ', result);

            window.location.replace(url);
        })
        .fail(function () {
            // this will be executed if the ajax-call had failed
            alert('error in ' + API_LOGOUT + ' api call');
        });


    $('#navbar .dropdown').addClass('hide');
    $('#login-btn-container').removeClass('hide');
}
function login() {
    $('#navbar .dropdown').removeClass('hide');
    $('#login-btn-container').addClass('hide');
}

function sendRecentItemsReq() {
    var numOfItems = 9;
    $.ajax(url + API_GET_RECENLY_ADDED_ITEMS_BY_NUMBER + numOfItems)
        .done(function (result) {
            var items = JSON.parse(result);
            displayItems(items, $('#items'));
            var text = "Displaying last " + items.length + " item";
            text += items.length > 1 ? "s" : "";
            text += " added.";
            // text+=" added in last " + numOfItems + " hour";
            // text+= numOfItems>1 ? "s." : ".";
            $("#display-items-num strong").html(text);
        })
        .fail(function () {
            // this will be executed if the ajax-call had failed
            alert('error in ' + API_LOGOUT + ' api call');
        });
}

$(function () {
    // if ($('#items').length==1)
    // {
    //     sendRecentItemsReq();
    // }

    if ($('.form-control').length !== 0) {

        $('.form-control').keypress(function (event) {
            // console.log(event.originalEvent.code, event.which);
            if (event.originalEvent.code == 'Enter') {
                if (this.getAttribute('id') === "main-search") {
                    event.preventDefault();
                    filterItems();
                }
                else {
                    $('#' + this.form.id + ' :submit').click();
                    // this.click();
                }
            }
        });
        // $('#search').on(function () {
        //     filter(event);
        // });
    }

    //search category drop down
    $(".btn-select").each(function (e) {
        var selected = $(this).find("ul li.selected");
        if (selected != undefined && selected.length > 0) {
            $(this).find(".btn-select-input").val(selected[0].id);
            $(this).find(".btn-select-value").html(selected.html());
        }
    });

    if ($('.nav-sidebar li').length !== 0) {

        $('.nav-sidebar li').on('click', function (e) {

            e.preventDefault();
            var target = $(this);
            target.addClass("active").siblings().removeClass("active");
            var filter_selector = "#side-filter-category-id";
            $(filter_selector).val(this.id);
            // $(this).find(filter_selector).html(value);
            filterItems();
        });
    }

});

$(document).on('click', '.view-item'
    , function (e) {
        e.preventDefault();
        var filterDataJson = getFilterDataJson();
        filterDataJson.item_id = this.parentNode.id !== "" ? this.parentNode.id : this.parentNode.parentNode.id;
        filterDataJson.back_url = window.location.href;
        console.log(filterDataJson);
        submit_post(url + POST_VIEW_ITEM, filterDataJson, "post");
    });

// $(document).on('click', '#back-button', function (e) {
//     e.preventDefault();
//     submit_post(url+POST_VIEW_ITEM, filterDataJson, "post");
// });
//
// function onBackButtonClick() {
//     submit_post(url+POST_VIEW_ITEM, filterDataJson, "post");
// }

$(document).on('click', '.btn-select', function (e) {
    e.preventDefault();
    var ul = $(this).find("ul");
    if ($(this).hasClass("active")) {
        if (ul.find("li").is(e.target)) {
            var target = $(e.target);
            target.addClass("selected").siblings().removeClass("selected");
            var value = target.html();
            $(this).find(".btn-select-input").val(target[0].id);
            $(this).find(".btn-select-value").html(value);
        }
        ul.hide();
        $(this).removeClass("active");
    }
    else {
        $('.btn-select').not(this).each(function () {
            $(this).removeClass("active").find("ul").hide();
        });
        ul.slideDown(300);
        $(this).addClass("active");
    }
});

$(document).on('click', function (e) {
    var target = $(e.target).closest(".btn-select");
    if (!target.length) {
        $(".btn-select").removeClass("active").find("ul").hide();
    }
});

$("#form_add_item").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        dataType: 'json',
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (result) {
            if (result.success) {
                alertify.success(result.success, WAIT_NOTIFICATION_TIME, function () {
                    window.location.replace(url);
                });
            }
            else {
                alertify.error(result.error);
            }
        },
        error: function (xhr, err) {
            console.log('Error', xhr.responseText, err);
        }
    });
});

function callLogin() {
    $('#login-btn').click();
}

function callBuyModal() {
    $('#buyer-modal').modal();
}

function addToWishList(user_id, item_id) {
    // console.log(user_id, item_id);

    $.ajax(url + API_ADD_TO_WISH_LIST + "/" + user_id + "/" + item_id)
        .done(function (result) {
            // console.log('add to wish list res: ', result);
            result = JSON.parse(result);
            if (result.success) {
                alertify.success(result.success);
            }
            else {
                alertify.error(result.error);
                // console.log(result.error);
            }

        })
        .fail(function () {
            // this will be executed if the ajax-call had failed
            alert('error in ' + API_LOGOUT + ' api call');
        });
}

function removeFromList(remove_api, user_id, item_id) {
    // console.log(user_id, item_id);

    $.ajax(url + remove_api + "/" + user_id + "/" + item_id)
        .done(function (result) {
            // console.log('remove from wl: ', result);
            result = JSON.parse(result);
            if (result.success) {

                alertify.success(result.success, WAIT_NOTIFICATION_TIME, function () {
                    location.reload();
                });

            }
            else {
                alertify.error(result.error);
                console.log(result.error);
            }

        })
        .fail(function () {
            // this will be executed if the ajax-call had failed
            alert('error in ' + API_LOGOUT + ' api call');
        });
}

function openTermsAndConditionsDlg() {

    var checkbox = $('#register_terms_conditions');
    if (!checkbox.is(':checked')) {
        checkbox.checkbox.prop('checked', false);
        return;
    }
    alertify.confirm("Terms and conditions should be here...",
        function () {
            checkbox.prop('checked', true);
            alertify.success('Accepted');
        },
        function () {
            checkbox.prop('checked', false);
            alertify.error('Declined');
        }).setting('labels', {'ok': 'Accept', 'cancel': 'Decline'});
}

function submit_post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    console.log(params);
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

$('#back-to-search-form').on('submit', function () {
    console.log('submited');
    this.submit();
});

function submitForm() {
    $("#register_btn").click();
}

function onCancelRegistration() {
    $('#login-modal').modal('hide');
}
