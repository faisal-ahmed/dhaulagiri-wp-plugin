<script src="<?php echo getMyPluginUrl() ?>static/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.structure.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.theme.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>countrySelect/css/countrySelect.min.css"/>

<script src="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.js"></script>
<script src="<?php echo getMyPluginUrl() ?>countrySelect/js/countrySelect.min.js"></script>

<?php
if (isset($redirect_to)) { ?>
    <script>
        setTimeout(function(){
            window.location.replace("<?php echo $redirect_to; ?>");
        }, 2000);
    </script>
<?php } else { ?>
<div id="dhaulagiri_plugin_page_form">
    <form method="post" enctype="multipart/form-data" action="<?php echo $form_booking_url ?>" id="monthSelectForm" onsubmit="return submitForm();">
        <input type="hidden" name="booking" value="Y"/>
        <input type="hidden" name="additionalMember" id="additionalMember"/>
        <fieldset>
            <p>All of the fields are required.</p>
            <p>
                <label for="group_name">Trekking Title:</label>
                <input id="group_name" type="text" name="group_name" required/>
            </p>
            <p>
                <label for="full_name">Full Name:</label>
                <input id="full_name" type="text" name="full_name" required/>
            </p>
            <p>
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required/>
            </p>
            <p>
                <label for="gender">Gender:</label><br/>
                <select name="gender" id="gender" style="width: 35%;">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </p>
            <p>
                <label for="itinerary">Itinerary:</label><br/>
                <select name="itinerary" id="itinerary" style="width: 35%;">
                    <?php echo get_option("dhaulagiri_itinerary_options"); ?>
                </select>
            </p>
            <p>
                <label for="package">Package:</label><br/>
                <select name="package" id="package" style="width: 35%;">
                    <?php echo get_option("dhaulagiri_package_options"); ?>
                </select>
            </p>
            <p>
                <label for="picture">Picture of the Trekker:</label>
                <input type="file" name="picture" id="picture" required/>
            </p>
            <p>
                <label for="age">Age:</label>
                <input id="age" type="text" name="age" required/>
            </p>
            <p>
                <label for="nationality">Nationality:</label><br/>
                <input id="nationality" type="text" name="nationality" required/>
            </p>
            <p>
                <label for="lang">Language:</label>
                <input id="lang" type="text" name="lang" required/>
            </p>
            <p>
                <label for="arriving_on">Arriving On:</label>
                <input id="arriving_on" type="text" name="arriving_on" required/>
            </p>
            <p>
                <label for="departing_on">Departing On:</label>
                <input id="departing_on" type="text" name="departing_on" required/>
            </p>
            <p>
                <label for="prev_hiking_exp">Previous Hiking Experience:</label>
                <textarea id="prev_hiking_exp" name="prev_hiking_exp" required></textarea>
            </p>
            <p>
                <label for="short_intro">Short Introduction:</label>
                <textarea id="short_intro" name="short_intro" required></textarea>
            </p>
        </fieldset>
        <div id="additionalMembers" style="display: block"></div>
        <p id="addNew">
            <a class="submit_style_link" href="javascript:void(0)" onclick="addNew()">Add More Members</a>
        </p>
        <p>
            <a class="submit_style_link" href="javascript:void(0)" onclick="window.history.back()">Back</a>&nbsp;&nbsp;
            <input type="submit" id="submitButton" value="Book Your Date"/>
        </p>
    </form>
</div>

<script>
    var newMembers = ["newMember1", "newMember2", "newMember3", "newMember4", "newMember5"];
    var addedMembers = [];
    var country = '';
    $(function() {
        $.get("http://ipinfo.io", function(response) {
            country = response.country;
            country = country.toLowerCase();

            $("#nationality").countrySelect({
                defaultCountry: country,
                //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                //preferredCountries: ['ca', 'gb', 'us', 'bd', 'np', 'in']
                preferredCountries: []
            });

        }, "jsonp");

        $( "#arriving_on" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
        $( "#departing_on" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
    });

    function addNew(){
        if (newMembers.length <= 0) {
            alert("Sorry! You can add maximum of 5 additional members with you.")
        } else {
            var newMemID = newMembers.pop();
            //var newMem = $("#newMember").clone();
            var newMem = getHtml(newMemID);
            //newMem.attr("id", newMemID);
            $("#additionalMembers").append(newMem);
            $('#nationality' + newMemID).countrySelect({
                //defaultCountry: "jp",
                //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                preferredCountries: ['ca', 'gb', 'us', 'bd', 'np', 'in']
            });

            $("#" + newMemID).slideToggle();
            addedMembers.push(newMemID);
        }
        if (newMembers.length == 0) {
            $("#addNew").slideToggle();
        }
    }

    function removeMem(e){
        var parent = $(e).parents("fieldset");
        var ID = parent.attr("id");
        if (confirm("Are you sure to remove this member from your team?")){
            parent.slideDown();
            parent.remove();
            newMembers.push(ID);
            var i = addedMembers.indexOf(ID);
            if(i != -1) {
                addedMembers.splice(i, 1);
            }
        }
        if (newMembers.length > 0 && $("#addNew").is(":visible") == false) {
            $("#addNew").slideToggle();
        }
    }

    function getHtml(i){
        var str =
            '<fieldset style="display: none;" id="' + i + '">'+
                '<p>'+
                    '<label for="full_name' + i + '">Full Name:</label>'+
                    '<input id="full_name' + i + '" type="text" name="full_name' + i + '" required/>'+
                '</p>'+
                '<p>'+
                    '<label for="email' + i + '">Email:</label>'+
                    '<input id="email' + i + '" type="email" name="email' + i + '" required/>'+
                '</p>'+
                '<p>'+
                    '<label for="gender' + i + '">Gender:</label>'+
                    '<select name="gender' + i + '" id="gender' + i + '" style="width: 35%;">'+
                        '<option value="M">Male</option>'+
                        '<option value="F">Female</option>'+
                    '</select>'+
                '</p>'+
                '<p>'+
                    '<label for="picture' + i + '">Picture of the Trekker:</label>'+
                    '<input type="file" name="picture' + i + '" id="picture' + i + '" required/>'+
                '</p>'+
                '<p>'+
                    '<label for="age' + i + '">Age:</label>'+
                    '<input id="age' + i + '" type="text" name="age' + i + '" required/>'+
                '</p>'+
                '<p>'+
                    '<label for="nationality' + i + '">Nationality:</label><br/>'+
                    '<input id="nationality' + i + '" type="text" name="nationality' + i + '" required/>'+
                '</p>'+
                '<p>'+
                    '<label for="prev_hiking_exp' + i + '">Previous Hiking Experience:</label>'+
                    '<textarea id="prev_hiking_exp' + i + '" name="prev_hiking_exp' + i + '" required></textarea>'+
                '</p>'+
                '<p>'+
                    '<label for="short_intro' + i + '">Short Introduction:</label>'+
                    '<textarea id="short_intro' + i + '" name="short_intro' + i + '" required></textarea>'+
                '</p>'+
                '<p>'+
                    '<a class="submit_style_link" href="javascript:void(0)" onclick="removeMem(this)">Remove This Member</a>'+
                '</p>'+
            '</fieldset>';
        return str;
    }

    function submitForm(){
        var i, str = '';
        for (i = 0; i < addedMembers.length; i++){
            str += ((str == '') ? addedMembers[i] : (", " + addedMembers[i]));
        }

        $("#additionalMember").val(str);
        return true;
    }
</script>
<?php } ?>