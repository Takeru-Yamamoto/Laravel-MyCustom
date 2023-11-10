import * as f from "./functions";

$(function ($) {
    $(document).on("click", ".logout-btn", function () {
        $("#logout-form").trigger("submit");
    });

    $(document).on("click", ".start-spinner-btn", function () {
        f.startSpinner();
    });

    $(document).on("click", ".stop-spinner-btn", function () {
        f.stopSpinner();
    });

    $(document).on("click", ".tooltip-original", function () {
        $(this).toggleClass("tooltip-active");
    });

    $(document).on("click", ".form-submit-btn", function () {
        var formId = $(this).data("form");

        $("#" + formId).trigger("submit");
    });

    $(document).on("click", ".modal-btn", function () {
        var modalId = $(this).data("modalId");
        $("#" + modalId).modal("show");
    });

    $(document).on("click", ".ajax-modal-btn", function () {
        var url = $(this).data("url");
        var type = $(this).data("type");
        var id = $(this).data("id");
        var modalId = $(this).data("modalId");

        var callback = function (result) {
            $(".modal-marks").html(result);
            $("#" + modalId).modal("show");
        }

        f.htmlAjaxRequest(url, type, { id: id }, callback);
    });

    $(document).on("click", ".delete-btn", function () {
        var url = $(this).data("url");
        var id = $(this).data("id");

        if (confirm("該当項目を削除してよろしいですか？")) {
            var callback = function () {
                if (!alert("該当項目の削除に成功しました。")) {
                    location.reload();
                }
            }

            f.ajaxRequest(url, "POST", { id: id }, callback);
        }
    });

    $(document).on("click", ".flg-change-btn", function () {
        var url = $(this).data("url");
        var id = $(this).data("id");
        var flg = $(this).data("flg");

        var callback = function () {
            location.reload();
        }

        f.ajaxRequest(url, "POST", { id: id, flg: flg }, callback);
    });
});