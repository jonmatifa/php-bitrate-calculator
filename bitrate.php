<html>
<title>PHP bitrate calculator</title>
<html>
<?php

$csize = array('g' => 1000000000, 'm' => 1000000, 'k' => 1000, 'b' => 1);
$vrate = array('ProRes HQ' => 220, 'ProRes 422' => 150, 'ProRes LT' => 100, '5dmkIII All-I' => 91, 'Canon h.264 1080p' => 38, 'XAVC 1080p 24fps'                                                     => 50, 'AVCHD 1080p 60fps' => 28, 'AVCHD 1080p 24fps' => 24);
$arate = array('48khz 16bit stereo pcm' => 1536, '44.1khz 16bit stereo pcm' => 1441.2, '48khz 24bit stereo pcm' => 2304, '44.1khz 24bit stereo pc                                                    m' => 2116.8, 'AVCHD AC3 Stereo' => 192);

if ($_POST) {
        echo "<p>Video Bitrate: ".$_POST['vbit']*$csize[$_POST['vsize']]."</p>";
        echo "<p>Audio Bitrate: ".$_POST['abit']*$csize[$_POST['asize']]."</p>";
        $total = ($_POST['vbit']*$csize[$_POST['vsize']])+($_POST['abit']*$csize[$_POST['asize']]);
        $time = (($_POST['media']*$csize[$_POST['msize']]*8)/$total)/60;
        echo "<p>Combined Bitrate: ".$total."</p>";
        echo "<p>Media Size: ".$_POST['media']*$csize[$_POST['msize']]." bytes</p>";
        echo "<p><b>Total record time: ".round($time, 2)." minutes</b></p>";
        }
echo "<form method='post' action='".$_SERVER{'PHP_SELF'}."' enctype='multipart/form-data'>";

function s_list($name, $values) {
        echo '<select name="'.$name.'">';
        foreach (array_keys($values) as $opt) {
                if ($_POST[$name] == $values[$opt]) { $sel = 'selected'; } else { $sel = ''; }
                echo '<option value="'.$values[$opt].'" '.$sel.'>'.$opt.'</option>';
        }
        echo '</select>';
}

function bit_table($rate,$size) {
        $r = "<table border=1px><tr><td><b>Codec</b></td><td><b>".$size."</b></td></tr>";
        foreach (array_keys($rate) as $key) {
                $r .= "<tr><td>".$key."</td><td>".$rate[$key]."</td></tr>";
        }
        $r .= "</table>";
        return $r;
}

?>
<!--<p>Video Bitrate: <input type="number" name="vbit" value="<?php //echo $_POST['vbit']; ?>"> <?php //s_list('vsize', array("megabits" => "m",                                                     "kilobits" => "k", "bits" => "b")); ?> per second </p>-->
<p>Video Bitrate: <input type="text" name="vbit" value="<?php echo $_POST['vbit']; ?>"> <input type="hidden" name="vsize" value="m" /> megabits p                                                    er second </p>
<p>Audio Bitrate: <input type="text" name="abit"value="<?php echo $_POST['abit']; ?>"> <input type="hidden" name="asize" value="k" /> kilobits pe                                                    r second </p>
<p>Media Size: <input type="text" name="media" value="<?php echo $_POST['media']; ?>"> <input type="hidden" name="msize" value="g" /> gigabytes</                                                    p>

<input type="submit" value="Submit"/>
</form>

<table cellpadding="10px">
<tr>
<td valign="top"><h3>Video Bitrates</h3>
<?php echo bit_table($vrate, "mbps"); ?></td>
<td valign="top"><h3>Audio Bitrates</h3>
<?php echo bit_table($arate, "kbps"); ?></td>
</tr>
</table>

</body>
