<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggregated Grades Report</title>
    
    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 10px;
            text-align: left;
        }

        h4, h5 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            font-size: 14px; /* Adjust font size for fitting */
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
        }

        td {
            color: #333;
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

        .sup {
            color: #ffc107;
            font-weight: bold;
        }

        .repeat {
            color: #dc3545;
            font-weight: bold;
        }

        caption {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .bold-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    @php 
        $lecturer = Auth::user()->id;
        $i = 1;
    @endphp

    <h4>Module Aggregation: {{$coursename->code}} - {{$coursename->name}}</h4>
    <h5>{{$class->classcode}} - 
        @if($class->campus_id==1) LL @endif
        @if($class->campus_id==2) BT @endif 
        @if($class->campus_id==3) ZA @endif 
        - Semester {{$lecturerModule->semester}}
    </h5>
    <h5>Lecturer: {{$fname}} {{$lname}}</h5>
    
    <table>
        <tr>
            <th colspan="3">Student</th>
            <th colspan="3">Continuous Assessment (40%)</th>
            <th colspan="2">End of Semester (60%)</th>
            <th>Final Grade</th>
            <th>Remark</th>
        </tr>
        <tr class="bold-row">
            <td>SN.</td>
            <td>Name</td>
            <td>Registration#</td>
            <td>Assignment 1</td>
            <td>Mid Semester</td>
            <td>40%</td>
            <td>EoS Grade</td>
            <td>60%</td>
            <td>100%</td>
            <td> - </td>
        </tr>

        @foreach($stuGrades as $myGrades)
            @php 
                $stuWithGrades = App\Models\User::findOrFail($myGrades->user_id);
            @endphp
            <tr>
                <td>{{$i++}}</td>
                <td style="text-align: left;">{{$stuWithGrades->fname}} {{$stuWithGrades->lname}}</td>
                <td>{{$myGrades->registration_no}}</td>
                <td>{{$myGrades->assessment1 ?? '-'}}</td>
                <td>{{$myGrades->assessment2 ?? '-'}}</td>
                <td>{{$myGrades->computed40 ?? '-'}}</td>
                <td>{{$myGrades->exam_grade ?? '-'}}</td>
                <td>{{$myGrades->computed60 ?? '-'}}</td>
                <td>{{$myGrades->final_grade ?? '-'}}</td>

                <!-- Remark -->
            @if($myGrades)
                <td class="
                    @if($myGrades->final_grade >= 50) pass 
                    @elseif($myGrades->final_grade >= 40 && $myGrades->final_grade < 50) sup 
                    @elseif($myGrades->final_grade < 40) repeat 
                    @endif">
                    @if($myGrades->final_grade >= 50) Pass 
                    @elseif($myGrades->final_grade >= 40 && $myGrades->final_grade < 50) Sup 
                    @elseif($myGrades->final_grade < 40) Fail 
                    @endif
                </td>
            @else
            <td class="Sup text-warning">---</td>
            @endif
            </tr>
        @endforeach

    </table>

    <br>
   
    <br>
    <h3>Module assessment summary</h3>
    <p>Average Final Grade: <strong>{{ round($averageFinalGrade, 2) }}</strong></p>
    <table>
        
      <tr>
            <td>Number of Students</td>
            <td>Total Number of Passes</td>
            <td>% Passes</td>
            <td>Number of Sups</td>
            <td>% Sups</td>
            <td>Number of Repeats</td>
            <td>% Repeats</td>

        </tr>
        <tr>
            <td>{{ round($stuCount), 2}}</td>
            <td>{{ round($passCount), 2}}</td>
            <td>{{ round($passRate), 2}}</td>
            <td>{{ round($supCount), 2}}</td>
            <td>{{ round($supRate), 2}}</td>
            <td>{{ round($repeatCount), 2}}</td>
            <td>{{ round($repeatRate), 2}}</td>


        </tr>
    </table>
</body>
</html>
