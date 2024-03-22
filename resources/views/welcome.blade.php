<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-800 p-4">
<div class="flex flex-col md:flex-row justify-between m-4">
    <div class="overflow-x-auto mb-4 border-4 border-x-lime-400 rounded-lg md:w-min w-full h-min">
        <div class="flex p-2 justify-center bg-gradient-to-r from-neutral-900 to-neutral-300">
            <span>Task 1</span>
        </div>
        <table class="table md:w-max w-full bg-neutral-200">
            <thead>
            <tr class="w-max border border-b-slate-800">
                <th class="text-left p-3">Hotel ID</th>
                <th class="text-left p-3">Weekend Stays</th>
            </tr>
            </thead>
            <tbody>
            @foreach($minStays as $minStay)
                <tr class="w-max border border-b-slate-600">
                    <td class="text-left p-3">{{ $minStay->hotel_id }}</td>
                    <td class="text-left p-3">{{ $minStay->weekend_stays }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto mb-4 border-4 border-y-lime-400 rounded-lg md:w-min w-full h-min">
        <div class="flex p-2 justify-center bg-gradient-to-r from-neutral-300 to-neutral-900">
            <span>Task 2</span>
        </div>
        <table class="table md:w-max w-full bg-neutral-200">
            <thead>
            <tr class="w-max border border-b-slate-800">
                <th class="text-left p-3">Hotel ID</th>
                <th class="text-left p-3">Rejection Rate (%)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rejects as $reject)
                <tr class="w-max border border-b-slate-600">
                    <td class="text-left p-3">{{ $reject->hotel_id }}</td>
                    <td class="text-left p-3">{{ round($reject->rate, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto mb-4 border-4 border-x-lime-400 rounded-lg md:w-min w-full h-min">
        <div class="flex p-2 justify-center bg-gradient-to-r from-neutral-900 to-neutral-300">
            <span>Task 3</span>
        </div>
        <table class="table md:w-max w-full bg-neutral-200">
            <thead>
            <tr class="w-max border border-b-slate-800">
                <th class="text-left p-3">Week Number</th>
                <th class="text-left p-3">Total Profit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($profits as $profit)
                <tr class="w-max border border-b-slate-600">
                    <td class="text-left p-3">{{ $profit->start_week }} - {{ $profit->end_week }}</td>
                    <td class="text-left p-3">{{ round($profit->total_profit) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto mb-4 border-4 border-y-lime-400 rounded-lg md:w-min w-full h-min">
        <div class="flex p-2 justify-center bg-gradient-to-r from-neutral-300 to-neutral-900">
            <span>Task 4</span>
        </div>
        <table class="table md:w-max w-full bg-neutral-200">
            <thead>
            <tr class="w-max border border-b-slate-800">
                <th class="text-left p-3">Customer</th>
                <th class="text-left p-3">Rejection Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unluckyCustomers as $unluckyCustomer)
                <tr class="w-max border border-b-slate-600">
                    <td class="text-left p-3">{{ $unluckyCustomer->name }}</td>
                    <td class="text-left p-3">{{ $unluckyCustomer->rejection_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

