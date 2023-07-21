@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 block lg:flex items-center justify-between">
        <div class="w-full">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('email') !!}
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4 pt-0">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Art</x-ag.table.th>
                    <x-ag.table.th>Empfänger</x-ag.table.th>
                    <x-ag.table.th>Betreff</x-ag.table.th>
                    <x-ag.table.th>Versendet</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($emails as $email)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2 cursor-pointer">{{ $email->email_art }}</td>
                            <td class="p-2 cursor-pointer">{{ $email->email_empfaenger }}</td>
                            <td class="p-2 cursor-pointer">{{ $email->email_betreff }}</td>
                            <td class="p-2 cursor-pointer">{{ Carbon::parse($email->email_send_date)->format('d.m.Y') }}</td>
                        </x-ag.table.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>
        </div>
    </x-ag.main.head>
</div>
