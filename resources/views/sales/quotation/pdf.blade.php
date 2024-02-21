<!DOCTYPE html>
<html>

<head>
    <title>{{$quotation->no_quotation}}_{{date('ymd', strtotime($quotation->created_at))}}</title>
    <style type="text/css">
        @page {
            margin: 0 0;
        }


        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        /* img, */
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            font-family: sans-serif;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        /* table {
            border-collapse: collapse;
            border-spacing: 0;
        } */

        .content {
            margin-top: 30px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .content .header {
            text-align: center;
        }

        .content .header .company-name {
            font-size: 16px;
        }

        .content .header .company-address {
            margin-top: 7px;
            font-size: 11px;
        }

        .bold {
            font-weight: bold;
        }

        .content .header .title {
            font-size: 14px;
        }

        .content .header .period {
            font-size: 13px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .employee-information {
            letter-spacing: 0.1px;
            margin-top: 19px;
            margin-bottom: 19px;
        }

        .employee-information::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .question {
            font-size: 11px;
            margin: 5px 0;
            display: inline-block;
        }

        .left .question {
            width: 40%;
        }

        .right .question {
            width: 35%;
        }

        .answer {
            font-size: 11px;
        }

        .left {
            float: left;
            width: 50%;
        }

        .right {
            float: right;
            width: 35%;
        }

        .detail-left {
            float: left;
            width: 60%;
        }

        .detail-right {
            float: right;
            width: 40%;
        }

        .detail-left .bold,
        .detail-right .bold {
            font-size: 11px;
        }

        .detail-header {
            letter-spacing: 0.1px;
            margin-top: -2px;
            margin-bottom: -2px;
        }

        .detail-header::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .detail-content {
            letter-spacing: 0.1px;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .detail-content::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .detail-content .question {
            font-size: 11px;
            margin: 4px 0;
            display: inline-block;
        }

        .detail-left .question {
            width: 40%;
        }

        .detail-right .question {
            width: 60%;
        }

        .detail-footer {
            letter-spacing: 0.1px;
            margin-top: -10px;
            margin-bottom: -4px;
        }

        .detail-footer::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .footer-left {
            float: left;
            width: 60%;
        }

        .footer-right {
            float: right;
            width: 40%;
        }

        .footer-left .question {
            width: 30%;
        }

        .footer-right .question {
            width: 35%;
        }

        .footer {
            letter-spacing: 0.1px;
            margin-top: 15px;
        }

        .footer .question {
            font-size: 11px;
            margin: 3px 0;
            display: inline-block;
        }

        .footer::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .center {
            margin: auto;
            display: block;
        }

        /* table { */
        /* border-collapse: collapse; */
        /* border-spacing: 0; */
        /* } */

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }

        th {
            padding: 15px;
            border-bottom: 2px solid black;
            margin-bottom: 20px;
        }

        td {
            padding: 15px;
        }

        .page-break {
            page-break-inside: avoid;
            page-break-after: always;
        }

        .left-signature {
            float: left;
            width: 30%;
        }

    </style>
</head>

<body>

    <div class="content">
        <div class="employee-information">
            <div class="left">
                <img src="{{asset('img/logo/jooal.png')}}" width="150px" alt="">
            </div>

            <div class="right">
                <span style="font-size: 10" class="bold">PT HSQA Makmur Abadi</span>
                <br>
                <a style="text-decoration: none;line-height: 20px; font-size: 10" href="www.jooal.id">www.jooal.id</a>
                <p style="line-height: 20px; font-size: 10">Jl. Yusuf Adiwinata No. 32/34, RW.01, Gondangdia, Kec.
                    Menteng Jakarta,
                    Indonesia</p>
            </div>
        </div>

        {{-- <hr style="border: 1.1px solid black;"> --}}

        <div class="employee-information">
            <div class="left">
                <p style="font-size: 10"><span class="bold"><u>Quotation</u></span> :
                    &nbsp;&nbsp;&nbsp;{{$quotation->no_quotation}}</p>
                <p style="line-height: 25px; font-size: 10">Customer &nbsp;: &nbsp;&nbsp;&nbsp;{{$quotation->customer}}
                </p>
                <p style="line-height: 25px; font-size: 10">Alamat &nbsp;&nbsp;&nbsp;&nbsp; :
                    &nbsp;&nbsp;&nbsp;{{$quotation->alamat}}</p>
                <p style="line-height: 25px; font-size: 10">No Telp&nbsp;&nbsp;&nbsp;&nbsp; :
                    &nbsp;&nbsp;&nbsp;{{$quotation->no_telepon}}</p>
                <p style="line-height: 25px; font-size: 10">E-mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                    &nbsp;&nbsp;&nbsp;{{$quotation->email}}</p>
            </div>
            <div class="right">
                <span style="font-size: 10">Bank Account</span>
                <br>
                <span class="bold" style="line-height: 20px;font-size: 10">{{$bank->nama_bank}}</span>
                <p style="line-height: 20px;font-size: 10">Nomor Rekening: <span
                        class="bold">{{$bank->no_rekening}}</span></p>
                <p style="line-height: 20px;font-size: 10">Nama <span class="bold">{{$bank->atas_nama}}</span></p>

            </div>
        </div>

        <hr style="border: 1.1px solid black;">
        <div class="table" style="margin-top:-100px">
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Amount (Rp)</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotation->detailQuotations as $q)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">{{$q->item}}</td>
                        <td style="text-align: center;">{{($q->markup > 0) ? number_format($q->amount + (($q->amount / $q->markup) * 100 )) : $q->markup}}</td>
                        <td style="text-align: center;">{{$q->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="employee-information" style="margin-top:50px !important;">
            <p style="font-size: 10">Notes</p>
            <p style="line-height: 25px; font-size: 10">{{$quotation->notes}}</p>
            <p style="font-size: 10;line-height: 80px;">Terima kasih atas kepercayaan anda kepada www.jooal.id, kami berkomitmen memberikan pelayanan terbaik.</p>
            <div class="left">
                <br>
                <p style="font-size: 10">Salam,</p>
                <br>
                <img src="{{asset('img/logo/jooal-logo.png')}}" width=60px" alt="">
                <br>
                <p style="font-size: 10">Admin Jooal.id</p>
                
            </div>
            <p style="font-size: 10; clear:both; line-height: 50px">Catatan: Dokumen Quotation ini dihasilkan oleh sistem dan tidak membutuhkan tanda tangan ataupun materai</p>
            <p class="bold" style="font-size:10;line-height: 50px">Contact</p>
            <a style="line-height: 20px; font-size: 8" href="www.jooal.id">www.jooal.id</a>
            <br>
            <a style="line-height: 20px; font-size: 8" href="https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=admin@jooal.id">admin@jooal.id</a>
            <br>
            <a style="text-decoration:none; line-height: 20px; font-size: 8" href="javascript:void(0);">0857-1100-0138</a>

        </div>

    </div>
</body>

</html>
