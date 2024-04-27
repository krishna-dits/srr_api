<!DOCTYPE html>
<html>
   <title>UTKARSH</title>
   <meta charset="utf-8">
   <body>
      <style>
         @page {
         size: A4 landscape;
         margin: 0;
         / change the margins as you want them to be. /
         }
         @media print {
         html, body {
         width:25cm;
         height:33cm;
         margin: 0 !important;
         padding: 5px !important;
         overflow: hidden;
         }
         }
         body
         {
         font-family: sans-serif;
         background: #ffffff;
         margin: 0 auto;
         height: 33cm;
         width:100%;
         }
         table, th, td {
         border-collapse: collapse;
         }
         tr
         {
         width: 100%;
         height: auto;
         }
      </style>
      <div style="padding: 0px 7px 0px 7px; ">
         <!-- ==========================================code here================================== -->
         {{--  <table style="width: 100%;margin-top:%;">
            <p style="padding-left: 86%;"> <span style="color: #6c6c6c; font-size: 15px;">IS 1239 PART(1):2004</span><br>
               <img src="{{ asset('public/assets/images/brand/isi.png') }}" style="width: 35px;margin-top: 1%;margin-left:2%;">  <img src="{{ asset('public/assets/images/brand/boxdesign1.jpg') }}" style="width: 25px;margin-top: 3%;"><br> <span style="color: #6c6c6c; font-size: 15px;">CM/L:5085766</span>
            </p>
         </table>
         <table  width="90%" style="width:96%;margin-top:-2%;">
            <tr>
               <th style="width: 60%; text-align: left;">
                  <img src="{{ asset('public/assets/images/brand/utkarsh-logo.jpg') }}" style="width: 180px; margin-left: 10%;">
                  <h6 style="font-weight: 600; margin-top: -1%; margin-left: 22%; color: #6d6f71;">An ISO 9001:2015 Company</h6>
               </th>

               <td style="text-align: right; color: #204f7d;font-size: 21px;font-weight: 700;"> TEST CERTIFICATE<br> <b style="font-size: 14px; color: #000; font-weight: 700;">Format No F/08/17/R-02</b></td>
            </tr>
         </table>  --}}

         {{--  <table style="width: 100%; margin: 20px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse; background-color:#6cbc4f;margin-top: -2%;">
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300; margin-left: -10%;margin-top:5%;">
                  Product
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> Mild Steel Black Tubes (ERW)
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300;margin-left:-28%;margin-top:5%;">
                  Conforms to IS
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> IS 1239 Part(I):2004
                  </span>
               </th>
               <th
                  >
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300; margin-left: -10%;">
                  To M/s
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> Kalyani Alloy Castings LTD.
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300;margin-left:-26%;">
                  TC No.
                  </span>
                  <span  style="width:76%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> Tube/23-24/39/01274
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300;">
                  Date
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> 13-08-2023
                  </span>
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300; margin-left: -10%;">
                  Address
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;">Chandrani More, Muragacha
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300;margin-left:-26%;">
                  Invoice No.
                  </span>
                  <span  style="width:70%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;">J003686/23-24
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 10px; text-align: justify; font-weight: 300;">
                  Date
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 10px; text-align: justify;"> 13-08-2023
                  </span>
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 15px; text-align: justify; font-weight: 300;margin-left: 10%;">
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 15px; text-align: justify;">Road Kalyani,Nadia
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 15px; text-align: justify; font-weight: 300;margin-left:-24%;">
                  P O.D O
                  </span>
                  <span  style="width:76%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 15px; text-align: justify;">OMBP/000566/23-24
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 13px;color:#000; margin-bottom: 15px; text-align: justify; font-weight: 300;">
                  Date
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:13px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 15px; text-align: justify;"> 13-08-2023
                  </span>
               </th>
            </tr>
         </table>  --}}
         <table style="width: 100%; margin-top:5%;">
             <tr>
                <th>
                  <span>IS : 1239 P-1 : 2004</span>
                </th>
             </tr>
             <tr>
             <th style="text-align: left;padding-left:4%;"><b>Product Name Shown as- Mild Steel Tube</b> (For water, non-hazardous gas, air and steam)</th> <br></tr>
             <tr><th>OR</th></tr>
             <tr>
                <th style="text-align: left; padding-left:21.5%;">Carbon Steel Tube (For water, non-hazardous gas, air and steam)</th>
             </tr>
         </table>
          <table style="width: 100%;">
             <tr>
               <td style="font-size: 13px;padding-left:3%;">Test Results table shown as-</td>
             </tr>
         </table>
         <table cellspacing="0" border="1" width="100%" style="text-align:center;width:100%;margin: 0 auto;margin-top: 10px;">

            <tr>
               <th style="font-size: 11px;border-bottom: none; margin-top: 2%;">Sl No</th>
               <th style="font-size: 11px; border-bottom: none;">Description<br>Type X NB X Class X Surface Condition X Ends</th>
               <th style="font-size: 11px; border-bottom: none;">Cast/ID No.</th>
               <th style="font-size: 11px; border-bottom: none;">Quantity<br>Pcs/Mtr/MT</th>
               <th colspan="4"style="font-size: 11px;">Chemical Composition</th>
               <th colspan="3"style="font-size: 11px;">Mechanical property</th>
               <th style="font-size: 11px; border-bottom: none;">Flattering<br>/Bend Test</th>
               <th rowspan="2"style="font-size: 11px;">Drift<br>Expn</th>
               <th colspan="4"style="font-size: 11px;">Galvanizing Coating Test</th>
               <th style="font-size: 11px; border-bottom: none;">Remarks</th>
            </tr>
            <tr>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="font-size: 11px;">C%</th>
               <th style="font-size: 11px;">Mn%</th>
               <th style="font-size: 11px;">P%</th>
               <th style="font-size: 11px;">S%</th>

               <th style="font-size: 11px;">Yst(Mpa)</th>
               <th style="font-size: 11px;">Ust(Mpa)</th>
               <th style="border-top: none;font-size: 11px;">Elong%</th>
               <th style="border-top: none;"></th>

               <th style="font-size: 11px;width: 80px;">Mass of Zn<br>gms/m<sup>2</sup></th>
               <th style="font-size: 11px;width: 80px;">Uniformity test<br>5x1 min</th>
               <th style="font-size: 11px;">Adhesion Test</th>
               <th style="font-size: 11px;">Free Bore Test</th>
               <th style="border-top: none;"></th>
            </tr>
            <tr>
              <td style="font-size: 11px;">Specified</td>
              <td></td>
              <td></td>
              <td style="font-size: 11px;">MT</td>
              <td style="font-size: 11px;">(Max)<br>0.20</td>
              <td style="font-size: 11px;">(Max)<br>1.30</td>
              <td style="font-size: 11px;">(Max)<br>0.040</td>
              <td style="font-size: 11px;">(Max)<br>1.30</td>
              <td style="font-size: 11px;">(Max)<br>0.040</td>
              <td style="font-size: 11px;">(Max)<br>0.040</td>
              <td style="font-size: 11px;">(Min)<br>NA</td>
              <td style="font-size: 11px;">(Min)<br>320</td>
               <td style="font-size: 11px;">(Min)<br>12/20</td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>

            <tr>
               <td style="font-size: 11px;">1</td>
               <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
               <td style="font-size: 11px;">WD15A</td>
               <td style="font-size: 11px;">0.670</td>
               <td style="font-size: 11px;">0.80</td>
               <td style="font-size: 11px;">0.41</td>
               <td style="font-size: 11px;">0.022</td>
               <td style="font-size: 11px;">0.007</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">432</td>
               <td style="font-size: 11px;">30</td>
               <td style="font-size: 11px;">OK</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">NA</td>
               <td style="font-size: 11px;">OK</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">2</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">3</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">4</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">5</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">6</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">7</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">8</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">9</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
             <tr>
                <td style="font-size: 11px;">10</td>
                <td style="font-size: 11px;width: 150px;">NB65MM HEAVY</td>
                <td style="font-size: 11px;">WD15A</td>
                <td style="font-size: 11px;">0.670</td>
                <td style="font-size: 11px;">0.80</td>
                <td style="font-size: 11px;">0.41</td>
                <td style="font-size: 11px;">0.022</td>
                <td style="font-size: 11px;">0.007</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">432</td>
                <td style="font-size: 11px;">30</td>
                <td style="font-size: 11px;">OK</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">NA</td>
                <td style="font-size: 11px;">OK</td>
             </tr>
            </table>
             <table style="width: 100%; margin-top: 3%;">
                <tr>
                    <th style="font-size: 15px;">It is certified that each steel tube is NDT/ hydrostatically tested to test pressure of  5 MPa. Also Material supplied confirms to standard</th>

                </tr>
                <tr>
                    <th style="text-align: left;font-size: 15px; padding-left: 7%;">dimensions and mass tolerances.</th>
                </tr>

             </table>
             <table style="width: 100%; margin-left: 8%;">
                <tr>
                    <ul>
                        <li style="font-size:14px; ">B/E- An angle of bevelled and root face conform to standard.</li>
                        <li style="font-size:14px; margin-top: 5px;">P/E- Square cut ends</li>
                        <li style="font-size:14px; margin-top: 5px;">S/S- Pipe threads conform to IS 554 : 1999 & Fitted sockets conform to IS 1239 P-II : 2011</li>
                        <li style="font-size:14px; margin-top: 5px;">SWS- Pipe threads conforming to IS 554 : 1999</li>
                        <li style="font-size:14px; margin-top: 5px;">BP- Black Pipe</li>
                        <li style="font-size:14px; margin-top: 5px;">GP- Galvanized Pipe</li>
                        <li style="font-size:14px; margin-top: 5px;">Our Products have been manufactured from IS marked HR Coil only.</li>
                    </ul>
                </tr>
             </table>
             <table style="width: 100%;margin-left:7%;">
                <tr>
                    <td>Invoice No.</td>
                </tr>
                <tr>
                    <td>Vehicle No.</td>
                </tr>
             </table>

         <!-- ==========================================code here================================== -->
      </div>
   </body>
</html>
