<?php
function str_openssl_dec($str, $iv)
{
    $key = '1234567890vishal%$%^%$$#$#';
    $chiper = "AES-128-CTR";
    $options = 0;
    $str = openssl_decrypt($str, $chiper, $key, $options, $iv);
    return $str;
}
$mess = "";
$iv = "";
$msg = "";
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
        $v = $row2["iv"];
        $iv = hex2bin($v);
        $mess = str_openssl_dec($result, $iv);
    } else {
        $mess = "No message available";
    }

    if (strlen($mess) > 22) {
        $mess =  substr($mess, 0, 22) . '...';
    } 
    // else {
    //     $msg = $result;
    // }

    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }

    ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";

    if (($outgoing_id == $row['unique_id'])) {
        $hid_me = "hide";
    } else {
        $hid_me = "";
    };

    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $mess . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
