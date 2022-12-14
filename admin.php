<?php

function connect() {
    return mysqli_connect("localhost", "root", "", "digital_hostel", "3306");
}

function addUser($collegeid, $pass, $wmode, $name, $mailid,) {
    $dsn = connect();
    $x = mysqli_query($dsn, "insert into tbllogin values('$collegeid','$pass','$wmode',now())");
    if ($x == 1) {
        $x = mysqli_query($dsn, "insert into tblregistration(`collegeid`, `name`, `mailid`, `lastmodified`) values('$collegeid','$name','$mailid',now())");
        return $x;
    }
    return 0;
}

function checkId($collegeid, $pass) {
    $dsn = connect();
    $x = mysqli_query($dsn, "select wmode from tbllogin where collegeid='$collegeid' and binary pass='$pass'");
    return $x;
}

function addComplaint($collegeid, $subject, $msg) {
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO `tblcomplaint`(`collegeid`, `subject`, `message`, `lastmodified`) VALUES('$collegeid','$subject','$msg',now())");
    return $x;
}

function getAllComplaintsReport() {
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * from tblcomplaint order by 1");
    return $x;
}

function getUserComplaints($u) {
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT `sno`,`subject`,`message`,`lastmodified`,`complaint_status`,`resolvemessage`,`resolve_date` FROM `tblcomplaint` WHERE `collegeid` = '$u'");
    return $x;
}

function deleteComplaint($sno) {
    $dsn = connect();
    $x = mysqli_query($dsn, "delete from tblComplaint where sno = $sno");
    return $x;
}

function getComplaint($sno) {
    $dsn = connect();
    $x = mysqli_query($dsn, "select * from tblComplaint where sno = $sno");
    return $x;
}

function updComplaint($sno, $rmsg) {
    $dsn = connect();
    $x = mysqli_query($dsn, "update tblcomplaint set complaint_status='RESOLVED', resolvemessage='$rmsg', resolve_date=now() where sno = $sno");
    return $x;
}
