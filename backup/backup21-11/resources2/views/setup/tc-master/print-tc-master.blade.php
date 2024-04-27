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
         <?php
               $string = $year->is_name;

               // Use regular expression to extract the numeric value
               if (preg_match('/\d+/', $string, $matches)) {
                  $numericValue = $matches[0];
               }
               ?>
          <table style="width: 100%;margin-top:-0.5%;">
            <p style="padding-left: 86%; "> <span style="color: #000; font-size: 11px;">IS: {{$numericValue}} : {{$year->year}}</span><br>
               <img src="{{asset('public')}}/printasset/isi.png" style="width: 25px;margin-top:6px;margin-left:45%;">  <img src="{{asset('public')}}/printasset/boxdesign1.jpg" style="width: 20px;margin-top:6px; "><br> <span style="color: #000; font-size: 11px;">CM/L:{{$tc_master->cml_no}}</span>
            </p>
         </table>
         <table  width="100%" style="width:96%;margin-right:-2%;margin-top: -1%; ">
            <tr>
                
               <th style="width: 0%; text-align: left;">
                  <img src="{{asset('public')}}/printasset/An ISO 9001 2015 Company (3).png" style="width: 200px; margin-left: 5%; margin-top: -10%;">
               </th>
              
               <td style="text-align:right ; color: #204f7d;font-size: 40px;font-weight: 700;"> <span style="">TEST CERTIFICATE</span><br> <b style="font-size: 11px; color: #000; font-weight: 700;">Format No F/08/17/R-03</b></td>
            </tr>
         </table>
         <hr style="border-top:1px solid #6cbc4f; width:75%; margin-top: -22px;margin-bottom:20px;margin-left:20%; ">
         <table style="width:95%; margin: 25px 0px 0px 28px !important;border: 1px solid #899499;border-collapse: collapse; background-color:#6cbc4f;margin-top:3px; ">
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom:0px; text-align: justify; font-weight: 300; margin-top:20px;">
                  Product
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$tc_master->product }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Conforms to IS
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{$numericValue}} : {{$year->year}}
                  </span>
               </th>
               <th
                  >
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-left:%;">
                  To M/s
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> &nbsp;&nbsp;{{ $tc_master->cast_details->cus_name }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">
                  TC No.
                  </span>
                  
                  <span  style="width:75%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$tc_master->created_at->format('y') }}{{substr($tc_master->cast_details->cus_id, -3)}}{{ substr(str_replace(' ', '', $tc_master->is_no), -2) }}{{substr($tc_master->tc_id, -4)}}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">
                  Date 
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ $tc_master->date1 }}
                  </span>
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-left:%;">
                  Address
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;">{{ $tc_master->address1}}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">PO No
                  </span>
                  <span  style="width:75%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ @$tc_master->po_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">
                  Date 
                  </span>
                  <span  style="width:65%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ $tc_master->date2 }}
                  </span>
               </th>
            </tr>
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-left:%;">
                  </span>
                  <span  style="width:72%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ @$tc_master->address2}}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">DO No
                  </span>
                  <span  style="width:73%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tc_master->podo_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;">
                  Date 
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ $tc_master->date3 }}
                  </span>
               </th>
            </tr>
         </table>
          
         <table style="width: 96%;margin-top: %; margin-bottom: 10px;">
            <p style="font-size: 11px; margin-left: 5%;">We certify that the material described below fully conforms to <b>IS {{$numericValue}} : {{$year->year}}</b>Chemical composition & physical properties of the product as tested in accordance with SCHEME OF INSPECTION AND<br> 
