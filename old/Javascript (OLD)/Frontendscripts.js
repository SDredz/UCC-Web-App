// Add click event listeners to navigation links
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.getElementById('nav-links');
    const links = [
        { text: 'Admin Login', href: '#', action: promptAdmin },
        { text: 'Student Login', href: '#', action: promptStudent },
        { text: 'Available Courses Login', action: showAvailable },
        { text: 'Register Login', href: '#', action: showRegistrationForm },
    ];
    
    links.forEach(({ text, href, action }) => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.textContent = text;
        a.href = href;
        li.appendChild(a);
        navLinks.appendChild(li);

        // Attach click event listener
        a.addEventListener('click', (e) => {
        e.preventDefault();
        action(e.target);
        });
    });
});

    // Function to handle admin prompt
    function promptAdmin(target) {
    if (confirm('Are you an admin?')) {
    window.location.href = 'AdminLogin.html';
    } else {
    target.blur();
    }
    }

    // Function to handle student prompt
    function promptStudent(target) {
    if (confirm('Are you a student?')) {
        window.location.href = 'StudentLogin.html';
    } else {
        target.blur();
    }
    }

    function showAvailable(){
        window.location.href = 'Courses.html' ;
    }
    
    // Function to show registration form
    function showRegistrationForm(target) {
        window.location.href = 'StudentRegistration.html' ;
    };