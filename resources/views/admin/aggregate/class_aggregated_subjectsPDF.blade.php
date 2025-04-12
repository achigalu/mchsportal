<!DOCTYPE html>
<html>
<head>
    <title>Class Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 1px;
            text-align: left;
        }
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #004085;
            color: #ffffff;
            font-weight: bold;
            font-size: 12px;
        }
        td {
            color: #333;
            text-align: center;
            font-size: 12px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td:first-child {
            text-align: left;
            font-weight: bold;
        }
        .pass {
            color: #28a745;
            font-weight: bold;
        }
        .fail {
            color: #dc3545;
            font-weight: bold;
        }
        caption {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .bold-row td {
            font-weight: bold;
            background-color: #f2f2f2; /* Optional: Light gray background for better visibility */
        }
        
        .Pass { color: #28a745 !important; font-weight: bold; }
        .Sup { color: #ffc107 !important; font-weight: bold; }
        .Repeat { color: #dc3545 !important; font-weight: bold; }
    
    </style>
</head>
<body>
    <h3>Aggregated Class Marks - {{ $myclass->classcode }} (Semester {{ $semester }}) - {{ $mycampus }}</h3>
    <h4>Academic Year: {{ $acyear->ayear }} - {{ $acyear->description }}</h4>

    <table>
        <thead class="custom-table-head">
            <tr style="text-align: left; background-color: #295587; color: white;">
                <th style="text-align: left;">SN</th>
                <th style="text-align: left;">STUDENT NAME</th>
                @foreach ($headers as $header)
                    <th>{{ strtoupper($header) }}</th>
                @endforeach
                <th>REMARK</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
            $totalGrades = 0;
            $totalGradeCount = 0;
        @endphp
        @foreach ($finalResults as $row)
        <tr>
        @php 
            $student = App\Models\User::where('reg_num', $row['registration_no'])->first();
            $grades = array_slice($row, 1); // Extract grades (excluding registration number)

            $failCount = collect($grades)->filter(fn($grade) => $grade < 40)->count(); // Count grades < 40
            $supCount = collect($grades)->filter(fn($grade) => $grade >= 40 && $grade < 50)->count(); // Count grades 40-49

            // Sum the grades and count them
            $totalGrades += array_sum($grades);
            $totalGradeCount += count($grades);

            // Determine Remark & Color
            if ($failCount == 0 && $supCount == 0) {
                $remark = "Pass";  
                $color = "green"; // Pass is green
            } elseif ($supCount > 0 && $supCount <= 2 && $failCount == 0) {
                $remark = "Sup";   
                $color = "orange"; // Sup is orange
            } else {
                $remark = "Fail";  
                $color = "red"; // Fail is red
            }

        @endphp

            <td>{{ $i++ }}</td>
            <td class="custom-name" style="text-align: left;">{{ $student->fname }} {{ $student->lname }}</td>
            <td class="custom-registration">{{ $row['registration_no'] }}</td>
            
            @foreach ($grades as $grade)
                <td class="custom-grade">{{ $grade }}</td>
            @endforeach

            <td class="custom-remark" style="color: {{ $color }}; font-weight: bold;">
                {{ $remark }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @php
        // Calculate the class average grade (avoid division by zero)
        $classAverageGrade = $totalGradeCount > 0 ? round($totalGrades / $totalGradeCount, 2) : 0;
    @endphp

    <br>
    <h4>Class assessment summary</h4>
   <!-- <h5>Class average grade: {{ $classAverageGrade }}</h5><p></p> -->

    @php
        // Initialize Counters
        $totalStudents = count($finalResults);
        $totalPasses = 0;
        $totalSups = 0;
        $totalFails = 0;

        foreach ($finalResults as $row) {
            $grades = array_slice($row, 1); // Extract grades (excluding registration number)

            $failCount = collect($grades)->filter(fn($grade) => $grade < 40)->count(); // Count grades < 40
            $supCount = collect($grades)->filter(fn($grade) => $grade >= 40 && $grade < 50)->count(); // Count grades 40-49

            // Determine Remark & Update Counters
            if ($failCount == 0 && $supCount == 0) {
                $totalPasses++;  
            } elseif ($supCount > 0 && $supCount <= 2 && $failCount == 0) {
                $totalSups++;  
            } else {
                $totalFails++;  
            }
        }

        // Calculate Percentages (avoid division by zero)
        $passPercentage = $totalStudents > 0 ? round(($totalPasses / $totalStudents) * 100, 2) : 0;
        $supPercentage = $totalStudents > 0 ? round(($totalSups / $totalStudents) * 100, 2) : 0;
        $failPercentage = $totalStudents > 0 ? round(($totalFails / $totalStudents) * 100, 2) : 0;
    @endphp

    <table border="1">
        <thead>
            <tr style="text-align: left; background-color:#f1f1f1 ; color: white;">
                <td>Number of Students</td>
                <td>Total Number of Passes</td>
                <td>% Passes</td>
                <td>Number of Sups</td>
                <td>% Sups</td>
                <td>Number of Fail</td>
                <td>% Fails</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">{{ $totalStudents }}</td>
                <td>{{ $totalPasses }}</td>
                <td>{{ $passPercentage }}%</td>
                <td>{{ $totalSups }}</td>
                <td>{{ $supPercentage }}%</td>
                <td>{{ $totalFails }}</td>
                <td>{{ $failPercentage }}%</td>
            </tr>
        </tbody>
    </table>
        <br>
    <h4>Modules</h4>
                    @if(session()->has('courses'))
                <ul>
                    @foreach(session('courses') as $course)
                        <li>{{ $course->code }} - {{ $course->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No courses available.</p>
            @endif
</body>
</html>
