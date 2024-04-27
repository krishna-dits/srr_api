<!DOCTYPE html>
<html>
<title>Ame Leave Application</title>
<meta charset="utf-8">
<body>

<style>
    @page {
        size: A4 portrait;
        margin: 0;
        / change the margins as you want them to be. /
    }

    @media print {
        html, body {
        width: 25cm;
        height: 33cm;
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
        height: 33cm;;
        width:100%;
        text-transform: uppercase !important;

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
<div style="padding: 0px 7px 0px 7px;  ">
<!-- ==========================================code here================================== -->
<table style="width: 100%;border-collapse: collapse;margin-top: 20px;">


    <tr style="width:100%">
        <td style= "width:100%">

           <h1 style="text-align:center;font-size: 30px;margin: 0px 0px 0px 0px;color: #000;padding: 10px 0px 10px 0px;  width: 100%; font-weight: 900;">A.M. ENTERPRISES</h1>
         <h5 style="text-align:center;font-size: 20px;margin: 0px 0px 0px 0px;color: #000;  width: 100%;padding: 0px 0px 10px 0px;font-weight: 900;">Haldia</h5>
        </td>
    </tr>
 </table>
    <table style="width: 100%;border-collapse: collapse" >
      <tr style="width:100%">
        <td style= "width:100%">
           <h1 style="text-align:center;font-size: 13px;margin: 0px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 8px 0px 8px 0px;  width: 100%; font-weight: 900;">Application for Leave</h1>
        </td>
    </tr>
    </table>
     <table style="width: 100%; margin: 20px 0px 0px 0px; border-collapse: collapse; ">
   <tr>
   <th style="font-size: 13px; padding: 5px 0px 5px 0px;padding-left: 92%;">Date</th>
   <td style="text-align: left;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; border: 1px solid #000;color: #000">
     &nbsp; {{$leaveDetails[0]->apply_date}}
</td>
</tr>
<tr>
   <th style="font-size: 13px;padding: 5px 0px 5px 0px; margin-top:10%;padding-left: 92%;">Place</th>
   <td style="text-align: left;font-size: 13px;padding: 0px 10px 0px 0px;border: 1px solid #000;color: #000;">
    &nbsp; Haldia</td>
</tr>

</table>
    <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                To
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #000;">
                HR
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Through
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;color: #000;">
                Application
            </td>

          </tr>



    </table>

<table style="width: 100%;border-collapse: collapse" >
      <tr style="width:100%">
        <td style= "width:100%">
           <h1 style="text-align:left;font-size: 13px;margin: 20px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 8px 0px 8px 0px;  width: 100%; font-weight: 900;">Applicant's Details</h1>
        </td>
    </tr>
    </table>
     <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #000;">
                 Name
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #000;">
                {{$leaveDetails[0]->user->name}}
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #000;">
              Mobile No
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #000;">
                {{$userWithDesignation[0]->phone_no}}
            </td>

          </tr>
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             Designation
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                {{$userWithDesignation[0]->designation->designation_name}}
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
               Department
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                12
            </td>

         </tr>
         <tr>
         <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
               Site
            </th>
            <td  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                NA
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;color: #000">
                Ward
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;color: #000;">
                NA
            </td>

         </tr>


    </table>
   <table style="width: 100%;border-collapse: collapse" >
      <tr style="width:100%">
        <td style= "width:100%">
           <h1 style="text-align:left;font-size: 13px;margin: 20px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 8px 0px 8px 0px;  width: 100%; font-weight: 900;">Leave Details</h1>

        </td>
    </tr>
    </table>
     <table style="width: 100%;border-collapse: collapse;">
          <tr>
          <th colspan="" style="text-align: left;font-size: 11px; padding: 10px 15px 10px 15px;border: 1px solid #000;">
                Type
            </th>
            <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                {{$leaveDetails[0]->leave_type;}} leave
            </td>


          </tr>




    </table>
    <table style="width: 100%; border-collapse: collapse;">
          <tr>
          <th  style="text-align: left;font-size: 11px; padding: 10px 20px 10px 20px;border: 1px solid #000;">
                From Date
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                {{$leaveDetails[0]->from_date}}
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                 To Date
            </th>

            @if($leaveDetails[0]->to_date==null)
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    NA
                </td>
            @else
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                {{$leaveDetails[0]->to_date}}
            </td>
            @endif

          </tr>




    </table>
    <table style="width: 100%; border-collapse: collapse;">

        <tr>
                        <th colspan=""style="text-align: left;font-size: 11px; padding: 10px 12px 10px 12px;border: 1px solid #000;">
                           Purpose
                        </th>
                        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                            {{$leaveDetails[0]->purpose}}
                        </td>

                    </tr>
        <tr>
                        <th colspan="" style="text-align: left;font-size: 11px; padding: 10px 14px 10px 14px;border: 1px solid #000;">
                          Resume duty on
                        </th>
                        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                            {{$leaveDetails[0]->resume_duty_on}}
                        </td>

                    </tr>
                       <tr>
                        <th colspan="" style="text-align: left;font-size: 11px; padding: 10px 14px 10px 14px;border: 1px solid #000;">
                        Address during leave
                        </th>
                        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                            {{$userWithDesignation[0]->address}}
                        </td>

                    </tr>

</table>
 <table style="width: 100%;border-collapse: collapse" >
      <tr style="width:100%">
        <td style= "width:100%">
           <h1 style="text-align:center;font-size: 13px;margin: 20px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 8px 0px 8px 0px;  width: 100%; font-weight: 900;">Signature Of Applicant</h1>
        </td>
    </tr>
    </table>
     <h2 style="text-align: center; font-size: 16px;">Approved/Not Approved</h2>
    <table style="margin-left: 200%; width: 100%; margin-top: %;">

       <tr>

                        <td style="text-align: center;font-size: 11px; padding: 30px 80px 30px 80px;border: 1px solid #000;color: #fff;">

                        </td>

                    </tr>
    </table>
     <table style="width: 100%;border-collapse: collapse" >
      <tr style="width:100%">
        <td style= "width:100%">
           <h1 style="text-align:center;font-size: 13px;margin: 20px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 8px 0px 8px 0px;  width: 100%; font-weight: 900;">Signature </h1>
        </td>
    </tr>
    </table>
    <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Designation
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000; color: #fff;">
                {{$userWithDesignation[0]->designation->designation_name}}
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             Date
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;color: #fff;">
                {{$userWithDesignation[0]->designation->designation_name}}
            </td>

          </tr>



    </table>
<!-- ==========================================code here================================== -->
</div>
</body>
</html>
