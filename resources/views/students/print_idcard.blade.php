<!DOCTYPE html>
<html>
<head>
    <title>Student ID Card</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .card { width: 350px; border: 1px solid #000; padding: 10px; }
        .front, .back { margin-bottom: 20px; }
        .photo { width: 100px; height: 100px; border-radius: 50%; border: 1px solid #000; }
    </style>
</head>
<body>
    <div class="card">
        <div class="front">
            <h3>Front</h3>
            <img src="{{ asset('storage/students/'.$student->photo) }}" class="photo">
            <p><strong>{{ $student->first_name }} {{ $student->last_name }}</strong></p>
            <p>Reg No: {{ $student->admission_no }}</p>
            <p>Class: {{ $student->classes->name ?? 'N/A' }}</p>
            <p>Arm: {{ $student->class_arm->name ?? 'N/A' }}</p>
        </div>

        <div class="back">
            <h3>Back</h3>
            <p><strong>Term:</strong> {{ $student->term->name ?? 'N/A' }}</p>
            <p><strong>Session:</strong> {{ $student->academicsessions->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
