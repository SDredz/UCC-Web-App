const baseUrl = 'http://localhost:3001';
const lecturersTableBody = document.querySelector('#lecturers-table tbody');

// Fetch lecturers from the backend
async function fetchLecturers() {
    const response = await fetch(`${baseUrl}/api/lecturers`);
    const lecturers = await response.json();
    return lecturers;
}

// Display lecturers in the table
function displayLecturers(lecturers) {
    lecturersTableBody.innerHTML = '';
    lecturers.forEach((lecturer) => {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${lecturer.id}</td>
        <td>${lecturer.name}</td>
        <td>${lecturer.email}</td>
        <td>${lecturer.Department}</td>
        <td>${lecturer.Position}</td>
        <td>
        <button class="delete-lecturer-btn" data-id="${lecturer.id}">Remove</button>
        </td>
    `;
    lecturersTableBody.appendChild(row);
    });
}

// Add event listener for removing lecturers
function addRemoveLecturerListeners() {
    const deleteButtons = document.querySelectorAll('.delete-lecturer-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', async () => {
            const { id } = button.dataset;
            await fetch(`${baseUrl}/api/lecturers/${id}`, { method: 'DELETE' });
            const lecturers = await fetchLecturers();
            displayLecturers(lecturers);
        });
    })
}

// Add event listener for adding lecturers
document.querySelector('#add-lecturer-btn').addEventListener('click', () => {
    const nameInput = prompt('Enter the lecturer name:');
    const emailInput = prompt('Enter the lecturer email:');
    const DepartmenInput = prompt('Enter the lecturer Department:');
    const PositionInput = prompt('Enter the lecturer Position:');

    if (nameInput && emailInput && DepartmenInput && PositionInput) {
        fetch(`${baseUrl}/api/lecturers`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name: nameInput, email: emailInput, Department: DepartmenInput, Position: PositionInput }),
        })
        .then((response) => response.json())
        .then((lecturer) => {
            const lecturers = [lecturer];
            displayLecturers(lecturers);
        });
    }
});

// Fetch and display lecturers when the page loads
(async () => {
    const lecturers = await fetchLecturers();
    displayLecturers(lecturers);
    addRemoveLecturerListeners();
});