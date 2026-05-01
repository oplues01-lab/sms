<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Questions Export</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .metadata {
            margin: 10px 0;
            font-size: 13px;
        }
        .metadata-row {
            display: inline-block;
            margin-right: 30px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold;
        }
        .question-num {
            width: 40px;
            text-align: center;
        }
        .marks-col {
            width: 50px;
            text-align: center;
        }
        .options {
            font-size: 11px;
            margin: 5px 0;
        }
        .correct-answer {
            font-weight: bold;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Questions Bank</h1>
        <div class="metadata">
            <span class="metadata-row"><strong>Class:</strong> {{ $metadata['class'] }}</span>
            <span class="metadata-row"><strong>Subject:</strong> {{ $metadata['subject'] }}</span>
            <span class="metadata-row"><strong>Term:</strong> {{ $metadata['term'] }}</span>
        </div>
        <div class="metadata">
            <span class="metadata-row"><strong>Session:</strong> {{ $metadata['session'] }}</span>
            <span class="metadata-row"><strong>Type:</strong> {{ $metadata['type'] }}</span>
            <span class="metadata-row"><strong>Total Questions:</strong> {{ $questions->count() }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="question-num">#</th>
                <th>Question & Options</th>
                <th class="marks-col">Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $index => $q)
            <tr>
                <td class="question-num">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $q->question }}</strong>
                    @if($q->option_a || $q->option_b || $q->option_c || $q->option_d)
                    <div class="options">
                        @if($q->option_a)
                        <div class="{{ $q->correct_option == 'A' ? 'correct-answer' : '' }}">
                            A. {{ $q->option_a }}
                        </div>
                        @endif
                        @if($q->option_b)
                        <div class="{{ $q->correct_option == 'B' ? 'correct-answer' : '' }}">
                            B. {{ $q->option_b }}
                        </div>
                        @endif
                        @if($q->option_c)
                        <div class="{{ $q->correct_option == 'C' ? 'correct-answer' : '' }}">
                            C. {{ $q->option_c }}
                        </div>
                        @endif
                        @if($q->option_d)
                        <div class="{{ $q->correct_option == 'D' ? 'correct-answer' : '' }}">
                            D. {{ $q->option_d }}
                        </div>
                        @endif
                        @if($q->correct_option)
                        <div style="margin-top: 5px;">
                            <strong>Answer: {{ $q->correct_option }}</strong>
                        </div>
                        @endif
                    </div>
                    @endif
                </td>
                <td class="marks-col">{{ $q->marks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>