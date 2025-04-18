<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Exam Numbers</title>
    
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

    <h4>Class Examination Numbers</h4>
    <h5>{{$program}} ( {{$pclass}} | Semester - {{$semester}} ) - {{$pcampus}}</h5>
    <h5>Intake: {{$acdyear}} | {{$acmonth}} {{$acname}} {{$acdescription}}</h5><br>
    
    <table>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Registration#</th>
            <th>Exam Number</th>
        </tr>
       
        @foreach($stuNumbers->sortBy(fn($examNumber) => App\Models\User::where('reg_num', $examNumber->reg_num)->value('lname')) as $examNumber)

        @php 
            $student = App\Models\User::where('reg_num', $examNumber->reg_num)->first();
        @endphp
           
            <tr>
                <td>{{$i++}}</td>
                <td style="text-align: left;">{{$student->fname}} {{$student->lname}}</td>
                <td>{{$student->reg_num}}</td>
                <td>{{$examNumber->exam_number}}</td>
                
               
            </tr>
        @endforeach

    </table>
    <br>
    <div class="footer">
            <i>Exam Number Report - Generated by MCHS Student portal</i>
    </div>
   
</body>
</html>
