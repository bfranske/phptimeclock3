<?php
/***********************************************************************
 ***                 Generic  interface functions                    ***
 ***         These are included in base project template             ***
 ***********************************************************************/

/*
 * $d Default
 * $tr      Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *          Set to -1 to not output any table elements
 */
function form_select_timezones($d = -7, $tr = true){
    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($tr !== -1 )echo '<td>Select Timezone </td>
    <td>';
    echo "
    <select name='tzOffset' size='1'>
    <option " . ($d == 0 ?   "selected='selected'" : '') . "value='0'>  Select Timezone</option>
    <option " . ($d == -11 ? "selected='selected'" : '') . "value='-11'>[GMT - 11] Niue Time, Samoa Standard Time</option>
    <option " . ($d == -10 ? "selected='selected'" : '') . "value='-10'>[GMT - 10] Hawaii - Aleutian Standard Time, Cook ...</option>
    <option " . ($d == -9 ?  "selected='selected'" : '') . "value='-9'> [GMT - 9] Alaska Standard Time, Gambier Island ...</option>
    <option " . ($d == -8 ?  "selected='selected'" : '') . "value='-8'> [GMT - 8] Pacific Standard Time</option>
    <option " . ($d == -7 ?  "selected='selected'" : '') . "value='-7'>[GMT - 7] Mountain Standard Time</option>
    <option " . ($d == -6 ?  "selected='selected'" : '') . "value='-6'> [GMT - 6] Central Standard Time</option>
    <option " . ($d == -5 ?  "selected='selected'" : '') . "value='-5'> [GMT - 5] Eastern Standard Time</option>
    </select>";
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo '</tr>';
}

/*
 * $varname Name of the variable
 * $d default
 * $id DB id of number updating
 *      If adding a number, pass as '', if ID is passed for adding it will break stuff
 * $tr  Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *      Set to -1 to not output any table elements
 */
function form_select_phone($varname, $d = 0, $id = '', $tr = true){
    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($tr !== -1) echo '<td>Type </td>
    <td>';
    echo "
    <select name='$varname' size='1'>
    <option " . ($d == '' ? "selected='selected'" : '') . "value='0'>  Select Type</option>
    <option " . ($d == 'Home' ? "selected='selected'" : '') . "value='Home$id'>Home</option>
    <option " . ($d == 'Work' ? "selected='selected'" : '') . "value='Work$id'>Work</option>
    <option " . ($d == 'Cell' ? "selected='selected'" : '') . "value='Cell$id'>Cell</option>
    <option " . ($d == 'Fax'  ? "selected='selected'" : '') . "value='Fax$id'>Fax</option>
    </select>";
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo '</tr>';
}

/*
 *  Called when building forms
 *  $tr Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *      Set to -1 to not output any table elements
 */
function form_exp_date($d_m = 0, $d_y = 0, $tr = true){
    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($tr !== -1) echo "<td>Expiration Date:*</td><td>";
    echo "<select name='CCExpMonth' size='1'>
    <option value='0' " . ($d_m == 0 ? "selected='selected'" : '') . ">Month</option>\n";
    for ($i = 1; $i < 13; $i++){
        echo "<option value='$i'" . ($d_m == $i ? "selected='selected'" : '') . ">" . ($i < 10 ? "0$i" : "$i") . "</option>\n";
    }
    echo '</select>';
    echo "
    <select name='CCExpYear' size='1'>
    <option value='0' " . ($d_y == $i ? "selected='selected'" : '') . ">Year</option>\n";
    for ($i = date('Y', time()); $i < (int)date('Y', time()) + 10; $i++){
        echo "<option value='$i' " . ($d_y == $i ? "selected='selected'" : '') . ">$i</option>\n";
    }
    echo '</select>';
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo '</tr>';
}
    
/*
 *  Called when building forms
 *  $tr Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *      Set to -1 to not output any table elements
 */

function form_cc_types($d = "", $tr = true){
    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($tr !== -1) echo '<td>Card Type:*</td><td>';
    echo "<select name='CCType' size='1'>
    <option value='0'>Please Select</option>\n";

    echo "<option value='Visa' " .              ($d == "Visa" ? "selected='selected'" : '') .            ">Visa</option>\n";
    echo "<option value='MasterCard' " .        ($d == "MasterCard" ? "selected='selected'" : '') .      ">MasterCard</option>\n";
    echo "<option value='Discover' " .          ($d == "Discover" ? "selected='selected'" : '') .        ">Discover</option>\n";
    echo "<option value='American Express' " .  ($d == "American Express" ? "selected='selected'" : '') . ">American Express</option>\n";

    echo '</select>';
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo "</tr>\n";
}

/*
 * $d   Default
 * $tr  Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *      Set to -1 to not output any table elements
 */
