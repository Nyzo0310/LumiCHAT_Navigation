// Mood button handler (optional: can pass mood via URL or localStorage)
document.querySelectorAll('.mood-btn').forEach(button => {
  button.addEventListener('click', () => {
    const mood = button.textContent;
    localStorage.setItem('selectedMood', mood); // optional use
    window.location.href = "student_chat.html";
  });
});

// Message input send button (skip mood, go straight to chat)
document.querySelector('.send-btn-inside').addEventListener('click', () => {
  const input = document.getElementById('chatInput');
  if (input.value.trim()) {
    localStorage.setItem('firstMessage', input.value); // optional use
    window.location.href = "student_chat.html";
  }
});

const mood = localStorage.getItem('selectedMood');
const message = localStorage.getItem('firstMessage');
console.log('Mood:', mood);
console.log('First message:', message);

