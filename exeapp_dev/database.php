<?php
error_reporting(0);
$con=mysqli_connect('localhost','persistsolution_mahabuddy','(e3Xm33qkIrZ','persistsolution_mahabuddy');
if (! $con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
define( 'API_ACCESS_KEY', 'AAAA8Kz4bDU:APA91bF_dVR0TRHRTxWVnrBge2sOL4pVkg4OM4s_ZqlCdJPjJzOl3oXjUTVKvnxTvGDAbX0nXfsG3ickAPQ_6STA4HG3_4ZwCnIL2Zfd2p4h7XJWIBTXJs3PE63QK8JMTL8DjEmG27Wo');
$SiteUrl = "http://mahabuddy.com/exeapp";
?>
