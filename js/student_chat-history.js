// DELETE chat item
document.querySelectorAll('.delete-btn').forEach(button => {
  button.addEventListener('click', function () {
    const confirmDelete = confirm("Are you sure you want to delete this conversation?");
    if (confirmDelete) {
      const chatItem = this.closest('.chat-card'); // ✅ correct class
      chatItem.remove();
    }
  });
});

// VIEW FULL CONVERSATION redirection
document.querySelectorAll('.view-link').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    const title = this.dataset.title;
    window.location.href = `/student_chat.html?title=${encodeURIComponent(title)}`;
  });
});
