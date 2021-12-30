<?php
// CHANGE THIS WITH YOUR INFO
// --------------------------
$secret_key = ""; //Set this as your secret key, to prevent others uploading to your server.
$domain_url = ""; //Add an S at the end of HTTP if you have a SSL certificate.
$lengthofstring = 5; //Length of the file name
$currentDate = date("d.m.y");
$currentDatelong = date("Dd.M.Y-h:iA");
// --------------------------
$sharexdir = "uploaded/";
function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));

    $key = '';
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

if(isset($_POST['secret']))
{
    if($_POST['secret'] == $secret_key)
    {
        $rs = RandomString($lengthofstring);
        $filename = $currentDate.'-'.$rs;
        $target_file = $_FILES["sharex"]["name"];
        $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($FileType == 'mp4'){
            $IsVideo = 't';
        } else {
            $IsVideo ='f';
        };
        if($FileType == "png" || $FileType == "gif" || $FileType = "mp4") {
            if (move_uploaded_file($_FILES["sharex"]["tmp_name"], $sharexdir.$filename.'.'.$FileType))
        {
            echo $domain_url.'sh.php?p=f&r='.$filename.'.'.$FileType.'&v='.$IsVideo.'&d='.$currentDatelong;

        } 
            else
        {
           echo 'File upload failed - CHMOD/Folder doesn\'t exist?';
        }
    }
    else
    {
        echo 'Invalid Secret Key';
    }
}
else
{
    echo 'No post data recieved';
}
        } else {
            echo 'Error file type not allowed or script error';
        };
?>
