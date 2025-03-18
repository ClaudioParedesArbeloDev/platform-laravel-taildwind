document.getElementById('username').addEventListener('input', function() {
    let username = this.value;
    
    if(username.length > 2){
        fetch(`/check-username?username=${username}`)
        .then(response => response.json())
        .then(data => {
            let response = document.getElementById('response');
            if (data.exists) {
                response.textContent = 'El nombre de usuario ya está en uso. Por favor, elige otro.';
                response.style.color = 'red';
                response.style.display = 'block';
            } else {
                response.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