function form_select_state($varname, $d = 0, $tr = true){
    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($tr !== -1) echo "<td>State:*</td>
    <td>";
    echo "<select name='$varname' size='1'>
    <option " . ($d == 0    ? "selected='selected'" : '') . "value='0'></option>
    <option " . ($d == 'AL' ? "selected='selected'" : '') . "value='AL'>AL</option>
    <option " . ($d == 'AK' ? "selected='selected'" : '') . "value='AK'>AK</option>
    <option " . ($d == 'AS' ? "selected='selected'" : '') . "value='AS'>AS</option>
    <option " . ($d == 'AZ' ? "selected='selected'" : '') . "value='AZ'>AZ</option>
    <option " . ($d == 'AR' ? "selected='selected'" : '') . "value='AR'>AR</option>
    <option " . ($d == 'CA' ? "selected='selected'" : '') . "value='CA'>CA</option>
    <option " . ($d == 'CO' ? "selected='selected'" : '') . "value='CO'>CO</option>
    <option " . ($d == 'CT' ? "selected='selected'" : '') . "value='CT'>CT</option>
    <option " . ($d == 'DE' ? "selected='selected'" : '') . "value='DE'>DE</option>
    <option " . ($d == 'DC' ? "selected='selected'" : '') . "value='DC'>DC</option>
    <option " . ($d == 'FM' ? "selected='selected'" : '') . "value='FM'>FM</option>
    <option " . ($d == 'FL' ? "selected='selected'" : '') . "value='FL'>FL</option>
    <option " . ($d == 'GA' ? "selected='selected'" : '') . "value='GA'>GA</option>
    <option " . ($d == 'GU' ? "selected='selected'" : '') . "value='GU'>GU</option>
    <option " . ($d == 'HI' ? "selected='selected'" : '') . "value='HI'>HI</option>
    <option " . ($d == 'ID' ? "selected='selected'" : '') . "value='ID'>ID</option>
    <option " . ($d == 'IL' ? "selected='selected'" : '') . "value='IL'>IL</option>
    <option " . ($d == 'IN' ? "selected='selected'" : '') . "value='IN'>IN</option>
    <option " . ($d == 'IA' ? "selected='selected'" : '') . "value='IA'>IA</option>
    <option " . ($d == 'KS' ? "selected='selected'" : '') . "value='KS'>KS</option>
    <option " . ($d == 'KY' ? "selected='selected'" : '') . "value='KY'>KY</option>
    <option " . ($d == 'LA' ? "selected='selected'" : '') . "value='LA'>LA</option>
    <option " . ($d == 'ME' ? "selected='selected'" : '') . "value='ME'>ME</option>
    <option " . ($d == 'MH' ? "selected='selected'" : '') . "value='MH'>MH</option>
    <option " . ($d == 'MD' ? "selected='selected'" : '') . "value='MD'>MD</option>
    <option " . ($d == 'MA' ? "selected='selected'" : '') . "value='MA'>MA</option>
    <option " . ($d == 'MI' ? "selected='selected'" : '') . "value='MI'>MI</option>
    <option " . ($d == 'MS' ? "selected='selected'" : '') . "value='MS'>MS</option>
    <option " . ($d == 'MO' ? "selected='selected'" : '') . "value='MO'>MO</option>
    <option " . ($d == 'MT' ? "selected='selected'" : '') . "value='MT'>MT</option>
    <option " . ($d == 'NE' ? "selected='selected'" : '') . "value='NE'>NE</option>
    <option " . ($d == 'NV' ? "selected='selected'" : '') . "value='NV'>NV</option>
    <option " . ($d == 'NH' ? "selected='selected'" : '') . "value='NH'>NH</option>
    <option " . ($d == 'NJ' ? "selected='selected'" : '') . "value='NJ'>NJ</option>
    <option " . ($d == 'NM' ? "selected='selected'" : '') . "value='NM'>NM</option>
    <option " . ($d == 'NY' ? "selected='selected'" : '') . "value='NY'>NY</option>
    <option " . ($d == 'NC' ? "selected='selected'" : '') . "value='NC'>NC</option>
    <option " . ($d == 'ND' ? "selected='selected'" : '') . "value='ND'>ND</option>
    <option " . ($d == 'MP' ? "selected='selected'" : '') . "value='MP'>MP</option>
    <option " . ($d == 'OH' ? "selected='selected'" : '') . "value='OH'>OH</option>
    <option " . ($d == 'OK' ? "selected='selected'" : '') . "value='OK'>OK</option>
    <option " . ($d == 'OR' ? "selected='selected'" : '') . "value='OR'>OR</option>
    <option " . ($d == 'PW' ? "selected='selected'" : '') . "value='PW'>PW</option>
    <option " . ($d == 'PA' ? "selected='selected'" : '') . "value='PA'>PA</option>
    <option " . ($d == 'PR' ? "selected='selected'" : '') . "value='PR'>PR</option>
    <option " . ($d == 'RI' ? "selected='selected'" : '') . "value='RI'>RI</option>
    <option " . ($d == 'SC' ? "selected='selected'" : '') . "value='SC'>SC</option>
    <option " . ($d == 'TN' ? "selected='selected'" : '') . "value='TN'>TN</option>
    <option " . ($d == 'TX' ? "selected='selected'" : '') . "value='TX'>TX</option>
    <option " . ($d == 'UT' ? "selected='selected'" : '') . "value='UT'>UT</option>
    <option " . ($d == 'VT' ? "selected='selected'" : '') . "value='VT'>VT</option>
    <option " . ($d == 'VI' ? "selected='selected'" : '') . "value='VI'>VI</option>
    <option " . ($d == 'VA' ? "selected='selected'" : '') . "value='VA'>VA</option>
    <option " . ($d == 'WA' ? "selected='selected'" : '') . "value='WA'>WA</option>
    <option " . ($d == 'WV' ? "selected='selected'" : '') . "value='WV'>WV</option>
    <option " . ($d == 'WI' ? "selected='selected'" : '') . "value='WI'>WI</option>
    <option " . ($d == 'WY' ? "selected='selected'" : '') . "value='WY'>WY</option>
    </select>";
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo '</tr>';
}
/*
 * $colspan: if set, will set the colspan
 * $tr: Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *      Set to -1 to not output any table elements
 */
function form_label($label, $colspan = 10, $tr = true, $css_type = '', $class_id = 'label') {
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '') .
        "<td colspan='$colspan'" . ($css_type != '' ? " $css_type='$class_id'" : "") . "><label>$label</label></td>" .
        (($tr == 1 OR $tr == 3) ? '</tr>' : '');
}

/*
 * Outputs list for the category to view
 * $d default
 * $category is the category to list subcategories of, 0 or omit for top level
 * $tr      Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *          Set to -1 to not output any table elements
 * $label   Set to the text you want, if you want a label
 */
function form_select_category($d = 0, $category = 0, $tr = true, $label = false, $var = 'categoryID', $noShowCategory = 0){
    $categories = get_categories($category, '', 'name', false, 0, 500);

    if ($tr == 1 OR $tr == 2) echo '<tr>';
    if ($label !== false AND $tr !== -1)
        echo "<td><label>$label</label></td>";
    if ($tr !== -1) echo '<td>';
    echo "<select name='$var' size='1'>";
    echo "<option " . ($d == 0  ? "selected='selected'" : '') . "value='0'>None</option>";
    foreach ($categories as $category){
        if ($category['id'] != $noShowCategory){
            $categoryName = get_category_name($category['id']);
            if (strlen($categoryName) > 40) $categoryName = substr($categoryName, 0, 40) . '...';
            echo "<option " . ($d == $category['id']  ? "selected='selected'" : '') . "value='{$category['id']}'>$categoryName</option>";
        }
    }
    echo '</select>';
    if ($tr !== -1) echo '</td>';
    if ($tr == 1 OR $tr == 3) echo '</tr>';
}


