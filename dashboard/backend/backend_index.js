function chart() {
    var ctx = document.getElementById('myChart').getContext('2d');

    axios.post("/api/data.php",
        {
            action: "getdata_for_overview"
        }
    ).then((res) => {
        var data = res.data.data;

        document.getElementById('m1').innerHTML = data['m1'] + ' คน';
        document.getElementById('m2').innerHTML = data['m2'] + ' คน';
        document.getElementById('m3').innerHTML = data['m3'] + ' คน';
        document.getElementById('m4').innerHTML = data['m4'] + ' คน';
        document.getElementById('m5').innerHTML = data['m5'] + ' คน';
        document.getElementById('m6').innerHTML = data['m6'] + ' คน';
        console.log(data)
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['ม.1', 'ม.2', 'ม.3', 'ม.4', 'ม.5', 'ม.6'],
                datasets: [{
                    label: '# of Votes',
                    data: [data['m1'], data['m1'], data['m3'], data['m4'], data['m5'], data['m6']],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
    }
    )
}
chart();