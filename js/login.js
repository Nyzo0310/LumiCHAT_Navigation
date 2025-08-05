document.getElementById('loginForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const loginMessage = document.getElementById('loginMessage');

  const users = [
    { email: "admin@gmail.com", password: "admin123", role: "admin" },
    { email: "student@gmail.com", password: "student123", role: "student" }
  ];

  const user = users.find(u => u.email === email && u.password === password);

  if (user) {
    loginMessage.style.color = "green";
    loginMessage.textContent = "Login successful! Redirecting...";
    setTimeout(() => {
      if (user.role === "admin") {
        window.location.href = "admin_dashboard.html";
      } else if (user.role === "student") {
        window.location.href = "student_greeting.html";
      }
    }, 1000);
  } else {
    loginMessage.style.color = "red";
    loginMessage.textContent = "Invalid credentials.";
  }
});

function togglePassword() {
  const input = document.getElementById('password');
  input.type = input.type === 'password' ? 'text' : 'password';
}
