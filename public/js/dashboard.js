function updateTotalTasks() {
    fetch('/api/total-tasks')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-tasks').textContent = data.totalTasks;
        })
        .catch(error => console.error('Error fetching total tasks:', error));
}

document.addEventListener('DOMContentLoaded', updateTotalTasks);
