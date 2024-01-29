<table border="1">
    @php
        use App\Models\Workorder;
    @endphp

    <thead>
        <tr>
        </tr>
        <tr>
            <th colspan="9" style="font-weight: bold; background-color: yellow; text-align: center;">WORK ORDER EDP
                Cabang {{ cabang($cabang) }}
            </th>


        </tr>
        <tr>
            <th>Bulan : {{ bln($bulan) }}</th>
        </tr>
        <thead>
            <tr style="color: #aedbe9;">
                <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: middle;">NO</th>
                <th colspan="2" style="border: 1px solid #000; text-align: center;">WO Diterima</th>
                <th colspan="2" style="border: 1px solid #000; text-align: center;">WO Selesai</th>
                <th rowspan="2"
                    style="border: 1px solid #000; text-align: center; vertical-align: middle; width:100px;">Target
                    (Jam)</th>
                <th rowspan="2"
                    style="border: 1px solid #000; text-align: center; vertical-align: middle; width:100px;">Aktual
                    (Jam)</th>
                <th rowspan="2" style="border: 1px solid #000; text-align: center; vertical-align: middle;">%</th>
                <th rowspan="2"
                    style="border: 1px solid #000; text-align: center; vertical-align: middle; width:300px;">Keterangan
                </th>

            </tr>

            <tr style="color: #aedbe9;">
                <th style="border: 1px solid #000; text-align: center; width:100px;">Tgl</th>
                <th style="border: 1px solid #000; text-align: center;width:100px;">Jam</th>
                <th style="border: 1px solid #000; text-align: center;width:100px;">Tgl</th>
                <th style="border: 1px solid #000; text-align: center;width:100px;">Jam</th>
            </tr>

        </thead>


    </thead>
    <tbody>
        @foreach ($utamax as $item)
            <tr style="text-align: center;">
                <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000; text-align: center;">
                    {{ Workorder::formatDate($item->date_confirm) }}

                </td>
                <td style="border: 1px solid #000; text-align: center;">
                    {{ Workorder::formatTime($item->date_confirm) }}

                </td>
                <td style="border: 1px solid #000; text-align: center;">
                    {{ Workorder::formatDate($item->date_actual) }}

                </td>
                <td style="border: 1px solid #000; text-align: center;">
                    {{ Workorder::formatTime($item->date_actual) }}

                </td>

                <td style="border: 1px solid #000; text-align: center;">
                    @php
                        $dateEnd = new \DateTime($item->date_end);
                        $dateStart = new \DateTime($item->date_confirm);
                        $dateAcctual = new \DateTime($item->date_actual);
                        $timeTarget = $dateEnd->diff($dateStart)->format('%H:%I:%S');
                        $timeActual = $dateAcctual->diff($dateStart)->format('%H:%I:%S');
                    @endphp

                    {{ $timeTarget }}
                </td>

                <td style="border: 1px solid #000; text-align: center;">
                    {{ $timeActual }}
                </td>
                <td style="border: 1px solid #000; text-align: center;">
                    @php
                        // Create DateTime objects for $timeActual and $timeTarget
                        $timeActualdiff = new \DateTime($timeActual);
                        $timeTargetdiff = new \DateTime($timeTarget);

                        if ($timeTargetdiff >= $timeActualdiff) {
                            $result = '100%';
                        } else {
                            $timeDifferenceHours = $timeActualdiff->diff($timeTargetdiff)->format('%H:%I:%S');
                            [$hours, $minutes, $seconds] = explode(':', $timeDifferenceHours);
                            $timeDifferenceInHours = $hours + $minutes / 60 + $seconds / 3600;

                            // Calculate the percentage based on the time difference
                            $percentage = ($timeDifferenceInHours / $timeActualdiff->format('H')) * 100;

                            // Calculate the result as 100 - percentage
                            $result = 100 - $percentage;
                        }
                    @endphp
                    {{ number_format((float) $result, 2) }}%
                </td>
                <td style="border: 1px solid #000; text-align: center;">
                    {{ $item->keadaan }}

                </td>

            </tr>
        @endforeach
    </tbody>
