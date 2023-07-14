@php use Carbon\Carbon; @endphp
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/pdf.css') }}" type="text/css"/>
</head>

<body>

@include('layouts.pdf.invoice.header')

@yield('invoiceContent')

@include('layouts.pdf.invoice.footer')

</body>
</html>