TESTING. Contained in the BIS certifications Marks L/C No. CM/L<b>{{ $tc_master->cml_no}}</b> are as indicated in your order (Please refer to <b>IS {{$numericValue}} : {{$year->year}} </b>for details of specification requirements)</p>
         </table>
         <table cellspacing="0" border="1" width="100%" style="text-align:center;width:80%;margin: 0 auto;margin-top: px;background-image:url('{{asset('public')}}/printasset/bg.jpg');background-repeat: no-repeat;background-position: center center;">
            <!--Marksheet Table Heading Start-->
           
              <tr>
                <th style="font-size: 10px;border-bottom: none; margin-top: %;">Sl No</th>
                <th style="font-size: 10px; border-bottom: none;">Description<br>Type X OD X Thickness x Grade X Surface
                    Condition X Ends
                </th>
                <th style="font-size: 10px;border-bottom: none;">Cast/ID No.</th>
                <th style="font-size: 10px; border-bottom: none;">Quantity<br>Pcs/Mtr/MT</th>
                <th colspan="5"style="font-size: 10px;">Chemical Composition</th>
                <th colspan="3"style="font-size: 10px;">Mechanical property</th>
                <th style="font-size:11px; border-bottom: none;">Bend Test</th>
                <th rowspan="2"style="font-size: 10px;">Flattening<br>Test</th>
                <th rowspan="2"style="font-size: 10px;">Drift
                    Expansion Test</th>
                <th colspan="5"style="font-size: 10px;">Galvanizing Coating Test</th>
                <th style="font-size: 10px; border-bottom: none;">Remarks</th>
            </tr>
            <tr>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="border-top: none;"></th>
               <th style="font-size: 10px;">C%</th>
               <th style="font-size: 10px;">Mn%</th>
               <th style="font-size: 10px;">P%</th>
               <th style="font-size: 10px;">S%</th>
               <th style="font-size: 10px;">CE%</th>

               <th style="font-size: 10px;">YST(MPa)</th>
               <th style="font-size: 10px;">UTS(MPa)</th>
               <th style="border-top: none;font-size: 10px;">Elong%</th>
               <th style="border-top: none;"></th>

               <th style="font-size: 10px;width:30px;">Mass of Zink<br>gm/m<sup>2</sup></th>
               <th style="font-size: 10px;width: 20px;">Uniformity test<br>5x1 min</th>
               <th style="font-size:10px;">Coating Thickness (µ)</th>
                <th style="font-size: 10px;">Adhesion Test</th>
                 <th style="font-size: 10px;">Free Bore Test</th>
               <th style="border-top: none;"></th>
            </tr> 
             <tr>
              <td style="font-size: 10px;">Specified</td>
              <td></td>
              <td></td>
              <td style="font-size: 10px;"><b>{{@$tc_master->unit}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->c_max}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->mn_max}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->ph_max}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->su_max}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->ce_max}}</b></td>
              <td style="font-size: 10px;"><b>(Max)<br>{{@$tc_master->yst_min}}</b></td>
              <td style="font-size: 10px;"><b>(Min)<br>{{@$tc_master->uts_min}}</b></td>
              <td style="font-size: 10px;"><b>(Min)<br>{{@$tc_master->elgn_min}}</b></td>
            <td style="font-size:10px;"><b><br></b></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>

           
         @for ($i = 1; $i <= 8; $i++)
        @if (isset($tc_details[$i - 1]))
        @php
            $list = $tc_details[$i - 1];
            $sizedesire=DB::Table('size_masters')->where('id',@$list->batch_size)->first();
            $bporgi=DB::Table('batches')->where('batch_no',@$list->batch_no)->first();

        @endphp
        <tr>
            <td style="font-size: 11px;">{{ $i }}</td>
            <td style="font-size: 11px; width: 200px;">ERW {{@$sizedesire->desier}} {{@$list->thikness}} {{@$list->grade}} {{ $bporgi === 'Black' ? 'BP' : ($bporgi === 'Galvanised' ? 'GI' : 'BP') }} {{@$list->ends}}</td>
            <!-- <td style="font-size: 11px;" >{{ @$tc_master->cast_details->cus_id }}</td> -->
            <td style="font-size: 11px;" >{{ @$list->lot_no }}/{{@$list->hitNo}}</td>

            <td style="font-size: 11px;">{{ @$list->quantiy }}</td>
            <td style="font-size: 11px;">{{ @$list->c_per }}</td>
            <td style="font-size: 11px;">{{ @$list->mn_per }}</td>
            <td style="font-size: 11px;">{{ @$list->p_per }}</td>
            <td style="font-size: 11px;">{{ @$list->s_per }}</td>
            <td style="font-size: 11px;">{{ @$list->ce_per }}</td>
            <td style="font-size: 11px;">{{ @$list->yst }}</td>
            <td style="font-size: 11px;">{{ @$list->uts }}</td>
            <td style="font-size: 11px;">{{ @$list->elgn }}</td>
            <td style="font-size: 11px;">{{ @$list->bend_test }}</td>
            <td style="font-size: 11px;">{{ @$list->flt_test }}</td>
            <td style="font-size: 11px;">{{ @$list->drift_expn }}</td>
            <td style="font-size: 11px;">{{ @$list->massof_zn }}</td>
            <td style="font-size: 11px;">{{ @$list->freeboretest }}</td>
            <td style="font-size: 11px;">{{ number_format($list->massof_zn / 7.05, 2) }}</td>
            <td style="font-size: 11px;">{{ @$list->adh_test }}</td>
            <td style="font-size: 11px;">{{ @$list->freeboretest }}</td>
            <td style="font-size: 11px;">{{ @$list->remarks }}</td>
        </tr>
    @else
        <tr>
            <td style="font-size: 11px;">{{ $i }}</td>
            <td style="font-size: 11px; width: 100px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
            <td style="font-size: 11px;"></td>
        </tr>
    @endif
