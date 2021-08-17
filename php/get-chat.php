<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $mess = "";
    function str_openssl_dec($str, $iv)
    {
        $key = '1234567890vishal%$%^%$$#$#';
        $chiper = "AES-128-CTR";
        $options = 0;
        $str = openssl_decrypt($str, $chiper, $key, $options, $iv);
        return $str;
    }

    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $iv = hex2bin($row['iv']);
                $mess = str_openssl_dec($row['msg'], $iv);
                $output .= '<div class="chat outgoing">
                       
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                <img src="php/images/' . $row['img'] . '" alt="">
                                </div>';
            } else {
                $iv = hex2bin($row['iv']);
                $mess = str_openssl_dec($row['msg'], $iv);
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Messages are end-to-end encrypted. No one outside of this chat can read them.<br>Your messages will appear here as you start chating</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
