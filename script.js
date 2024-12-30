document.getElementById('textForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const inputText = document.getElementById('inputText').value;
    document.getElementById('responseMessage').textContent = `You submitted: ${inputText}`;
});