function form_text($label, $name, $value = '', $tr = true, $size = false, $css_type = 'class', $class_id = 'textbox'){
    $value = remove_slashes($value);
    $editedLabel = trim($label, ':*');
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    if ($label != '' AND $tr !== -1){
        echo "<td><label>$label</label></td>";
    }
    if ($tr !== -1) echo '<td>';
    echo "<input type='text' name='$name' " . ($size ? "size=$size " : '') . ($css_type != '' ? (" $css_type='$class_id'") : "") .
            ($value != '' ? " value='$value'" : "") /*. "onclick=\"if (this.value=='$editedLabel') { this.value='' }\""*/ . " />";
            if ($tr !== -1) echo '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>" : "");
}
/*
 * $label   Self explanitory
 * $name    Name of the form element
 * $tr      Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *          Set to -1 to not output any table elements
 * $value   Default text
 * $css_type Set to either class or id
 * $class_id the class or id you want to assign
 */
function form_textarea($label, $name, $rows, $cols, $value = '', $tr = true, $css_type = 'class', $class_id = 'textarea'){
    $value = remove_slashes($value);
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    if ($tr !== -1) echo "<td><label>$label</label></td>
          <td>";
    echo "<textarea name='$name' rows='$rows' cols='$cols'" . ($css_type != '' ? (" $css_type ='$class_id'") : "") .
             ($_SESSION['jsClear'] == true ? "onclick=\"if (this.value=='$name') { this.value='' }\"" : '') . ">$value</textarea>";
    if ($tr !== -1) echo '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}

/*
 * Identical to form_text, but is a pasword field
 */
function form_pass($label, $name, $value = '', $tr = true, $css_type = '', $class_id = 'password'){
    $value = remove_slashes($value);
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    if ($tr !== -1) echo "<td><label>$label</label></td><td>";
    echo "<input type='password' name='$name' " . ($css_type != '' ? (" $css_type ='$class_id'") : "") .
            ($value != '' ? "value='$value'" : "") . " />";
    if ($tr !== -1) echo '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>" : "");
}


function form_select($label, $value, $extra = '', $d = false){
    echo "<option value='$value' " . ($d == true ? "selected='selected'" : '') . " $extra>$label</option>";
}
/*
 * $label Self expalnitory
 * $tr    Set to false to not output table row, or 2 to only close the </tr>
 *        Set to -1 to not output any table elements
 * $td    Set to false to not output the first <td></td>, a number to ouput x amount
 */
function form_submit($label = 'Submit', $show_name = false, $tr = true, $td = true, $image = false, $colspan = 1, $css_type = 'class', $class_id = 'submit'){
    $name = str_replace(' ', '', $label);
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    while ($td AND $tr !== -1){
        echo '<td></td>';
        $td -= 1;
    }
    if ($tr !== -1) echo "<td colspan=$colspan " . ($css_type != '' ? (" $css_type ='$class_id'") : "") . ">";
    echo "<input type='" . ($image == false ? "submit'" : "image'") . ($show_name  == true ? " name='$name'" : '') . ($image != '' ? "src='$image'" : '') . " value='$label' />";
    if ($tr !== -1) echo '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}
/*
 * $label Self expalnitory
 * $tr    Set to false to not output table row, or 2 to only close the </tr>
 *        Set to -1 to not output any table elements
 * $td    Set to false to not output the first <td></td>
 */
function form_cancel($label, $tr = true,  $td = true, $onclick="javascript:show_confirm()"){
    $name = str_replace(' ', '', $label);
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    echo $td AND $tr !== -1 ? "<td></td>" : '';
    if ($tr !== -1) echo '<td>';
    echo "<a href=\"$onclick\"><img src='images/cancel.png' $onclick /></a>";
    if ($tr !== -1) '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}
/* This can be a bit tricky, if changing colspan or reversing order (with $td and $colspan)
 * $label   Self explanitory
 * $name    Name of the form element
 * $value   Checkbox value
 * $checked Set to true to have the box checked
 * $tr      Set to false to not output table row, or 2 to only open the </tr>, 3 to only close <tr>
 *          Set to -1 to not output any table elements
 * $td      Set to false to not output a preceding <td> $label </td>, set to 2 to switch checkbox and label
 * $colspan Sets the colspan, if passed not as 1, will be one <td> rather than 2, if not changed, the first cell will be right aligned
 * $hover   Set to true to use CSS :hover effect
 */
function form_checkbox($label, $name, $value, $checked = false, $tr = true, $td = true, $colspan = 1, $hover = false){

    echo (($tr == 1 OR $tr == 2) ? (($hover == true) ? '<tr class="hover">' : '<tr>') : '');
    if ($td == 0 OR $td == 1){
        echo ($td == true ? "<td><label>$label</label></td>" : '') .
              ($tr !== -1 ? '<td class\'centerAlign\'>' : '') . "<input type='checkbox' name='$name' "  .
              ($checked == true ? 'checked' : '') . " value='$value' />" . ($tr !== -1 ? '</td>' : '');
    }
    else{
        if ($tr !== -1) echo "<td colspan=$colspan " . ($colspan == 1 ? "align=right" : '') . "class='centerAlign' >";
        echo "<input type='checkbox' name='$name' "  .
              ($checked == true ? 'checked' : '') . " value='$value' />" . ($colspan == 1 AND $tr !== -1 ? "</td><td>" : '') .
              $label . ($tr !== -1 ? '</td>' : '');

    }
    echo (($tr == 1 OR $tr == 3) ? "</tr>" : "");
}

/* This can be a bit tricky, if changing colspan or reversing order (with $td and $colspan)
 * $label   Self explanitory
 * $name    Name of the form element
 * $value   Checkbox value
 * $checked Set to true to have the box checked
 * $tr      Set to false to not output table row, or 2 to only close the </tr>, 3 to only open <tr>
 *          Set to -1 to not output any table elements
 * $td      Set to false to not output a preceding <td> $label </td>, set to 2 to switch checkbox and label
 * $colspan Sets the colspan, if passed not as 1, will be one <td> rather than 2, if not changed, the first cell will be right aligned
 */
function form_radio($label, $name, $value, $checked = false, $tr = true, $td = true, $colspan = 1){
    if ($checked === ' checked="checked"'){
        $checked = true;
    }
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    if ($td == 0 OR $td == true){
        echo (($td == 1 AND $tr !== -1) ? "<td><label>$label</label></td>" : '') .
              ($tr !== -1 ? '<td>' : '' ) . "<input type='radio' name='$name' "  .
              ($checked == true ? 'checked' : '') . " value='$value' />" . ($tr !== -1 ? '</td>' : '');
    }
    else{
        if ($tr !== -1 ) echo "<td colspan=$colspan " . ($colspan == 1 ? "align=right" : '') . ">";
        else die();
        echo "<input type='radio' name='$name' "  .
              ($checked == true ? 'checked' : '') . " value='$value' />" . ($colspan == 1 AND $tr !== -1 ? "</td><td>" : '') .
              $label . ($tr !== -1 ? '</td>' : '');

    }
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}

function form_hidden($name, $value = ''){
    echo "<input type='hidden' name='$name'  value='$value' />";
}

/*
 * @Param label   Self explanitory
 * @Param name    Name of the form element
 * @Param tr      Set to false to not output a table row, or 2 to only close the </tr>, 3 to only open <tr>
 *                Set to -1 to not output any table elements
 * @Param size    Pass this to hav custom size (Characters, and effects aesthetically)
 * @Param value   Default text
 * @Param css_type Set to either class or id
 * @Param class_id the class or id you want to assign
 */
function form_file($label, $name, $tr = true, $size = false, $css_type = 'class', $class_id = 'file_upload'){
    echo (($tr == 1 OR $tr == 2) ? '<tr>' : '');
    if ($tr !== -1) echo "<td><label>$label</label></td>
          <td>";
    echo "<input name='$name' type='file' " . ($size ? "size=$size" : '') . ($css_type != '' ? ("$css_type='$class_id'") : "") . " />";
    if ($tr !== -1) '</td>';
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}

/*
 * outputs 2 table cells, one  label, and a $data
 * $tr pass false to not make a table row, or 2 to only close the table row, 3 to only open <tr>
 */
function table_data($label, $data, $tr = 1, $td = true, $css_type = 'class', $class_id = ''){
    echo (($tr == 1 OR $tr == 2) ? "<tr>\n" : "\n");
    if ($label)
        echo "<td><label>$label</label></td>";
    echo "<td>$data</td>\n\n";
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}
/*
 * outputs <td>$val</td> for each value in array $data
 * $tr pass false to not make a table row, or 2 to only close the table row, 3 to only open <tr>
 */
function table_datas($data, $tr = 1){
    echo (($tr == 1 OR $tr == 2) ? "<tr class='hover'>\n" : "\n");
    foreach($data as $key => $dat)
        echo "<td>$dat</td>\n\n";
    echo (($tr == 1 OR $tr == 3) ? "</tr>\n" : "\n");
}
function table_open($extra = ''){
    echo "<table $extra>";
}
function table_close(){
    echo "</table>";
}

function query($query){
    echo "<span style='color:#68532a'>$query</span><br />";
}

function form_select_permissions($userID = false, $groupID = false, $tr = false, $echo = false){
    if (!$userID){
        die('UserID not passed to form_select_permissions()!');
    }
//    if (! is_array($selected))
//        $selected = array();

    if ($userID AND $groupID){
        $CI =& get_instance();
    }

    $CI->Permissions->load_permissions($userID);
    $permissions = array('Punch' => 'punch', 'Edit Time' => 'editTime', 'Run Reports' => 'runReports');
    $string = $tr ? '<tr>' : '';
        foreach ($permissions as $permName => $permission){
            if (isset($CI)){
                if (isset($CI->Permissions->groups[$groupID])){
                    if (in_array("not_$permission", $CI->Permissions->groups[$groupID]['permissions'])){
                        $selected = 'No';
                    }
                    else if (in_array($permission, $CI->Permissions->groups[$groupID]['permissions'])){
                        $selected = 'Yes';
                    }
                    else {
                        $selected = 'Inherit';
                    }
                }
                else {
                    $selected = 'Inherit';
                }
            }
            else {
                $selected = 'Inherit';
            }
            $selectedString =
            $string .= "<td><select name='permissions_$userID".'['.$permission.']'."'>";
                $string .= "<option value='1' " . ($selected == 'Yes' ? 'selected' : '') . ">Yes</option>";
                $string .= "<option value='0' " . ($selected == 'No' ? 'selected' : '') . ">No</option>";
                $string .= "<option value='-1' " . ($selected == 'Inherit' ? 'selected' : '') . ">Inherit</option>";
            $string .= "</select></td>";
        }
    if ($tr)
        $string .= '</tr>';

    if ($echo)
        echo "$string";
    else
        return $string;
}

function render_tree_list_group($array, $linkPrefix = false){
    $CI =& get_instance();
    $id = $array['info']['id'];
    $level = $array['info']['level'];
    echo "\n<tr id='row$id'><td>";
        for($i = 1; $i <= $level; $i++){
            echo '<img src="' . $CI->config->item('base_url') .'css/images/list_spacer.png" />';
        }
        if ($linkPrefix)
            echo anchor($linkPrefix . '?id=' . $id, $array['info']['name']);
        else
            echo $array['info']['name'];

        if (($CI->session->userdata('sys_admin') == 1)){
            if ($array['info']['id'] != 1){
                echo "<input type='button' value='Move Group' onclick='AddMoveGroup($id, $level)'  class='actionButton' />";
            }
            echo "<input type='button' value='Add Subgroup' onclick='AddSubGroup($id, $level)'  class='actionButton' />";
            echo "<input type='button' value='Add User' onclick='AddUser($id, $level)'  class='actionButton' />";

            if (! isset($array['children']) AND ! isset($array['users']) AND $array['info']['id'] != 1){
                echo "<input type='button' value='Delete Group' onclick='AddDeleteGroupConfirm($id, $level)'  class='actionButton' />";
            }
            if (isset($array['users'])){
               echo "<input type='button' value='Manage Users' onclick='AddShowUsers($id, $level)'  class='actionButton' />";
            }
        }

        if ($CI->Permissions->has_permission($array['info']['id'], 'runReports') OR $CI->Permissions->has_permission($array['info']['id'], 'editTime')){
            echo "<input type='button' value='Run Reports' onclick='AddRunReports($id, $level)'  class='actionButton' />";
        }

        echo '</td></tr>';
        if (isset($array['children'])){
            foreach ($array['children'] as $child){
                render_tree_list_group($child, $linkPrefix);
            }
        }
}

function render_tree_select_group($array, $return = false, $level = 0, $showRootGroup = true){
    static $output = '';
    
    if (isset($array['info']) AND $showRootGroup){
        $output .= "<option value=\"{$array['info']['id']}\" " . set_select('groupID', $array['info']['id']) . ">";
            for($i = 1; $i <= $array['info']['level']; $i++){
                $output .= '---';
            }
            $output .= $array['info']['name'];
        $output .= '</option>';
    }

    if (isset($array['children'])){
        foreach ($array['children'] as $child){
            render_tree_select_group($child, $return, $level + 1);
        }
    }

    if ($return){
        return $output;
    }
    else if (! $level) {
        echo $output;
    }

}

function render_select_user($array, $varName = 'userID', $showSelect = true, $noShowUsers = array()){
    echo "<select name='$varName'>";
        echo "<option value='0'>Select User</option>";
        foreach ($array->result() as $user) {
            if ((! is_array($noShowUsers)) OR (! in_array($user->id, $noShowUsers))){
                echo "<option value='$user->id'>$user->username</option>";
            }
        }
    echo '</select>';
}

function show_notices(){
    if (isset($_SESSION['errors'])){
        foreach ($_SESSION['errors'] as $notice){
            echo "<br />$notice";
        }
        echo '<br />';
        unset($_SESSION['errors']);
    }
    if (isset($_SESSION['notices'])){
        foreach ($_SESSION['notices'] as $notice){
            echo "<br />$notice";
        }
        echo '<br />';
        unset($_SESSION['notices']);
    }
}

function select_timezone($default = 'T405')
	{
		$menu = '
<select name="timezone" id="timezones">
	<option value="T405">&raquo; UTC</option>
<optgroup label="United States">
        <option value="T052">&raquo; Alaska</option>
        <option value="T380">&raquo; Hawaii</option>
        <option value="T128">&raquo; Pacific Time</option>
        <option value="T078">&raquo; Mountain Time</option>
        <option value="T156">&raquo; Mountain Time &raquo; Phoenix</option>
        <option value="T150">&raquo; Central Time</option>
        <option value="T146">&raquo; Eastern Time</option>
</optgroup>
<optgroup label="Africa">
	<option value="T000">&raquo; Abidjan</option>
	<option value="T001">&raquo; Accra</option>
	<option value="T002">&raquo; Addis Ababa</option>
	<option value="T003">&raquo; Algiers</option>
	<option value="T004">&raquo; Asmara</option>
	<option value="T005">&raquo; Bamako</option>
	<option value="T006">&raquo; Bangui</option>
	<option value="T007">&raquo; Banjul</option>
	<option value="T008">&raquo; Bissau</option>
	<option value="T009">&raquo; Blantyre</option>
	<option value="T010">&raquo; Brazzaville</option>
	<option value="T011">&raquo; Bujumbura</option>
	<option value="T012">&raquo; Cairo</option>
	<option value="T013">&raquo; Casablanca</option>
	<option value="T014">&raquo; Ceuta</option>
	<option value="T015">&raquo; Conakry</option>
	<option value="T016">&raquo; Dakar</option>
	<option value="T017">&raquo; Dar es Salaam</option>
	<option value="T018">&raquo; Djibouti</option>
	<option value="T019">&raquo; Douala</option>
	<option value="T020">&raquo; El Aaiun</option>
	<option value="T021">&raquo; Freetown</option>
	<option value="T022">&raquo; Gaborone</option>
	<option value="T023">&raquo; Harare</option>
	<option value="T024">&raquo; Johannesburg</option>
	<option value="T025">&raquo; Kampala</option>
	<option value="T026">&raquo; Khartoum</option>
	<option value="T027">&raquo; Kigali</option>
	<option value="T028">&raquo; Kinshasa</option>
	<option value="T029">&raquo; Lagos</option>
	<option value="T030">&raquo; Libreville</option>
	<option value="T031">&raquo; Lome</option>
	<option value="T032">&raquo; Luanda</option>
	<option value="T033">&raquo; Lubumbashi</option>
	<option value="T034">&raquo; Lusaka</option>
	<option value="T035">&raquo; Malabo</option>
	<option value="T036">&raquo; Maputo</option>
	<option value="T037">&raquo; Maseru</option>
	<option value="T038">&raquo; Mbabane</option>
	<option value="T039">&raquo; Mogadishu</option>
	<option value="T040">&raquo; Monrovia</option>
	<option value="T041">&raquo; Nairobi</option>
	<option value="T042">&raquo; Ndjamena</option>
	<option value="T043">&raquo; Niamey</option>
	<option value="T044">&raquo; Nouakchott</option>
	<option value="T045">&raquo; Ouagadougou</option>
	<option value="T046">&raquo; Porto-Novo</option>
	<option value="T047">&raquo; Sao Tome</option>
	<option value="T048">&raquo; Tripoli</option>
	<option value="T049">&raquo; Tunis</option>
	<option value="T050">&raquo; Windhoek</option>
</optgroup>
<optgroup label="America">
	<option value="T051">&raquo; Adak</option>
	<option value="T052">&raquo; Anchorage</option>
	<option value="T053">&raquo; Anguilla</option>
	<option value="T054">&raquo; Antigua</option>
	<option value="T055">&raquo; Araguaina</option>
	<option value="T056">&raquo; Argentina &raquo; Buenos Aires</option>
	<option value="T057">&raquo; Argentina &raquo; Catamarca</option>
	<option value="T058">&raquo; Argentina &raquo; Cordoba</option>
	<option value="T059">&raquo; Argentina &raquo; Jujuy</option>
	<option value="T060">&raquo; Argentina &raquo; La Rioja</option>
	<option value="T061">&raquo; Argentina &raquo; Mendoza</option>
	<option value="T062">&raquo; Argentina &raquo; Rio Gallegos</option>
	<option value="T063">&raquo; Argentina &raquo; Salta</option>
	<option value="T064">&raquo; Argentina &raquo; San Juan</option>
	<option value="T065">&raquo; Argentina &raquo; San Luis</option>
	<option value="T066">&raquo; Argentina &raquo; Tucuman</option>
	<option value="T067">&raquo; Argentina &raquo; Ushuaia</option>
	<option value="T068">&raquo; Aruba</option>
	<option value="T069">&raquo; Asuncion</option>
	<option value="T070">&raquo; Atikokan</option>
	<option value="T071">&raquo; Bahia</option>
	<option value="T072">&raquo; Barbados</option>
	<option value="T073">&raquo; Belem</option>
	<option value="T074">&raquo; Belize</option>
	<option value="T075">&raquo; Blanc-Sablon</option>
	<option value="T076">&raquo; Boa Vista</option>
	<option value="T077">&raquo; Bogota</option>
	<option value="T078">&raquo; Boise</option>
	<option value="T079">&raquo; Cambridge Bay</option>
	<option value="T080">&raquo; Campo Grande</option>
	<option value="T081">&raquo; Cancun</option>
	<option value="T082">&raquo; Caracas</option>
	<option value="T083">&raquo; Cayenne</option>
	<option value="T084">&raquo; Cayman</option>
	<option value="T085">&raquo; Chicago</option>
	<option value="T086">&raquo; Chihuahua</option>
	<option value="T087">&raquo; Costa Rica</option>
	<option value="T088">&raquo; Cuiaba</option>
	<option value="T089">&raquo; Curacao</option>
	<option value="T090">&raquo; Danmarkshavn</option>
	<option value="T091">&raquo; Dawson</option>
	<option value="T092">&raquo; Dawson Creek</option>
	<option value="T093">&raquo; Denver</option>
	<option value="T094">&raquo; Detroit</option>
	<option value="T095">&raquo; Dominica</option>
	<option value="T096">&raquo; Edmonton</option>
	<option value="T097">&raquo; Eirunepe</option>
	<option value="T098">&raquo; El Salvador</option>
	<option value="T099">&raquo; Fortaleza</option>
	<option value="T100">&raquo; Glace Bay</option>
	<option value="T101">&raquo; Godthab</option>
	<option value="T102">&raquo; Goose Bay</option>
	<option value="T103">&raquo; Grand Turk</option>
	<option value="T104">&raquo; Grenada</option>
	<option value="T105">&raquo; Guadeloupe</option>
	<option value="T106">&raquo; Guatemala</option>
	<option value="T107">&raquo; Guayaquil</option>
	<option value="T108">&raquo; Guyana</option>
	<option value="T109">&raquo; Halifax</option>
	<option value="T110">&raquo; Havana</option>
	<option value="T111">&raquo; Hermosillo</option>
	<option value="T112">&raquo; Indiana &raquo; Indianapolis</option>
	<option value="T113">&raquo; Indiana &raquo; Knox</option>
	<option value="T114">&raquo; Indiana &raquo; Marengo</option>
	<option value="T115">&raquo; Indiana &raquo; Petersburg</option>
	<option value="T116">&raquo; Indiana &raquo; Tell City</option>
	<option value="T117">&raquo; Indiana &raquo; Vevay</option>
	<option value="T118">&raquo; Indiana &raquo; Vincennes</option>
	<option value="T119">&raquo; Indiana &raquo; Winamac</option>
	<option value="T120">&raquo; Inuvik</option>
	<option value="T121">&raquo; Iqaluit</option>
	<option value="T122">&raquo; Jamaica</option>
	<option value="T123">&raquo; Juneau</option>
	<option value="T124">&raquo; Kentucky &raquo; Louisville</option>
	<option value="T125">&raquo; Kentucky &raquo; Monticello</option>
	<option value="T126">&raquo; La Paz</option>
	<option value="T127">&raquo; Lima</option>
	<option value="T128">&raquo; Los Angeles</option>
	<option value="T129">&raquo; Maceio</option>
	<option value="T130">&raquo; Managua</option>
	<option value="T131">&raquo; Manaus</option>
	<option value="T132">&raquo; Marigot</option>
	<option value="T133">&raquo; Martinique</option>
	<option value="T134">&raquo; Matamoros</option>
	<option value="T135">&raquo; Mazatlan</option>
	<option value="T136">&raquo; Menominee</option>
	<option value="T137">&raquo; Merida</option>
	<option value="T138">&raquo; Mexico City</option>
	<option value="T139">&raquo; Miquelon</option>
	<option value="T140">&raquo; Moncton</option>
	<option value="T141">&raquo; Monterrey</option>
	<option value="T142">&raquo; Montevideo</option>
	<option value="T143">&raquo; Montreal</option>
	<option value="T144">&raquo; Montserrat</option>
	<option value="T145">&raquo; Nassau</option>
	<option value="T146">&raquo; New York</option>
	<option value="T147">&raquo; Nipigon</option>
	<option value="T148">&raquo; Nome</option>
	<option value="T149">&raquo; Noronha</option>
	<option value="T150">&raquo; North Dakota &raquo; Center</option>
	<option value="T151">&raquo; North Dakota &raquo; New Salem</option>
	<option value="T152">&raquo; Ojinaga</option>
	<option value="T153">&raquo; Panama</option>
	<option value="T154">&raquo; Pangnirtung</option>
	<option value="T155">&raquo; Paramaribo</option>
	<option value="T156">&raquo; Phoenix</option>
	<option value="T157">&raquo; Port-au-Prince</option>
	<option value="T158">&raquo; Port of Spain</option>
	<option value="T159">&raquo; Porto Velho</option>
	<option value="T160">&raquo; Puerto Rico</option>
	<option value="T161">&raquo; Rainy River</option>
	<option value="T162">&raquo; Rankin Inlet</option>
	<option value="T163">&raquo; Recife</option>
	<option value="T164">&raquo; Regina</option>
	<option value="T165">&raquo; Resolute</option>
	<option value="T166">&raquo; Rio Branco</option>
	<option value="T167">&raquo; Santa Isabel</option>
	<option value="T168">&raquo; Santarem</option>
	<option value="T169">&raquo; Santiago</option>
	<option value="T170">&raquo; Santo Domingo</option>
	<option value="T171">&raquo; Sao Paulo</option>
	<option value="T172">&raquo; Scoresbysund</option>
	<option value="T173">&raquo; Shiprock</option>
	<option value="T174">&raquo; St Barthelemy</option>
	<option value="T175">&raquo; St Johns</option>
	<option value="T176">&raquo; St Kitts</option>
	<option value="T177">&raquo; St Lucia</option>
	<option value="T178">&raquo; St Thomas</option>
	<option value="T179">&raquo; St Vincent</option>
	<option value="T180">&raquo; Swift Current</option>
	<option value="T181">&raquo; Tegucigalpa</option>
	<option value="T182">&raquo; Thule</option>
	<option value="T183">&raquo; Thunder Bay</option>
	<option value="T184">&raquo; Tijuana</option>
	<option value="T185">&raquo; Toronto</option>
	<option value="T186">&raquo; Tortola</option>
	<option value="T187">&raquo; Vancouver</option>
	<option value="T188">&raquo; Whitehorse</option>
	<option value="T189">&raquo; Winnipeg</option>
	<option value="T190">&raquo; Yakutat</option>
	<option value="T191">&raquo; Yellowknife</option>
</optgroup>
<optgroup label="Antarctica">
	<option value="T192">&raquo; Casey</option>
	<option value="T193">&raquo; Davis</option>
	<option value="T194">&raquo; DumontDUrville</option>
	<option value="T195">&raquo; Mawson</option>
	<option value="T196">&raquo; McMurdo</option>
	<option value="T197">&raquo; Palmer</option>
	<option value="T198">&raquo; Rothera</option>
	<option value="T199">&raquo; South Pole</option>
	<option value="T200">&raquo; Syowa</option>
	<option value="T201">&raquo; Vostok</option>
</optgroup>
<optgroup label="Arctic">
	<option value="T202">&raquo; Longyearbyen</option>
</optgroup>
<optgroup label="Asia">
	<option value="T203">&raquo; Aden</option>
	<option value="T204">&raquo; Almaty</option>
	<option value="T205">&raquo; Amman</option>
	<option value="T206">&raquo; Anadyr</option>
	<option value="T207">&raquo; Aqtau</option>
	<option value="T208">&raquo; Aqtobe</option>
	<option value="T209">&raquo; Ashgabat</option>
	<option value="T210">&raquo; Baghdad</option>
	<option value="T211">&raquo; Bahrain</option>
	<option value="T212">&raquo; Baku</option>
	<option value="T213">&raquo; Bangkok</option>
	<option value="T214">&raquo; Beirut</option>
	<option value="T215">&raquo; Bishkek</option>
	<option value="T216">&raquo; Brunei</option>
	<option value="T217">&raquo; Choibalsan</option>
	<option value="T218">&raquo; Chongqing</option>
	<option value="T219">&raquo; Colombo</option>
	<option value="T220">&raquo; Damascus</option>
	<option value="T221">&raquo; Dhaka</option>
	<option value="T222">&raquo; Dili</option>
	<option value="T223">&raquo; Dubai</option>
	<option value="T224">&raquo; Dushanbe</option>
	<option value="T225">&raquo; Gaza</option>
	<option value="T226">&raquo; Harbin</option>
	<option value="T227">&raquo; Ho Chi Minh</option>
	<option value="T228">&raquo; Hong Kong</option>
	<option value="T229">&raquo; Hovd</option>
	<option value="T230">&raquo; Irkutsk</option>
	<option value="T231">&raquo; Jakarta</option>
	<option value="T232">&raquo; Jayapura</option>
	<option value="T233">&raquo; Jerusalem</option>
	<option value="T234">&raquo; Kabul</option>
	<option value="T235">&raquo; Kamchatka</option>
	<option value="T236">&raquo; Karachi</option>
	<option value="T237">&raquo; Kashgar</option>
	<option value="T238">&raquo; Kathmandu</option>
	<option value="T239">&raquo; Kolkata</option>
	<option value="T240">&raquo; Krasnoyarsk</option>
	<option value="T241">&raquo; Kuala Lumpur</option>
	<option value="T242">&raquo; Kuching</option>
	<option value="T243">&raquo; Kuwait</option>
	<option value="T244">&raquo; Macau</option>
	<option value="T245">&raquo; Magadan</option>
	<option value="T246">&raquo; Makassar</option>
	<option value="T247">&raquo; Manila</option>
	<option value="T248">&raquo; Muscat</option>
	<option value="T249">&raquo; Nicosia</option>
	<option value="T250">&raquo; Novokuznetsk</option>
	<option value="T251">&raquo; Novosibirsk</option>
	<option value="T252">&raquo; Omsk</option>
	<option value="T253">&raquo; Oral</option>
	<option value="T254">&raquo; Phnom Penh</option>
	<option value="T255">&raquo; Pontianak</option>
	<option value="T256">&raquo; Pyongyang</option>
	<option value="T257">&raquo; Qatar</option>
	<option value="T258">&raquo; Qyzylorda</option>
	<option value="T259">&raquo; Rangoon</option>
	<option value="T260">&raquo; Riyadh</option>
	<option value="T261">&raquo; Sakhalin</option>
	<option value="T262">&raquo; Samarkand</option>
	<option value="T263">&raquo; Seoul</option>
	<option value="T264">&raquo; Shanghai</option>
	<option value="T265">&raquo; Singapore</option>
	<option value="T266">&raquo; Taipei</option>
	<option value="T267">&raquo; Tashkent</option>
	<option value="T268">&raquo; Tbilisi</option>
	<option value="T269">&raquo; Tehran</option>
	<option value="T270">&raquo; Thimphu</option>
	<option value="T271">&raquo; Tokyo</option>
	<option value="T272">&raquo; Ulaanbaatar</option>
	<option value="T273">&raquo; Urumqi</option>
	<option value="T274">&raquo; Vientiane</option>
	<option value="T275">&raquo; Vladivostok</option>
	<option value="T276">&raquo; Yakutsk</option>
	<option value="T277">&raquo; Yekaterinburg</option>
	<option value="T278">&raquo; Yerevan</option>
</optgroup>
<optgroup label="Atlantic">
	<option value="T279">&raquo; Azores</option>
	<option value="T280">&raquo; Bermuda</option>
	<option value="T281">&raquo; Canary</option>
	<option value="T282">&raquo; Cape Verde</option>
	<option value="T283">&raquo; Faroe</option>
	<option value="T284">&raquo; Madeira</option>
	<option value="T285">&raquo; Reykjavik</option>
	<option value="T286">&raquo; South Georgia</option>
	<option value="T287">&raquo; St Helena</option>
	<option value="T288">&raquo; Stanley</option>
</optgroup>
<optgroup label="Australia">
	<option value="T289">&raquo; Adelaide</option>
	<option value="T290">&raquo; Brisbane</option>
	<option value="T291">&raquo; Broken Hill</option>
	<option value="T292">&raquo; Currie</option>
	<option value="T293">&raquo; Darwin</option>
	<option value="T294">&raquo; Eucla</option>
	<option value="T295">&raquo; Hobart</option>
	<option value="T296">&raquo; Lindeman</option>
	<option value="T297">&raquo; Lord Howe</option>
	<option value="T298">&raquo; Melbourne</option>
	<option value="T299">&raquo; Perth</option>
	<option value="T300">&raquo; Sydney</option>
</optgroup>
<optgroup label="Europe">
	<option value="T301">&raquo; Amsterdam</option>
	<option value="T302">&raquo; Andorra</option>
	<option value="T303">&raquo; Athens</option>
	<option value="T304">&raquo; Belgrade</option>
	<option value="T305">&raquo; Berlin</option>
	<option value="T306">&raquo; Bratislava</option>
	<option value="T307">&raquo; Brussels</option>
	<option value="T308">&raquo; Bucharest</option>
	<option value="T309">&raquo; Budapest</option>
	<option value="T310">&raquo; Chisinau</option>
	<option value="T311">&raquo; Copenhagen</option>
	<option value="T312">&raquo; Dublin</option>
	<option value="T313">&raquo; Gibraltar</option>
	<option value="T314">&raquo; Guernsey</option>
	<option value="T315">&raquo; Helsinki</option>
	<option value="T316">&raquo; Isle of Man</option>
	<option value="T317">&raquo; Istanbul</option>
	<option value="T318">&raquo; Jersey</option>
	<option value="T319">&raquo; Kaliningrad</option>
	<option value="T320">&raquo; Kiev</option>
	<option value="T321">&raquo; Lisbon</option>
	<option value="T322">&raquo; Ljubljana</option>
	<option value="T323">&raquo; London</option>
	<option value="T324">&raquo; Luxembourg</option>
	<option value="T325">&raquo; Madrid</option>
	<option value="T326">&raquo; Malta</option>
	<option value="T327">&raquo; Mariehamn</option>
	<option value="T328">&raquo; Minsk</option>
	<option value="T329">&raquo; Monaco</option>
	<option value="T330">&raquo; Moscow</option>
	<option value="T331">&raquo; Oslo</option>
	<option value="T332">&raquo; Paris</option>
	<option value="T333">&raquo; Podgorica</option>
	<option value="T334">&raquo; Prague</option>
	<option value="T335">&raquo; Riga</option>
	<option value="T336">&raquo; Rome</option>
	<option value="T337">&raquo; Samara</option>
	<option value="T338">&raquo; San Marino</option>
	<option value="T339">&raquo; Sarajevo</option>
	<option value="T340">&raquo; Simferopol</option>
	<option value="T341">&raquo; Skopje</option>
	<option value="T342">&raquo; Sofia</option>
	<option value="T343">&raquo; Stockholm</option>
	<option value="T344">&raquo; Tallinn</option>
	<option value="T345">&raquo; Tirane</option>
	<option value="T346">&raquo; Uzhgorod</option>
	<option value="T347">&raquo; Vaduz</option>
	<option value="T348">&raquo; Vatican</option>
	<option value="T349">&raquo; Vienna</option>
	<option value="T350">&raquo; Vilnius</option>
	<option value="T351">&raquo; Volgograd</option>
	<option value="T352">&raquo; Warsaw</option>
	<option value="T353">&raquo; Zagreb</option>
	<option value="T354">&raquo; Zaporozhye</option>
	<option value="T355">&raquo; Zurich</option>
</optgroup>
<optgroup label="Indian">
	<option value="T356">&raquo; Antananarivo</option>
	<option value="T357">&raquo; Chagos</option>
	<option value="T358">&raquo; Christmas</option>
	<option value="T359">&raquo; Cocos</option>
	<option value="T360">&raquo; Comoro</option>
	<option value="T361">&raquo; Kerguelen</option>
	<option value="T362">&raquo; Mahe</option>
	<option value="T363">&raquo; Maldives</option>
	<option value="T364">&raquo; Mauritius</option>
	<option value="T365">&raquo; Mayotte</option>
	<option value="T366">&raquo; Reunion</option>
</optgroup>
<optgroup label="Pacific">
	<option value="T367">&raquo; Apia</option>
	<option value="T368">&raquo; Auckland</option>
	<option value="T369">&raquo; Chatham</option>
	<option value="T370">&raquo; Easter</option>
	<option value="T371">&raquo; Efate</option>
	<option value="T372">&raquo; Enderbury</option>
	<option value="T373">&raquo; Fakaofo</option>
	<option value="T374">&raquo; Fiji</option>
	<option value="T375">&raquo; Funafuti</option>
	<option value="T376">&raquo; Galapagos</option>
	<option value="T377">&raquo; Gambier</option>
	<option value="T378">&raquo; Guadalcanal</option>
	<option value="T379">&raquo; Guam</option>
	<option value="T380">&raquo; Honolulu</option>
	<option value="T381">&raquo; Johnston</option>
	<option value="T382">&raquo; Kiritimati</option>
	<option value="T383">&raquo; Kosrae</option>
	<option value="T384">&raquo; Kwajalein</option>
	<option value="T385">&raquo; Majuro</option>
	<option value="T386">&raquo; Marquesas</option>
	<option value="T387">&raquo; Midway</option>
	<option value="T388">&raquo; Nauru</option>
	<option value="T389">&raquo; Niue</option>
	<option value="T390">&raquo; Norfolk</option>
	<option value="T391">&raquo; Noumea</option>
	<option value="T392">&raquo; Pago Pago</option>
	<option value="T393">&raquo; Palau</option>
	<option value="T394">&raquo; Pitcairn</option>
	<option value="T395">&raquo; Ponape</option>
	<option value="T396">&raquo; Port Moresby</option>
	<option value="T397">&raquo; Rarotonga</option>
	<option value="T398">&raquo; Saipan</option>
	<option value="T399">&raquo; Tahiti</option>
	<option value="T400">&raquo; Tarawa</option>
	<option value="T401">&raquo; Tongatapu</option>
	<option value="T402">&raquo; Truk</option>
	<option value="T403">&raquo; Wake</option>
	<option value="T404">&raquo; Wallis</option>
</optgroup>
</select>';
            if ($default){
//                $menu = substr_replace($menu, "\"$default\" selected", strpos($menu, "\"$default\""), -(strlen($menu) - strpos($menu, "\"$default\"") + strlen($default) + 2));
                $menu = replace_first("\"$default\"", "\"$default\" selected=\"selected\"", $menu);
            }

            return $menu;
	}

        function replace_first($search, $replace, $data) {
            $res = strpos($data, $search);
            if($res === false) {
                return $data;
            } else {
                // There is data to be replaced
                $left_seg = substr($data, 0, strpos($data, $search));
                $right_seg = substr($data, (strpos($data, $search) + strlen($search)));
                return $left_seg . $replace . $right_seg;
            }
        }
?>