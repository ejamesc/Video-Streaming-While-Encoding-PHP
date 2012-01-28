<?php

// opens and returns contents of test.flv, frequently checking for increase in length


// set headers
header('Content-Type: video/x-flv');
//header('Content-Type: text/html');

//Accept-Ranges: bytes
//Content-Length: 6560711
//Connection: close
//Content-Type: video/x-flv

// want to use chunked encoding
//header("Transfer-encoding: chunked");
//flush();

function readfile_chunked( $filename, $retbytes = true ) {
    // 100 KB cunks
    $chunksize = 1 * (100 * 1024); // how many bytes per chunk
    $buffer = '';
    $cnt = 0;
    $eofcount = 0;


    ob_end_clean(); //added to fix file corruption?
    ob_start();     //added to fix file corruption?

    $done = false;


    while(!$done) {

        $handle = fopen( $filename, 'rb' );
        if ( $handle === false ) {
            // error :(
            return false;
        }

        // seek to last known position,1
        if (fseek($handle, $cnt) === -1) {
            // a problem, treat as eof
        } else {
            // no problem

            while ( !feof( $handle ) ) {

                $eofcount = 0;
                $buffer = fread( $handle, $chunksize );
 
                echo $buffer;

                ob_flush();
                flush();

                if ( $retbytes ) {
                    $cnt += strlen( $buffer );
                }
            }
        }

        $eofcount++;

        $status = fclose( $handle );

        // something went wrong
        if(!$status) $done = true;

        if($eofcount >= 3) {
            $done = true;
        } else {
            // wait for 1s
            sleep(1);
        }
    }

    if ( $retbytes && $status ) {
        return $cnt; // return num. bytes delivered like readfile() does.
    }
    return $status;
} 

readfile_chunked('./test.flv', true);
