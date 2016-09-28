
            function imagepreview(input) {
                if (input.files && input.files[0]) {
                    var filerd = new FileReader();
                    filerd.onload = function (e) {
                        $('#imgpreview').attr('src', e.target.result);
                    };
                    filerd.readAsDataURL(input.files[0]);
                }
            }


            function showTypes(str) {
                if (document.getElementById('v_cat').selectedIndex == 1) {
                    if (str == "") {
                        document.getElementById("v_type").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("v_type").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_types.php?q=" + str, true);
                    xmlhttp.send();
                }

            }

            function showDetails()
            {
                if (document.getElementById('v_cat').selectedIndex == 1) {
                    var v_type = document.getElementById('v_type').value;
                    var v_code = document.getElementById('v_code').value;
                    alert(v_type + " " + v_code);
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            alert(xmlhttp.responseText);
                            var value = xmlhttp.responseText;
                            var result_arr = value.split("#");

                            document.getElementById('m_year').value = result_arr[0];
                            document.getElementById('l_rate').value = result_arr[1];

                            if (v_code.length === 1) {
                                document.getElementById('v_no_code').maxLength = v_code.length + 1;
                            } else {
                                document.getElementById('v_no_code').maxLength = v_code.length;
                            }

                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_details.php?v_type=" + v_type + "&v_code=" + v_code, true);
                    xmlhttp.send();
                } else if (document.getElementById('v_cat').selectedIndex == 2) {
                    alert('inner');
                    var v_tw_type = document.getElementById('v_type').value;
                    var v_tw_code = document.getElementById('v_code').value;
                    alert(v_tw_type + "tw " + v_tw_code);
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                            alert(xmlhttp.responseText);
                            document.getElementById('l_rate').value = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "del.php?v_tw_type=" + v_tw_type + "&v_tw_code=" + v_tw_code, true);
                    xmlhttp.send();
                }
            }


            function set_vehicle_div(val) {
                if (val == 1) {
                    reset_form_values();
                    document.getElementById('v_brand').disabled = false;
                }
                else if (val == 2) {
                    reset_form_values();
                    document.getElementById('v_brand').disabled = true;

                    document.getElementById("v_type").innerHTML = "";
                    document.getElementById("v_type").innerHTML = "<option value='2'>2 Stroke</option><option value='4'>4 Stroke</option>";


                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('v_code').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/delete.php", true);
                    xmlhttp.send();
                }
            }
            function reset_form_values() {
                document.getElementById('v_brand').selectedIndex = "0";
                document.getElementById('v_type').selectedIndex = "0";
                document.getElementById('v_no_code').value = "";
                document.getElementById('v_no').value = "";
                document.getElementById('m_year').value = "";
                document.getElementById('l_rate').value = "";
                document.getElementById('f_rate').value = "";
            }

