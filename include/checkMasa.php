<?php
    function checkMasa($masa){
        date_default_timezone_set("Asia/Kuala_Lumpur");

        // $datetime = new DateTime();
        // $datetime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
        // print $datetime->format('Y-m-d H:i:s (e)');
        // https://www.php.net/manual/en/class.datetime.php
        // https://stackoverflow.com/questions/38377537/check-time-between-two-times/38377872

        $now = new Datetime("now");
        
        if($now >= new DateTime('08:00') && $now <= new DateTime('09:00')){
            $masaLain = 1;
        }
        elseif($now >= new DateTime('09:00') && $now <= new DateTime('10:00')){
            $masaLain = 2;
        }
        elseif($now >= new DateTime('10:00') && $now <= new DateTime('11:00')){
            $masaLain = 3;
        }
        elseif($now >= new DateTime('11:00') && $now <= new DateTime('12:00')){
            $masaLain = 4;
        }
        elseif($now >= new DateTime('12:00') && $now <= new DateTime('13:00')){
            $masaLain = 5;
        }
        elseif($now >= new DateTime('14:00') && $now <= new DateTime('15:00')){
            $masaLain = 6;
        }
        elseif($now >= new DateTime('15:00') && $now <= new DateTime('16:00')){
            $masaLain = 7;
        }
        elseif($now >= new DateTime('16:00') && $now <= new DateTime('17:00')){
            $masaLain = 8;
        }else{
            $masaLain = 0;
        }

        if($masa == $masaLain){
            return true;
        }else{
            return false;
        }
        
        
    }
?>