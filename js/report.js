document.addEventListener('DOMContentLoaded', function() {
    const report_data = document.getElementById('report-data');

    function fetchReportData() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'report-data.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                displayReportData(data);
            }
        };
        xhr.send();
    }

    function displayReportData(data) {
        report_data.innerHTML = '';
        data.forEach(report => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${report.event_title}</td>
                <td>${report.report_type}</td>
                <td>${report.report_date}</td>
                <td>${report.total_registration}</td>
            `;
            report_data.appendChild(row);
        });
    }

    fetchReportData();
});