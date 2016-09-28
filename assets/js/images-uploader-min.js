"use strict";
function resetBehaviors(e) {
    e.stopPropagation(), e.preventDefault()
}
function inArray(e, t) {
    return t.indexOf(e) > -1
}
function formatFileSize(e) {
    var t, a;
    return e > 999999999 ? (t = (e / 1e9).toFixed(1), a = "GB") : e > 999999 ? (t = (e / 1e6).toFixed(1), a = "MB") : e > 999 ? (t = (e / 1e3).toFixed(0), a = "kB") : (t = e, a = "B"), {value: t, unit: a}
}
function getPhotosFromGallery(e) {
    resetBehaviors(e);
    for (var t = document.querySelectorAll("#galleries ul li a"), a = 0; a < t.length; a++)
        t[a].parentElement.removeAttribute("class");
    e.target.parentElement.setAttribute("class", "active");
    var n = new XMLHttpRequest;
    n.onreadystatechange = function () {
        4 === this.readyState && 200 === this.status && (document.getElementById("images-list").innerHTML = n.responseText, updateEventsListeners())
    }, n.open("GET", "images-uploader.php?gallery=" + e.target.parentElement.id, !0), n.send(null)
}
function handleChangeGallery(e) {
    var t = new XMLHttpRequest;
    t.onreadystatechange = function () {
        4 === this.readyState && 200 === this.status && (document.getElementById("images-list").innerHTML = t.responseText, updateEventsListeners())
    }, t.open("GET", "images-uploader.php?id=" + e.dataTransfer.getData("id") + "&fromgallery=" + document.querySelector(".active").id + "&togallery=" + e.target.id), t.send(null)
}
function updateEventsListeners() {
    for (
            var e = document.querySelectorAll("#galleries ul li a"), t = document.querySelectorAll("#images-list li"), a = 0; a < e.length; a++)
        e[a].addEventListener("click", getPhotosFromGallery, !1), 0 !== a && (e[a].parentElement.addEventListener("dragover", resetBehaviors, !1), e[a].parentElement.addEventListener("drop", handleChangeGallery, !1));
    for (a = 0; a < t.length; a++)
        t[a].addEventListener("dragstart", galleriesListDroppableStyle.add), t[a].addEventListener("dragend", galleriesListDroppableStyle.remove)
}

function formatImagePreview(e) {
    if (uploadQueue.length <= 3 && uploadQueue.length > 0) {
        var t = uploadQueue.indexOf(e), a = e.name, n = formatFileSize(e.size).value, r = formatFileSize(e.size).unit, l = document.createElement("li");
        l.setAttribute("id", "image-" + t);
        var i = document.getElementById("image-preview").appendChild(l);

        return function () {
            i.innerHTML = '<ul><li class="image-thumbnail"><img src="' + URL.createObjectURL(e) + '"></li><li class="image-infos"><ul><li class="image-name">' + a + '</li><li class="image-size"><span id="upload-progress-size-' + t + '">0</span> ' + r + " of " + n + " " + r + '</li><li><progress id="upload-progress-bar-' + t + '" value="0" max="100"></progress></li></ul></li></ul>'
        }
    } else if (uploadQueue.length > 3) {
        {

            alert("only 3 images can be uploaded");
        }
    }
}
function handleImagePreview(e) {
    resetBehaviors(e);
    for (var t = e.target.files || e.dataTransfer.files, a = 0; a < t.length; a++) {
        var n = t[a], r = new FileReader;
        n.type.match("image.*") && (uploadQueue.push(n), r.onloadend = formatImagePreview(n), r.readAsDataURL(n))
    }

}
function handleUpload(e) {
    function t(e, t, a) {
        document.getElementById("upload-progress-bar-" + e).value = t, document.getElementById("upload-progress-size-" + e).innerHTML = formatFileSize(a).value
    }
    resetBehaviors(e), uploadQueue.forEach(function (e, a) {
        var n = new FormData, r = new XMLHttpRequest;
        n.append("galleries-names", document.getElementById("galleries-names").value), n.append("upload-input[]", e), r.upload.addEventListener("progress", function (e) {
            t(a, e.loaded / e.total * 100, e.loaded), document.getElementById("upload-submit").value = "Upload"
        }, !1), r.upload.addEventListener("load", function (e) {
            t(a, 100, e.total)
        }, !1), r.addEventListener("readystatechange", function () {
            if (4 === this.readyState && 200 === this.status) {
                document.getElementById("upload-progress-size-" + a).parentElement.innerHTML = "Successfully uploaded";
                for (var e = JSON.parse(r.responseText), t = 0; t < e[1].length; t++) {
                    var n = document.createElement("li"), l = document.createElement("a");
                    n.id = e[1][t], n.appendChild(l), l.setAttribute("href", "#"), l.innerHTML = e[1][t], l.addEventListener("click", getPhotosFromGallery, !1), document.getElementById("galleries-list").appendChild(n)
                }
                if (inArray(document.querySelector(".active").id, e[2])) {
                    var i = document.createElement("li");
                    i.innerHTML = e[0], document.getElementById("images-list").appendChild(i)
                }
                document.getElementById("image-preview").removeChild(document.getElementById("image-" + a)), document.getElementById("upload-submit").value = "Submit", updateEventsListeners()
            }
        }, !1), r.open("POST", "images-uploader.php", !0), r.send(n)
    }), uploadQueue = []
}
var uploadQueue = [], galleriesListDroppableStyle = {add: function (e) {
        var t = document.querySelectorAll("#galleries ul li a");
        e.dataTransfer.setData("id", e.target.id);
        for (var a = 1; a < t.length; a++)
            t[a].parentElement.classList.add("drop-zone")
    }, remove: function () {
        for (var e = document.querySelectorAll("#galleries ul li a"), t = 1; t < e.length; t++)
            e[t].parentElement.classList.remove("drop-zone")
    }};
document.getElementById("upload-drop-zone").addEventListener("dragenter", resetBehaviors), document.getElementById("upload-drop-zone").addEventListener("dragover", resetBehaviors), document.getElementById("upload-drop-zone").addEventListener("drop", handleImagePreview), document.getElementById("upload-input").addEventListener("change", handleImagePreview), document.getElementById("upload-submit").addEventListener("click", handleUpload), updateEventsListeners();
