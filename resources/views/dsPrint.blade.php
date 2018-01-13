<?php
    $ds =$yundan->ds_number;
    $barcode = DNS1D::getBarcodePNG($ds, "C128")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        *{
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">

        window.onload=function(){

            window.print();
            window.location.replace('../listPrint');
        }

    </script>
</head>
<body>
<div align="center">
    <table width="600" height="400" border="1" cellspacing="0" align="center"  class="yundan_body">

        <tr>
            <td valign="top">

                <table width="100%" border="1" cellspacing="0">
                    <tbody>
                    <tr>
                        <td align="left" width="250"><img src="../imgs/ds_logo.jpg" width="230" height="50"/></td>
                        <td align="right" width="350"><img src="../imgs/ds_title.jpg" width="330" height="50"/></td>
                    </tr>

                    </tbody>
                </table>

                <table width="100%" border="1"  cellspacing="0">
                    <tbody>
                    <tr>
                        <td width="50"  height="20" align="center" ><p style="font-size:40%;">ORIGIN</p></td>
                        <td width="75"  height="20" align="center"><p style="font-size:40%;">LAX</p></td>
                        <td width="50"  height="20" align="center"><p style="font-size:40%;">DESTIN</P> </td>
                        <td width="72"  height="20" align="center"><p style="font-size:40%;">TAO</p></td>

                        <td width="49"  height="20" align="center"><p style="font-size:40%;">PIECES</p></td>
                        <td width="124" height="20" align="center"><p style="font-size:40%;">1</p></td>
                        <td width="49"  height="20" align="center" ><p style="font-size:40%;">WEIGHT</p></td>
                        <td width="124" height="20" align="center"> <p style="font-size:40%;">{{$yundan->weight}}</p></td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" cellspacing="0" height="10"  >
                    <tbody>
                    <tr>
                        <td width="250"  height="10" align="left" style="border-right:solid #000000;"><p style="font-size:40%;">From(Shipper)</p></td>
                        <td width="350"  height="10" align="left"><p style="font-size:40%;">To(CONSIGNEE)</p></td>

                    </tr>
                    </tbody>
                </table>


                <table width="100%" cellspacing="0" height="30"  >
                    <tbody>
                    <tr valign="top">
                        <td width="250"  height="30" align="left" style="border-right:solid #000000;"><p style="font-size:50%;">
                                FMG UNIVERSAL LLC                    </p></td>
                        <td width="350"  height="30" align="left">
                            <p style="font-size:15px;margin: 4px">{{$yundan->receiver_name}}</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" cellspacing="0" height="70"  >
                    <tbody>
                    <tr valign="bottom">
                        <td width="150"  height="70" align="left" style="border-right:solid #000000;"><p style="font-size:50%;">SENT BY</p></td>
                        <td width="99"   height="70" align="left" style="border-right:solid #000000; border-top:solid #000000;"><p style="font-size:50%;">TELEX/PHONE</p><p style="font-size:50%;"></p></td>
                        <td width="250"  height="70" align="left" style="border-right:solid #000000;padding: 1px" >
                            <p style="font-size:50%;padding: 0px;margin: 1px" >ATTEN OF
                            <p style="margin: 0px;padding:0px;padding-left: 10px"><img src="data:image/png;base64,{{$barcode}}" width="240" height="50" style=" float:center"/>
                            <p style="padding: 0px;margin: 0px;text-align: center">{{$yundan->ds_number}}</p>
                            </p>
                            </p>

                        </td>
                        <td width="100"  height="70" align="left" style="border-top:solid #000000;"><p style="font-size:50%;">TELEX/PHONE</p><p style="font-size:50%;"></p></td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" border="1" cellspacing="0" height="70" >
                    <tbody>
                    <tr valign="top">
                        <td align="left" width="250"  height="20"><P style="font-size:40%;">DESCRIPTION CONTENTS/SPECIAL INSTRUCTIONS</P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="data:image/png;base64,{{$barcode}}" width="200" height="48" align="middle" /><p style="padding: 0px;margin: 0px;text-align: center">{{$yundan->ds_number}}</p></td>
                        <td align="left" width="175" height="20" ><P style="font-size:40%;">FREIGHT PREPAID</P></td>
                        <td align="left" width="175" height="20" ><P style="font-size:40%;">FREIGHT COLLECT</P></td>
                    </tr>
                    </tbody>
                </table>




                <table width="700" cellspacing="0" height="20" >
                    <tbody>
                    <tr valign="top">
                        <td align="left" width="79"  height="20" style="border-right:solid #000000;"> <P style="font-size:50%;">SHIPPER'S SIGNATURE</P></td>
                        <td align="left" width="170" height="20" style="border-right:solid #000000;"><P style="font-size:40%;"></P></td>
                        <td align="left" width="80" height="20" ><P style="font-size:50%;">RECEIVER'S SIGNATURE</P></td>
                        <td align="left" width="95" height="20" style="border-right:solid #000000;"><P style="font-size:30%;"></P></td>
                        <td align="center" width="88" height="20" style="border-right:solid #000000;"><P style="font-size:40%;">DATE</P></td>
                        <td align="center" width="87" height="20" ><P style="font-size:40%;">TOTAL</P></td>
                    </tr>
                    </tbody>
                </table>

                <table width="700" cellspacing="0" height="10" >
                    <tbody>
                    <tr valign="top">
                        <td align="left" width="79"   height="10" style="border-right:solid #000000;"> <P style="font-size:20%;"></P></td>
                        <td align="left" width="169"  height="10" style="border-right:solid #000000;"><P style="font-size:20%;"></P></td>
                        <td align="left" width="80"   height="10" ><P style="font-size:20%;"></P></td>
                        <td align="left" width="95"   height="10" style="border-right:solid #000000;"><P style="font-size:20%;"></P></td>
                        <td align="center" width="88" height="10" style="border-right:solid #000000;border-top:solid #000000;"><P style="font-size:20%;">/ 	&nbsp;	&nbsp; /</P></td>
                        <td align="center" width="87" height="10" style="border-top:solid #000000;" ><P style="font-size:20%;"></P></td>
                    </tr>
                    </tbody>
                </table>

    </table>
    <table width="700" height="400" cellspacing="0" align="center"  class="yundan_foot">
        <tbody>
        <tr align="right">
            {{$yundan->ydh}}
        </tr>
        </tbody>
    </table>
</div>

<audio id="chatAudio">
    <source src="../audio/success.ogg" />
    <source src="../audio/success.mp3" />
    <source src="../audio/success.wav" />
</audio>
<?php
echo "<script>$('#chatAudio')[0].play()</script>";
?>
</body>
</html>