<?php
    require __DIR__.'/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;

    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML('
        <html>
            <head>
                <style>
                    .top-div{
                        margin-top:50px;
                    }
                    .date{
                        font-size:20px;
                        font-weight:900;
                        position:absolute;
                        right:1px;
                        top:80px;
                    }
                    .recipt h1{
                        padding-bottom:0!important;
                        margin-bottom:5px;
                    }
                    .recipt p{
                        color:grey;
                    }
                    .cont{
                        border:1px solid grey;
                        margin-top:10px;
                        padding:10px 10px;
                    }
                    .cont p{
                        font-size:18px;
                        font-weight:700;
                    }
                    .sign{
                        margin-top:20px;
                        margin-left:500px;
                    }
                    .sign img{
                        width:100px;
                        height:50px;
                    }
                </style>
            </head>
            <body>
                <div style="width:85%; margin:auto;">
                    <div class="top-div">
                        <img src="public/images/Save-Green-logo-PNG.png" style="width:200px; height:50px;">
                        <div class="date">15-9-2020</div>
                    </div>
                    <div class="recipt" style="margin-top:25px;">
                        <h1>Recipt #12035124</h1>
                        <p>Thank you for your contribution towards the COVID 19 campaign.</p>
                    </div>
                    <div class="amt">
                        <h2>Total contribution : Rs 50.00</h2>
                    </div>
                    <div class="cont">
                        <p><pre>Contributed by         :    Shaswat P Patel</pre></p>
                        <p><pre>Name of organization   :    Save Green</pre></p>
                        <p><pre>Contact number         :    9998070108</pre></p>
                        <p><pre>Email ID               :    savegreen@gmail.com</pre></p>
                        <p><pre>Website                :    savegreen.com</pre></p>
                        <p><pre>Address                :    Regent Insingnia, No. 414, 3rd floor,
                            4th block, 17th Main, 100 feet road, 
                            Koramangala, Bengaluru - 560034</pre></p>
                        <p><pre>PAN                    :    XYZ</pre></p>
                        <p><pre>80G approval reference :    Donations are exempt under Section 80G 
                            of the IT Act 1961 vide order: 
                            No. CIT (E)/AAATO5745J/ITO (E)-2/2018-19</pre></p>
                    </div>
                    <div class="sign">
                        <img src="public/images/Save-Green-logo-PNG.png">
                        <p>Shaswat Patel, Volunteer</p>
                    </div>
                </div>
            </body>
        </html>
    ');
    $html2pdf->output('', 'S');
?>