@endfor
             
         </table>
      
         <table style="width: 100%; ">
           <!--  <tr>
               <td  style="font-size:10px;padding-left: 36px; font-weight: 500;">It is certified that each steel tube is NDT/ hydrostatically tested to test pressure of MPa. Also Material supplied confirms to standard dimensions
and mass tolerances & Straightness. * And for circular & rectangular hollow section conforms to standard norms on twist, squareness of corner, external
corner radius & concavity/convexity. </td>
                
            </tr>
            <tr>
               <td  style="font-size:10px;padding-left: 36px; font-weight: 500;">B/E- An angle of bevelled and root face conform to standard, P/E- Square cut ends, S/S- Pipe threads conform to IS 554 : 1999 & Fitted sockets conform to IS 1239 P-II : 2011, SWS- Pipe
threads conforming to IS 554 : 1999. Our Products<br> have been manufactured from IS marked HR Coil only.
 </td>
            </tr> -->
             <table style="width: 97%;margin-top: 6px; ">
            <tr>

               <td  style="font-size:9px;padding-left:32px;"><b>It is certified that each steel tube is NDT/ hydrostatically tested to test pressure of {{@$year->hp}} MPa. Also Material supplied confirms to standard Dimensions
and Mass tolerances & Straightness. *<br>  And for circular & rectangular hollow section conforms to standard norms on twist, squareness of corner, Radii of Corner & concavity/convexity.</b><br> <span>B/E- An angle of bevelled and root face conform to standard, P/E- Square cut ends, S/S- Pipe threads conform to IS 554 : 1999 & Fitted sockets conform to IS 1239 P-II : 2011, SWS- Pipe <br>
threads conforming to IS 554 : 1999. <b>Our Products have been manufactured from IS marked HR Coil only<b></span><br><span>


@if(@$tc_master->is_no=='IS 4270')

<i>Remark: Coating Test Confirm At 0°. Temp. (Shall Not Be Brittle) & At 65°. Temp ( Sufficiently Hard Not To Flow On Exposure)</i>
@elseif(@$tc_master->is_no=='IS 1239' && @$tc_master->part_no=='Part II')
<i>Remark: Conformity to maximum inside diameter of internal parallel thread with 'GO' , 'NO GO' , Plain Gauge.</i>
@else
&nbsp;
@endif


</span><br><span>&nbsp;</span></td>
               <th style="font-size: 14px;font-weight: 500;">UTKARSH INDIA LIMITED</th>
            </tr>
         </table>
         </table>
         <table style="width: 100%; margin-top: 10px;padding-left: 3%;">
            <td style="font-size: 9px;">Invoice No. <b>{{ @$tc_master->invoice_no }}</b><br><br> Vehicle No.<b>{{ @$tc_master->vehicleno }}</b></td>
            <th style="font-size: 18px; font-weight: 500;">
               UTKARSH INDIA LIMITED<br>
               <p style="font-size: 9px; margin-bottom: 1px;">Regd.Office: Arrjaw Square, 4th Floor, 95A , Elliot Road, Kolkata-700 016</p>
               <br>
               <p style="font-size: 9px;margin-top: -2%;">Tel.: +91 33 22646666, E-mail: info@utkarshindia.in, Website: www.utkarshindia.com</p>
               <br>
               <p style="font-size: 9px;margin-top: -3%; margin-bottom: 4%;">Factory: NH 6, Vill-Jangalpur, P O-Andul Mouri, Howrah (WB), India, Tel.: +91 33 2669 3856 || NH2, Durgapur Expressway, PO- Gurap, Hooghly-712303, India T 03213 253996</p>

            </th>
            <td style="padding-top: 4%;font-weight: 500;font-size: 9px;"><b style="margin-left: -17%;">Quality Assurance</b></td>
         </table>
         <table style="width: 100%;margin-top: -5%;">
            <p style="font-size: 9px;margin-left: 3%;font-weight: 500;">PLEASE VERIFY THE MARK&nbsp; &nbsp;<img src="{{ asset('public/printasset/bansal.jpg') }}" style="width: 80px; margin-top: 2%;"> &nbsp; <img src="{{ asset('public/printasset/utkarsh-logo.jpg') }}" style="width: 80px; margin-top: 2%;">&nbsp; &nbsp;AND&nbsp; &nbsp; <img src="{{asset('public')}}/printasset/isi.png" style="width: 30px;margin-top: 2%; ">&nbsp; &nbsp;ON OUR PIPES AT EVERY METER AND <b>OUR MATERIALS ARE GURANTEED FOR 12 MONTHS FROM DATE<b></p>
         </table>
        <table style="margin-top: 1%; width: 100%;">
            <tr>
               <td style="width: 100%;height: 5px;background-color: #6cbc4f;"></td>
            </tr>
         </table>
         <!-- ==========================================code here================================== -->
      </div>
   </body>
</html>