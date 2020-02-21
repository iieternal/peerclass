<?php
//date function from timestamp
function timeago( $time )
    {
        $out    = ''; // what we will print out need sometuning but works fine
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return "Just now";

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? "{num} minute ago" : "{num} minutes ago" );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? "{num} hour ago" : "{num} hours ago" );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return "Yesterday";

        else // falling back on a usual date format as it happened later than yesterday
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? "%e %b" : "%e %b, %Y" , $time );
    }
//simple datetime to date only
    function dt2date($data){
        $date = date_create($data);
        return date_format($date,'Y/m/d');
    }
?>