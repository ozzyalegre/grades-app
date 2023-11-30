<div>
    <div>
        <h1 class="text-sm px-3 text-center">{{ $class_name }}</h1>
        <canvas id="myChart-{{ $subject_id }}" class="p-4"></canvas>
    </div>
</div> 
    
<script>
const ctx{{$subject_id}} = document.getElementById("myChart-{{ $subject_id }}");

new Chart(ctx{{$subject_id}}, {
    type: 'line',
    data: {
        labels: @js($class_grades_dates),
        datasets: [{
            label: 'GPA',
            data: @js($class_grades_gpas),
            borderWidth: 1,
            tension: 0.5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
            beginAtZero: true
            }
        },
        animation: {
            duration: 1000,
            easing: "easeIn",
        }
    }
});
</script>

   

